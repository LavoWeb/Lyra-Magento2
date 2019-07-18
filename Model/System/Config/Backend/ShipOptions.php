<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model\System\Config\Backend;

class ShipOptions extends \Lyranetwork\Lyra\Model\System\Config\Backend\Serialized\ArraySerialized\ConfigArraySerialized
{

    public function beforeSave()
    {
        $data = $this->getGroups('lyra'); // Get data of general config group.
        $oneyContract = isset($data['fields']['oney_contract']['value']) && $data['fields']['oney_contract']['value'];

        if ($oneyContract) {
            $deliveryCompanyRegex = "#^[A-Z0-9ÁÀÂÄÉÈÊËÍÌÎÏÓÒÔÖÚÙÛÜÇ /'-]{1,127}$#ui";

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

                    if (empty($value['oney_label']) || ! preg_match($deliveryCompanyRegex, $value['oney_label'])) {
                        $this->throwException('FacilyPay Oney label', $i);
                    }
                }
            }
        } else {
            $this->setValue([]);
        }

        return parent::beforeSave();
    }
}
