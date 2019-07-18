<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Controller\Payment\Rest;

use Lyranetwork\Lyra\Model\ResponseException;

class Check extends \Lyranetwork\Lyra\Controller\Payment\Check
{

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     *
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $orderFactory;

    /**
     * @var \Magento\Quote\Api\CartManagementInterface
     */
    protected $quoteManagement;

    /**
     *
     * @var \Magento\Quote\Api\CartRepositoryInterface
     */
    protected $quoteRepository;

    /**
     *
     * @var \Lyranetwork\Lyra\Model\Api\LyraResponseFactory
     */
    protected $lyraResponseFactory;

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Rest
     */
    protected $restHelper;

    /**
     *
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Lyranetwork\Lyra\Controller\Processor\CheckProcessor $checkProcessor
     * @param \Magento\Framework\Controller\Result\RawFactory $rawResultFactory
     * @param \Lyranetwork\Lyra\Helper\Rest $restHelper
     * @param \Magento\Quote\Api\CartManagementInterface $quoteManagement
     * @param \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Lyranetwork\Lyra\Controller\Processor\CheckProcessor $checkProcessor,
        \Magento\Framework\Controller\Result\RawFactory $rawResultFactory,
        \Lyranetwork\Lyra\Helper\Rest $restHelper,
        \Magento\Quote\Api\CartManagementInterface $quoteManagement,
        \Magento\Quote\Api\CartRepositoryInterface $quoteRepository
    ) {
        $this->restHelper = $restHelper;
        $this->quoteManagement = $quoteManagement;
        $this->quoteRepository = $quoteRepository;
        $this->dataHelper = $checkProcessor->getDataHelper();
        $this->storeManager = $checkProcessor->getStoreManager();
        $this->orderFactory = $checkProcessor->getOrderFactory();
        $this->lyraResponseFactory = $checkProcessor->getLyraResponseFactory();

        parent::__construct($context, $checkProcessor, $rawResultFactory);
    }

    protected function prepareResponse($params)
    {
        // Check the validity of the request.
        if (! $this->restHelper->checkResponseFormat($params)) {
            $this->dataHelper->log('Invalid response received. Content: ' . json_encode($params), \Psr\Log\LogLevel::ERROR);
            throw new ResponseException('<span style="display:none">KO-Invalid IPN request received.'."\n".'</span>');
        }

        $answer = json_decode($params['kr-answer'], true);
        if (! is_array($answer)) {
            $this->dataHelper->log('Invalid response received. Content: ' . json_encode($params), \Psr\Log\LogLevel::ERROR);
            throw new ResponseException('<span style="display:none">KO-Invalid IPN request received.'."\n".'</span>');
        }

        // Wrap payment result to use traditional order creation tunnel.
        $data = $this->restHelper->convertRestResult($answer);

        // Convert REST result to standard form response.
        $response = $this->lyraResponseFactory->create(
            [
                'params' => $data,
                'ctx_mode' => null,
                'key_test' => null,
                'key_prod' => null,
                'algo' => null
            ]
        );

        $quoteId = (int) $response->getExtInfo('quote_id');
        $quote = $this->quoteRepository->get($quoteId);
        if (! $quote->getId()) {
            $this->dataHelper->log("Quote not found with ID #{$quoteId}.", \Psr\Log\LogLevel::ERROR);
            throw new ResponseException($response->getOutputForGateway('order_not_found'));
        }

        // Token is created before order creation, search order by quote.
        $order = $this->orderFactory->create();
        $order->loadByIncrementId($quote->getReservedOrderId());
        if (! $order->getId()) {
            // Case of failure when retries are enabled, do nothing before last attempt.
            if (! $response->isAcceptedPayment() && ($answer['orderCycle'] !== 'CLOSED')) {
                $this->dataHelper->log("Payment is not accepted but buyer can try to re-order. Do not create order at this time. Quote ID: #{$quoteId}.");
                throw new ResponseException($response->getOutputForGateway('payment_ko_bis'));
            }

            $order = $this->quoteManagement->submit($quote);

            if (! $order->getId()) {
                $this->dataHelper->log("Order cannot be created for quote #{$quoteId}.", \Psr\Log\LogLevel::ERROR);
                throw new ResponseException($response->getOutputForGateway('ko', 'Error when trying to create order.'));
            }

            $this->dataHelper->log("Order #{$order->getId()} has been created for quote #{$quoteId}.");
        } else {
            $this->dataHelper->log("Found order #{$order->getId()} for quote #{$quoteId}.");
        }

        // Get store id from order.
        $storeId = $order->getStore()->getId();

        // Init app with correct store ID.
        $this->storeManager->setCurrentStore($storeId);

        // Check the authenticity of the request.
        if (! $this->restHelper->checkResponseHash($params, $this->restHelper->getPrivateKey($storeId))) {
            // Authentication failed.
            $this->dataHelper->log(
                "{$this->dataHelper->getIpAddress()} tries to access lyra/payment_rest/response page without valid signature with parameters: " . json_encode($params),
                \Psr\Log\LogLevel::ERROR
            );

            throw new ResponseException($response->getOutputForGateway('auth_fail'));
        }

        return [
            'response' => $response,
            'order' => $order
        ];
    }
}
