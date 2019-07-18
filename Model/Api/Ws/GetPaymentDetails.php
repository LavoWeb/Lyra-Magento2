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

class GetPaymentDetails
{
    /**
     * @var QueryRequest $queryRequest
     */
    private $queryRequest = null;

    /**
     * @var ExtendedResponseRequest $extendedResponseRequest
     */
    private $extendedResponseRequest = null;

    /**
     * @return QueryRequest
     */
    public function getQueryRequest()
    {
        return $this->queryRequest;
    }

    /**
     * @param QueryRequest $queryRequest
     * @return GetPaymentDetails
     */
    public function setQueryRequest($queryRequest)
    {
        $this->queryRequest = $queryRequest;
        return $this;
    }

    /**
     * @return ExtendedResponseRequest
     */
    public function getExtendedResponseRequest()
    {
        return $this->extendedResponseRequest;
    }

    /**
     * @param ExtendedResponseRequest $extendedResponseRequest
     * @return GetPaymentDetails
     */
    public function setExtendedResponseRequest($extendedResponseRequest)
    {
        $this->extendedResponseRequest = $extendedResponseRequest;
        return $this;
    }
}
