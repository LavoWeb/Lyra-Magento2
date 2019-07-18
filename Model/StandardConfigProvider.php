<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model;

class StandardConfigProvider extends \Lyranetwork\Lyra\Model\LyraConfigProvider
{

    /**
     *
     * @var string|boolean
     */
    protected $formToken = false;

    /**
     *
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\View\Asset\Repository $assetRepo
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Payment\Helper\Data $paymentHelper
     * @param \Lyranetwork\Lyra\Helper\Data $dataHelper
     * @param string $methodCode
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\View\Asset\Repository $assetRepo,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Payment\Helper\Data $paymentHelper,
        \Lyranetwork\Lyra\Helper\Data $dataHelper
    ) {
        parent::__construct(
            $storeManager,
            $assetRepo,
            $urlBuilder,
            $logger,
            $paymentHelper,
            $dataHelper,
            \Lyranetwork\Lyra\Helper\Data::METHOD_STANDARD
        );
    }

    /**
     *
     * {@inheritdoc}
     *
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['payment'][$this->method->getCode()]['iframeLoaderUrl'] = $this->getIframeLoaderUrl();
        $config['payment'][$this->method->getCode()]['oneClick'] = $this->method->isOneclickAvailable();

        $customer = $this->method->getCurrentCustomer();
        $maskedPan = '';
        if ($customer && $customer->getCustomAttribute('lyra_masked_pan')) {
            $maskedPan = $customer->getCustomAttribute('lyra_masked_pan')->getValue();
        }

        $config['payment'][$this->method->getCode()]['maskedPan'] = $maskedPan;

        // For payment via REST API.
        $config['payment'][$this->method->getCode()]['restFormToken'] = $this->getRestFormToken();
        $config['payment'][$this->method->getCode()]['language'] = $this->method->getPaymentLanguage();

        return $config;
    }

    /**
     * Iframe loader URL getter.
     *
     * @return string
     */
    private function getIframeLoaderUrl()
    {
        $params = [
            '_secure' => true
        ];

        return $this->urlBuilder->getUrl('lyra/payment_iframe/loader', $params);
    }

    private function getRestFormToken()
    {
        if ($this->getEntryMode() != 4) {
            return false;
        }

        if (! $this->formToken) {
            $this->formToken = $this->method->getRestApiFormToken();
        }

        return $this->formToken;
    }
}
