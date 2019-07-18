<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */

/**
 * Custom renderer for the Full CB customer group options field.
 */

namespace Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\Fullcb;

class FullcbCustgroupOptions extends \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\CustgroupOptions
{
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\GroupFactory $customerGroupFactory,
        array $data = []
    ) {
        parent::__construct($context,$customerGroupFactory, $data);

        $this->_default = ['amount_min' => '100', 'amount_max' => '1500'];
    }
}
