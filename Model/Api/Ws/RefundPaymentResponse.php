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

class RefundPaymentResponse extends WsResponse
{
    /**
     * @var RefundPaymentResult $refundPaymentResult
     */
    private $refundPaymentResult = null;

    /**
     * @return RefundPaymentResult
     */
    public function getRefundPaymentResult()
    {
        return $this->refundPaymentResult;
    }

    /**
     * @param RefundPaymentResult $refundPaymentResult
     * @return RefundPaymentResponse
     */
    public function setRefundPaymentResult($refundPaymentResult)
    {
        $this->refundPaymentResult = $refundPaymentResult;
        return $this;
    }
}
