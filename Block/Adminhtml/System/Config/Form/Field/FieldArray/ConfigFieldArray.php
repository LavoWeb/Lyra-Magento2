<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\FieldArray;

/**
 * Backend system config array field renderer.
 */
abstract class ConfigFieldArray extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{

    /**
     *
     * @var bool
     */
    protected $staticTable = false;

    protected $dependantFields = [];

    protected function _construct()
    {
        if ($this->staticTable) {
            $this->_template = 'Lyranetwork_Lyra::system/config/form/field/static_array.phtml';
        }

        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');

        parent::_construct();
    }

    /**
     * Retrieve label type column renderer.
     *
     * @return Customergroup
     */
    protected function getLabelRenderer($columnName)
    {
        if (! isset($this->$columnName) || ! $this->$columnName) {
            $this->$columnName = $this->getLayout()->createBlock(
                \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\Renderer\ColumnLabel::class,
                '',
                [
                    'data' => [
                        'is_render_to_js_template' => false
                    ]
                ]
            );
        }

        return $this->$columnName;
    }

    /**
     * Retrieve list type column renderer.
     *
     * @return Customergroup
     */
    protected function getListRenderer($columnName, $options)
    {
        if (! isset($this->$columnName) || ! $this->$columnName) {
            $this->$columnName = $this->getLayout()->createBlock(
                \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\Renderer\ColumnList::class,
                '',
                [
                    'data' => [
                        'is_render_to_js_template' => false,
                        'options' => $options
                    ]
                ]
            );
        }

        return $this->$columnName;
    }

    /**
     * Retrieve list type column renderer.
     *
     * @return Customergroup
     */
    protected function getUploadButtonRenderer($columnName)
    {
        if (! isset($this->$columnName) || ! $this->$columnName) {
            $this->$columnName = $this->getLayout()->createBlock(
                \Lyranetwork\Lyra\Block\Adminhtml\System\Config\Form\Field\Renderer\ColumnUploadButton::class,
                '',
                [
                    'data' => [
                        'is_render_to_js_template' => false
                    ]
                ]
            );
        }

        return $this->$columnName;
    }

    /**
     * Retrieve HTML markup for given form element.
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $fieldConfig = $element->getFieldConfig();

        if (isset($fieldConfig['depends']['fields'])) {
            foreach ($fieldConfig['depends']['fields'] as $field) {
                $this->dependantFields[] = implode('_', $field['dependPath']);
            }
        }

        return parent::render($element);
    }

    /**
     * Render HTML block.
     *
     * @return string
     */
    protected function _toHtml()
    {
        $thisEltId = $this->getElement()->getId();

        $script = '';

        if ($this->_isInheritCheckboxRequired($this->getElement())) {
            $script .= '
                <script>
                     require([
                        "prototype"
                    ], function () {
                        document.observe("dom:loaded", function() {
                            toggleValueElements($("' . $thisEltId . '_inherit"), $("' . $thisEltId . '"));';

            if (! empty($this->dependantFields)) {
                foreach ($this->dependantFields as $dependantField) {
                    $script .= '
                        Event.observe($("' . $dependantField . '"), "change", function() {
                            toggleValueElements($("' . $thisEltId . '_inherit"), $("' . $thisEltId . '"));
                        });';
                }
            }

            $script .= '});
                    });
                </script>
            ';
        }

        return '<div id="' . $thisEltId . '">' . parent::_toHtml() . "\n$script" . '</div>';
    }
}
