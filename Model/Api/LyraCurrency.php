<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Model\Api;

if (! class_exists('LyraCurrency', false)) {

    /**
     * Class representing a currency, used for converting alpha/numeric ISO codes and float/integer amounts.
     */
    class LyraCurrency
    {

        private $alpha3;
        private $num;
        private $decimals;

        public function __construct($alpha3, $num, $decimals = 2)
        {
            $this->alpha3 = $alpha3;
            $this->num = $num;
            $this->decimals = $decimals;
        }

        public function convertAmountToInteger($float)
        {
            $coef = pow(10, $this->decimals);

            $amount = $float * $coef;
            return (int) (string) $amount; // Cast amount to string (to avoid rounding) than return it as int.
        }

        public function convertAmountToFloat($integer)
        {
            $coef = pow(10, $this->decimals);

            return ((float) $integer) / $coef;
        }

        public function getAlpha3()
        {
            return $this->alpha3;
        }

        public function getNum()
        {
            return $this->num;
        }

        public function getDecimals()
        {
            return $this->decimals;
        }
    }
}
