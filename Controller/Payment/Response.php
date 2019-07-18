<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Controller\Payment;

use Lyranetwork\Lyra\Helper\Payment;
use Lyranetwork\Lyra\Model\ResponseException;

class Response extends \Magento\Framework\App\Action\Action
{

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     *
     * @var \Lyranetwork\Lyra\Controller\Processor\ResponseProcessor
     */
    protected $responseProcessor;

    /**
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     * @param \Lyranetwork\Lyra\Controller\Processor\ResponseProcessor $responseProcessor
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository,
        \Lyranetwork\Lyra\Controller\Processor\ResponseProcessor $responseProcessor,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->responseProcessor = $responseProcessor;
        $this->resultPageFactory = $resultPageFactory;
        $this->dataHelper = $responseProcessor->getDataHelper();

        parent::__construct($context);
    }

    public function execute()
    {
        // Empty order model.
        $order = null;

        try {
            $params = $this->getRequest()->getParams();
            $data = $this->prepareResponse($params);

            $order = $data['order'];
            $response = $data['response'];

            $result = $this->responseProcessor->execute($order, $response);

            return $this->redirectResponse($order, $result['case'], $result['warn']);
        } catch (ResponseException $e) {
            $this->dataHelper->log($e->getMessage(), \Psr\Log\LogLevel::ERROR);
            return $this->redirectError($order);
        }
    }

    protected function prepareResponse($params)
    {
        return $this->responseProcessor->prepareResponse($params);
    }

    /**
     * Redirect to error page (when technical error occurred).
     *
     * @param \Magento\Sales\Model\Order $order
     */
    protected function redirectError($order = null)
    {
        // Clear all messages in session.
        $this->messageManager->getMessages(true);

        if ($order) {
            $this->dataHelper->getCheckout()
                ->setLastQuoteId($order->getQuoteId())
                ->setLastOrderId($order->getId());
        }

        $this->dataHelper->log('Redirecting to one page checkout failure page.' . ($order ? " Order #{$order->getId()}." : ''));
        return $this->createResult('checkout/onepage/failure', ['_scope' => $this->dataHelper->getCheckoutStoreId()]);
    }

    /**
     * Redirect to result page (according to payment status).
     *
     * @param \Magento\Sales\Model\Order $order
     * @param int $case
     * @param bool $checkUrlWarn
     */
    protected function redirectResponse($order, $case, $checkUrlWarn = false)
    {
        /**
         *
         * @var Magento\Checkout\Model\Session $checkout
         */
        $checkout = $this->dataHelper->getCheckout();

        // Clear all messages in session.
        $this->messageManager->getMessages(true);

        $storeId = $order->getStore()->getId();
        if ($this->dataHelper->getCommonConfigData('ctx_mode', $storeId) === 'TEST') {
            $features = \Lyranetwork\Lyra\Helper\Data::$pluginFeatures;
            if ($features['prodfaq']) {
                // Display going to production message.
                $message = __('<u><p>GOING INTO PRODUCTION:</u></p> You want to know how to put your shop into production mode, please read chapters &laquo; Proceeding to test phase &raquo; and &laquo; Shifting the shop to production mode &raquo; in the documentation of the module.');
                $this->messageManager->addNotice($message);
            }

            if ($checkUrlWarn) {
                // Order not validated by notification URL. In TEST mode, user is webmaster
                // So display a warning about notification URL not working.

                if ($this->dataHelper->isMaintenanceMode()) {
                    $message = __('The shop is in maintenance mode.The automatic notification cannot work.');
                } else {
                    $message = __('The automatic validation has not worked. Have you correctly set up the notification URL in your Lyra Expert Back Office?');
                    $message .= '<br /><br />';
                    $message .= __('For understanding the problem, please read the documentation of the module:<br />&nbsp;&nbsp;&nbsp;- Chapter &laquo; To read carefully before going further &raquo;<br />&nbsp;&nbsp;&nbsp;- Chapter &laquo; Notification URL settings &raquo;');
                }

                $this->messageManager->addError($message);
            }
        }

        if ($case === Payment::SUCCESS) {
            $checkout->setLastQuoteId($order->getQuoteId())
                ->setLastSuccessQuoteId($order->getQuoteId())
                ->setLastOrderId($order->getId())
                ->setLastRealOrderId($order->getIncrementId())
                ->setLastOrderStatus($order->getStatus());

            $this->dataHelper->log("Redirecting to one page checkout success page for order #{$order->getId()}.");
            $resultRedirect = $this->createResult('checkout/onepage/success', ['_scope' => $storeId]);
        } else {
            if ($case === Payment::FAILURE) {
                $this->messageManager->addWarning(__('Your payment was not accepted. Please, try to re-order.'));
            }

            $this->dataHelper->log("Restore cart for order #{$order->getId()} to allow re-order quicker.");
            $quote = $this->quoteRepository->get($order->getQuoteId());
            if ($quote->getId()) {
                $quote->setIsActive(true)->setReservedOrderId(null);
                $this->quoteRepository->save($quote);

                $checkout->replaceQuote($quote);
            }

            $this->dataHelper->log("Redirecting to cart page for order #{$order->getId()}.");
            $resultRedirect = $this->createResult('checkout/cart', ['_scope' => $storeId]);
        }

        return $resultRedirect;
    }

    private function createResult($path, $params)
    {
        if ($this->getRequest()->getParam('iframe', false)) {
            $result = $this->resultPageFactory->create();

            $block = $result->getLayout()
                ->createBlock(\Lyranetwork\Lyra\Block\Payment\Iframe\Response::class)
                ->setTemplate('Lyranetwork_Lyra::payment/iframe/response.phtml')
                ->setForwardPath($path, $params);

            $this->getResponse()->setBody($block->toHtml());
            return null;
        } else {
            /**
             *
             * @var \Magento\Framework\Controller\Result\Redirect $result
             */
            $result = $this->resultRedirectFactory->create();
            $result->setPath($path, $params);
            return $result;
        }
    }
}
