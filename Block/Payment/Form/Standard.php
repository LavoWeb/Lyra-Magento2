<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Block\Payment\Form;

class Standard extends Lyra
{

    protected $_template = 'Lyranetwork_Lyra::payment/form/standard.phtml';

    public function getAvailableCcTypes()
    {
        return $this->getMethod()->getAvailableCcTypes();
    }

    public function getCcTypeNetwork($code)
    {
        $cbCards = [
            'CB',
            'VISA',
            'VISA_ELECTRON',
            'MASTERCARD',
            'MAESTRO',
            'E-CARTEBLEUE',
            'VPAY'
        ];

        if ($code == 'AMEX') {
            return 'AMEX';
        } elseif (in_array($code, $cbCards)) {
            return 'CB';
        } else {
            return null;
        }
    }

    public function getCcTypeImageSrc($card)
    {
        $card = 'cc/' . strtolower($card) . '.png';

        if ($this->dataHelper->isUploadFileImageExists($card)) {
            return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) .
                 'lyra/images/' . $card;
        } else {
            return $this->getViewFileUrl('Lyranetwork_Lyra::images/' . $card);
        }
    }

    public function getCurrentCustomer()
    {
        return $this->getMethod()->getCurrentCustomer();
    }

    public function isLocalCcType()
    {
        return $this->getMethod()->isLocalCcType();
    }
}
