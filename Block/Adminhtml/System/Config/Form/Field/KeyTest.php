<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field;

/**
 * Custom renderer for the test key field.
 */
class KeyTest extends \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\Sensitive
{
    /**
     * Unset some non-related element parameters.
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        // Get configured features.
        $features = \Lyranetwork\Lyra\Helper\Data::$pluginFeatures;

        if ($features['qualif']) {
            return '';
        }

        return parent::render($element);
    }
}
