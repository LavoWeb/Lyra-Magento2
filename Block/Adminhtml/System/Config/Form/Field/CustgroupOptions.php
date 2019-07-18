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
 * Custom renderer for the restriction by customer group option field.
 */
class CustgroupOptions extends \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\FieldArray\ConfigFieldArray
{

    /**
     *
     * @var \Magento\Customer\Model\GroupFactory
     */
    protected $customerGroupFactory;

    /**
     *
     * @var bool
     */
    protected $staticTable = true;

    /**
     *
     * @var array
     */
    protected $_default = [];

    /**
     *
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Customer\Model\GroupFactory $customerGroupFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Customer\Model\GroupFactory $customerGroupFactory,
        array $data = []
    ) {
        $this->customerGroupFactory = $customerGroupFactory;

        parent::__construct($context, $data);
    }

    /**
     * Prepare to render.
     *
     * @return void
     */
    public function _prepareToRender()
    {
        $this->addColumn(
            'title',
            [
                'label' => __('Customer group'),
                'style' => 'width: 200px;',
                'renderer' => $this->getLabelRenderer('_title')
            ]
        );
        $this->addColumn(
            'amount_min',
            [
                'label' => __('Minimum amount'),
                'style' => 'width: 160px;'
            ]
        );
        $this->addColumn(
            'amount_max',
            [
                'label' => __('Maximum amount'),
                'style' => 'width: 160px;'
            ]
        );

        parent::_prepareToRender();
    }

    /**
     * Obtain existing data from form element.
     * Each row will be instance of \Magento\Framework\DataObject
     *
     * @return array
     */
    public function getArrayRows()
    {
        $groups = $this->getAllCustomerGroups();

        $savedGroups = $this->getElement()->getValue();
        if (! is_array($savedGroups)) {
            $savedGroups = [];
        }

        if (! empty($savedGroups)) {
            foreach ($savedGroups as $id => $savedGroup) {
                if (key_exists($savedGroup['code'], $groups)) {
                    // Refresh group title.
                    $savedGroups[$id]['title'] = $groups[$savedGroup['code']];
                    if ($savedGroup['code'] === 'all') {
                        $savedGroups[$id]['all'] = true;
                    }

                    unset($groups[$savedGroup['code']]);
                }
            }
        }

        // Add not saved yet groups.
        foreach ($groups as $code => $title) {
           $min = (($code === 'all') && isset($this->_default['amount_min'])) ? $this->_default['amount_min'] : '';
           $max = (($code === 'all') && isset($this->_default['amount_max'])) ? $this->_default['amount_max'] : '';

            $group = [
                'code' => $code,
                'title' => $title,
                'amount_min' => $min,
                'amount_max' => $max
            ];

            if ($code === 'all') {
                // Add all groups entry.
                $group['all'] = true;
                $savedGroups = array_merge([
                    uniqid('_all_') => $group
                ], $savedGroups);
            } else {
                $savedGroups[uniqid('_' . $code . '_')] = $group;
            }
        }

        $this->getElement()->setValue($savedGroups);
        return parent::getArrayRows();
    }

    private function getAllCustomerGroups()
    {
        $options = [];
        $options['all'] = __('ALL GROUPS');

        $groups = $this->customerGroupFactory->create()->getCollection();
        foreach ($groups as $group) {
            $options[$group->getCustomerGroupId()] = $group->getCustomerGroupCode();
        }

        return $options;
    }
}
