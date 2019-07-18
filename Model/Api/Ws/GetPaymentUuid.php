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

class GetPaymentUuid
{
    /**
     * @var LegacyTransactionKeyRequest $legacyTransactionKeyRequest
     */
    private $legacyTransactionKeyRequest = null;

    /**
     * @return LegacyTransactionKeyRequest
     */
    public function getLegacyTransactionKeyRequest()
    {
        return $this->legacyTransactionKeyRequest;
    }

    /**
     * @param LegacyTransactionKeyRequest $legacyTransactionKeyRequest
     * @return GetPaymentUuid
     */
    public function setLegacyTransactionKeyRequest($legacyTransactionKeyRequest)
    {
        $this->legacyTransactionKeyRequest = $legacyTransactionKeyRequest;
        return $this;
    }
}
