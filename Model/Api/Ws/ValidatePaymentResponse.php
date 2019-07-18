<?php
/**
 * Lyra Collect V2-Payment Module version 2.4.1 for Magento 2.x. Support contact : support-ecommerce@lyra-collect.com.
 *
 * @category  Payment
 * @package   Lyra
 * @author    Lyra Network (http://www.lyra-network.com/)
 * @copyright 2014-2019 Lyra Network and contributors
 * @license   
 */

namespace Lyranetwork\Lyra\Model\Api\Ws;

class ValidatePaymentResponse extends WsResponse
{
    /**
     * @var ValidatePaymentResult $validatePaymentResult
     */
    private $validatePaymentResult = null;

    /**
     * @return ValidatePaymentResult
     */
    public function getValidatePaymentResult()
    {
        return $this->validatePaymentResult;
    }

    /**
     * @param ValidatePaymentResult $validatePaymentResult
     * @return ValidatePaymentResponse
     */
    public function setValidatePaymentResult($validatePaymentResult)
    {
        $this->validatePaymentResult = $validatePaymentResult;
        return $this;
    }
}
