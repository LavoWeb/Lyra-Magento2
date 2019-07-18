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

class UpdateToken
{
    /**
     * @var CommonRequest $commonRequest
     */
    private $commonRequest = null;

    /**
     * @var QueryRequest $queryRequest
     */
    private $queryRequest = null;

    /**
     * @var CardRequest $cardRequest
     */
    private $cardRequest = null;

    /**
     * @var CustomerRequest $customerRequest
     */
    private $customerRequest = null;

    /**
     * @var TokenRequest $tokenRequest
     */
    private $tokenRequest = null;

    /**
     * @return CommonRequest
     */
    public function getCommonRequest()
    {
        return $this->commonRequest;
    }

    /**
     * @param CommonRequest $commonRequest
     * @return UpdateToken
     */
    public function setCommonRequest($commonRequest)
    {
        $this->commonRequest = $commonRequest;
        return $this;
    }

    /**
     * @return QueryRequest
     */
    public function getQueryRequest()
    {
        return $this->queryRequest;
    }

    /**
     * @param QueryRequest $queryRequest
     * @return UpdateToken
     */
    public function setQueryRequest($queryRequest)
    {
        $this->queryRequest = $queryRequest;
        return $this;
    }

    /**
     * @return CardRequest
     */
    public function getCardRequest()
    {
        return $this->cardRequest;
    }

    /**
     * @param CardRequest $cardRequest
     * @return UpdateToken
     */
    public function setCardRequest($cardRequest)
    {
        $this->cardRequest = $cardRequest;
        return $this;
    }

    /**
     * @return CustomerRequest
     */
    public function getCustomerRequest()
    {
        return $this->customerRequest;
    }

    /**
     * @param CustomerRequest $customerRequest
     * @return UpdateToken
     */
    public function setCustomerRequest($customerRequest)
    {
        $this->customerRequest = $customerRequest;
        return $this;
    }

    /**
     * @return TokenRequest
     */
    public function getTokenRequest()
    {
        return $this->tokenRequest;
    }

    /**
     * @param TokenRequest $tokenRequest
     * @return UpdateToken
     */
    public function setTokenRequest($tokenRequest)
    {
        $this->tokenRequest = $tokenRequest;
        return $this;
    }
}
