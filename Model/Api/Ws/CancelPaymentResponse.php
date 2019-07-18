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

class CancelPaymentResponse extends WsResponse
{
    /**
     * @var CancelPaymentResult $cancelPaymentResult
     */
    private $cancelPaymentResult = null;

    /**
     * @return CancelPaymentResult
     */
    public function getCancelPaymentResult()
    {
        return $this->cancelPaymentResult;
    }

    /**
     * @param CancelPaymentResult $cancelPaymentResult
     * @return CancelPaymentResponse
     */
    public function setCancelPaymentResult($cancelPaymentResult)
    {
        $this->cancelPaymentResult = $cancelPaymentResult;
        return $this;
    }
}
