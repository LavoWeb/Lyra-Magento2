<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model\System\Config\Backend\Fullcb;

class FullcbPaymentOptions extends \Lyranetwork\Lyra\Model\System\Config\Backend\Serialized\ArraySerialized\ConfigArraySerialized
{

    public function beforeSave()
    {
        $values = $this->getValue();

        if (! is_array($values) || empty($values)) {
            $this->setValue([]);
        } else {
            $i = 0;
            foreach ($values as $value) {
                $i ++;

                if (empty($value)) {
                    continue;
                }

                if (empty($value['label'])) {
                    $this->throwException('Label', $i);
                }

                if (! empty($value['amount_min']) && (! is_numeric($value['amount_min']) || $value['amount_min'] < 0)) {
                    $this->throwException('Minimum amount', $i);
                }

                if (! empty($value['amount_max']) && (! is_numeric($value['amount_max']) || $value['amount_max'] < 0)) {
                    $this->throwException('Maximum amount', $i);
                }

                if (! empty($value['rate']) && (! is_numeric($value['rate']) || $value['rate'] < 0)) {
                    $this->throwException('Rate', $i);
                }

                if (! empty($value['cap']) && (! is_numeric($value['cap']) || $value['cap'] < 0)) {
                    $this->throwException('Cap', $i);
                }
            }
        }

        return parent::beforeSave();
    }
}
