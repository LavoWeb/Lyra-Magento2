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

class GetPaymentUuidResponse extends WsResponse
{
    /**
     * @var LegacyTransactionKeyResult $legacyTransactionKeyResult
     */
    private $legacyTransactionKeyResult = null;

    /**
     * @return LegacyTransactionKeyResult
     */
    public function getLegacyTransactionKeyResult()
    {
        return $this->legacyTransactionKeyResult;
    }

    /**
     * @param LegacyTransactionKeyResult $legacyTransactionKeyResult
     * @return GetPaymentUuidResponse
     */
    public function setLegacyTransactionKeyResult($legacyTransactionKeyResult)
    {
        $this->legacyTransactionKeyResult = $legacyTransactionKeyResult;
        return $this;
    }
}
