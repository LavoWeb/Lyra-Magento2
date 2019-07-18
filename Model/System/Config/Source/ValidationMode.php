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

class ValidationMode extends \Magento\Framework\DataObject implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        $options = [
            [
                'value' => '',
                'label' => __('Lyra Expert Back Office configuration')
            ],
            [
                'value' => '0',
                'label' => __('Automatic')
            ],
            [
                'value' => '1',
                'label' => __('Manual')
            ]
        ];

        if (stripos($this->getPath(), '/lyra_general/') === false) {
            array_unshift($options, [
                'value' => '-1',
                'label' => __('Lyra Collect general configuration')
            ]);
        }

        return $options;
    }
}
