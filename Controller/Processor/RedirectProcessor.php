<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Controller\Processor;

class RedirectProcessor
{

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     *
     * @param \Lyranetwork\Lyra\Helper\Data $dataHelper
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Lyranetwork\Lyra\Helper\Data $dataHelper,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->dataHelper = $dataHelper;
        $this->coreRegistry = $coreRegistry;
    }

    public function execute(\Magento\Sales\Model\Order $order)
    {
        // Add history comment and save it.
        $order->addStatusHistoryComment(__('Client sent to Lyra Collect gateway.'), false)
            ->setIsCustomerNotified(false)
            ->save();

        $method = $order->getPayment()->getMethodInstance();
        $this->coreRegistry->register(
            \Lyranetwork\Lyra\Block\Constants::PARAMS_REGISTRY_KEY,
            $method->getFormFields($order)
        );

        $this->coreRegistry->register(
            \Lyranetwork\Lyra\Block\Constants::URL_REGISTRY_KEY,
            $method->getGatewayUrl()
        );

        // Log action before redirect.
        $this->dataHelper->log("Client {$order->getCustomerEmail()} sent to payment page for order #{$order->getId()}.");
    }

    public function getDataHelper()
    {
        return $this->dataHelper;
    }
}
