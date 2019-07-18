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

use Lyranetwork\Lyra\Model\OrderException;

class Redirect extends \Magento\Framework\App\Action\Action
{

    /**
     *
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Lyranetwork\Lyra\Controller\Processor\RedirectProcessor
     */
    protected $redirectProcessor;

    /**
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Sales\Model\OrderFactory $orderFactory
     * @param \Lyranetwork\Lyra\Controller\Processor\RedirectProcessor $redirectProcessor
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Lyranetwork\Lyra\Controller\Processor\RedirectProcessor $redirectProcessor,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->redirectProcessor = $redirectProcessor;
        $this->resultPageFactory = $resultPageFactory;
        $this->dataHelper = $redirectProcessor->getDataHelper();

        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $order = $this->getAndCheckOrder();

            $this->redirectProcessor->execute($order);

            return $this->forward();
        } catch (\Lyranetwork\Lyra\Model\OrderException $e) {
            return $this->back($e->getMessage());
        }
    }

    /**
     * Get order to pay from session and check it (amount, already processed, ...).
     */
    private function getAndCheckOrder()
    {
        /**
         *
         * @var Magento\Checkout\Model\Session $checkout
         */
        $checkout = $this->dataHelper->getCheckout();

        // Load order.
        $lastIncrementId = $checkout->getLastRealOrderId();

        // Check that there is an order to pay.
        if (empty($lastIncrementId)) {
            $this->dataHelper->log("No order to pay. It may be a direct access to redirection page." .
                     " [IP = {$this->dataHelper->getIpAddress()}].");
            throw new OrderException('Order not found in session.');
        }

        $order = $this->orderFactory->create();
        $order->loadByIncrementId($lastIncrementId);

        // Check that there is products in cart.
        if (! $order->getTotalDue()) {
            $this->dataHelper->log("Payment attempt with no amount. [Order = {$order->getId()}]" .
                     " [IP = {$this->dataHelper->getIpAddress()}].");
            throw new OrderException('Order total is empty.');
        }

        // Check that order is not processed yet.
        if (! $checkout->getLastSuccessQuoteId()) {
            $this->dataHelper->log("Payment attempt with a quote already processed. [Order = {$order->getId()}]" .
                     " [IP = {$this->dataHelper->getIpAddress()}].");
            throw new OrderException('Order payment already processed.');
        }

        // Check if we are in iframe mode to backup order ID.
        if ($this->getRequest()->getParam('iframe', false)) {
            $checkout->setData('lyra_last_real_id', $lastIncrementId);
            $this->dataHelper->log('Saving last real order ID in session: '. $lastIncrementId);
        }

        // Clear quote data.
        $checkout->unsLastQuoteId()
            ->unsLastSuccessQuoteId()
            ->clearHelperData();

        return $order;
    }

    /**
     * Redirect to checkout initial page (when payment cannot be done).
     */
    private function back($msg)
    {
        // Clear all messages in session.
        $this->messageManager->getMessages(true);
        $this->dataHelper->log($msg . ' Redirecting to cart page.');

        if ($this->getRequest()->getParam('iframe', false)) {
            $result = $this->resultPageFactory->create();

            $block = $result->getLayout()
                ->createBlock(\Lyranetwork\Lyra\Block\Payment\Iframe\Response::class)
                ->setTemplate('Lyranetwork_Lyra::payment/iframe/response.phtml')
                ->setForwardPath('checkout/cart');

            $this->getResponse()->setBody($block->toHtml());
            return null;
        } else {
            $result = $this->resultRedirectFactory->create();
            $result->setPath('checkout/cart');
            return $result;
        }
    }

    /**
     * Display redirection page.
     */
    private function forward()
    {
        $resultPage = $this->resultPageFactory->create();

        if ($this->getRequest()->getParam('iframe', false)) {
            $resultPage->addHandle('lyra_payment_iframe_redirect');
        } else {
            $resultPage->addHandle('lyra_payment_form_redirect');
            $resultPage->getConfig()->getTitle()->set(__('Payment gateway redirection'));
        }

        return $resultPage;
    }
}
