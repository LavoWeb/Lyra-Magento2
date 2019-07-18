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

class CapturePayment
{
    /**
     * @var SettlementRequest $settlementRequest
     */
    private $settlementRequest = null;

    /**
     * @return SettlementRequest
     */
    public function getSettlementRequest()
    {
        return $this->settlementRequest;
    }

    /**
     * @param SettlementRequest $settlementRequest
     * @return CapturePayment
     */
    public function setSettlementRequest($settlementRequest)
    {
        $this->settlementRequest = $settlementRequest;
        return $this;
    }
}
