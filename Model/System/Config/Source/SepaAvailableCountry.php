<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model\System\Config\Source;

class SepaAvailableCountry implements \Magento\Framework\Option\ArrayInterface
{
    protected $translate;

    protected $_availableCountries = [
        'FI', 'AT', 'PT', 'BE', 'BG', 'ES', 'HR', 'CY', 'CZ', 'DK', 'EE', 'FR', 'GF', 'DE', 'GI', 'GR',
        'GP', 'HU', 'IS', 'IE', 'LV', 'LI', 'LT', 'LU', 'PT', 'MT', 'MQ', 'YT', 'MC', 'NL', 'NO', 'PL',
        'RE', 'RO', 'BL', 'MF', 'PM', 'SM', 'SK', 'SE', 'CH', 'GB'
    ];

    public function __construct(
        \Magento\Framework\Locale\TranslatedLists $translate
    ) {
        $this->translate = $translate;
    }

    public function toOptionArray()
    {
        $result = [];
        foreach ($this->_availableCountries as $code) {
            $name = $this->translate->getCountryTranslation($code);

            if (empty($name)) {
                $name = $code;
            }

            $result[] = [
                'value' => $code,
                'label' => $name
            ];
        }

        return $result;
    }

    public function getCountryCodes()
    {
        return $this->_availableCountries;
    }

}
