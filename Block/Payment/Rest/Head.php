<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Block\Payment\Rest;

use Lyranetwork\Lyra\Model\Api\LyraApi;

class Head extends \Magento\Framework\View\Element\Template
{
    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Lyranetwork\Lyra\Model\Method\Lyra
     */
    protected $method;

    /**
     *
     * @var \Magento\Framework\Locale\ResolverInterface
     */
    protected $localeResolver;

    private $placeholders = null;

    /**
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Lyranetwork\Lyra\Helper\Data $dataHelper
     * @param \Magento\Framework\Locale\ResolverInterface $localeResolver
     * @param \Magento\Payment\Helper\Data $paymentHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Lyranetwork\Lyra\Helper\Data $dataHelper,
        \Magento\Framework\Locale\ResolverInterface $localeResolver,
        \Magento\Payment\Helper\Data $paymentHelper,

        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->dataHelper = $dataHelper;
        $this->localeResolver = $localeResolver;

        $this->method = $paymentHelper->getMethodInstance(\Lyranetwork\Lyra\Helper\Data::METHOD_STANDARD);
        $this->method->setStore($this->_storeManager->getStore()->getId());
    }

    public function getStaticUrl()
    {
        return $this->dataHelper->getCommonConfigData('static_url');
    }

    public function getReturnUrl()
    {
        return $this->_urlBuilder->getUrl('lyra/payment_rest/response', [
            '_secure' => true
        ]);
    }

    public function getLanguage()
    {
        $lang = strtolower(substr($this->localeResolver->getLocale(), 0, 2));
        if (! LyraApi::isSupportedLanguage($lang)) {
            $lang = $this->dataHelper->getCommonConfigData('language');
        }

        return $lang;
    }

    public function getPublicKey()
    {
        $mode = $this->dataHelper->getCommonConfigData('ctx_mode');
        $key = ($mode === 'PRODUCTION') ? 'rest_public_key_prod' : 'rest_public_key_test';

        return $this->method->getConfigData($key);
    }

    public function getTheme()
    {
        $theme = $this->method->getConfigData('rest_theme');
        return $theme ? $theme : 'material';
    }

    public function getPlaceholder($name)
    {
        if (! $name) {
            return null;
        }

        if (! $this->placeholders) {
            $this->placeholders = $this->dataHelper->unserialize($this->method->getConfigData('rest_placeholders'));
        }

        if (! is_array($this->placeholders) || empty($this->placeholders)) {
            return null;
        }

        if (($placeholder = $this->placeholders[$name]) && isset($placeholder['placeholder']) && $placeholder['placeholder']) {
            return $placeholder['placeholder'];
        }

        return null;
    }

    /**
     * Render block HTML.
     *
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->method->getConfigData('card_info_mode') != 4) {
            return '';
        }

        return parent::_toHtml();
    }
}
