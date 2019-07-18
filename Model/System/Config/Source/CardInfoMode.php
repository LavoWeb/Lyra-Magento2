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

class CardInfoMode implements \Magento\Framework\Option\ArrayInterface
{

    public function toOptionArray()
    {
        $options = [
            [
                'value' => '1',
                'label' => __('Bank data acquisition on payment gateway')
            ],
            [
                'value' => '2',
                'label' => __('Card type selection on merchant site')
            ],
            [
                'value' => '3',
                'label' => __('Payment page integrated to checkout process (iframe mode)')
            ]
        ];

        // Get configured features.
        $features = \Lyranetwork\Lyra\Helper\Data::$pluginFeatures;
        if ($features['embedded']) {
            $options[] = [
                'value' => '4',
                'label' => __('Embedded payment fields (REST API)')
            ];
        }

        return $options;
    }
}
