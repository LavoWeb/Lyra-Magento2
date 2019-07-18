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

class CreateSubscriptionResponse extends WsResponse
{
    /**
     * @var CreateSubscriptionResult $createSubscriptionResult
     */
    private $createSubscriptionResult = null;

    /**
     * @return CreateSubscriptionResult
     */
    public function getCreateSubscriptionResult()
    {
        return $this->createSubscriptionResult;
    }

    /**
     * @param CreateSubscriptionResult $createSubscriptionResult
     * @return CreateSubscriptionResponse
     */
    public function setCreateSubscriptionResult($createSubscriptionResult)
    {
        $this->createSubscriptionResult = $createSubscriptionResult;
        return $this;
    }
}
