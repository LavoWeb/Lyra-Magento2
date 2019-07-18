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

class GetSubscriptionDetailsResponse extends WsResponse
{
    /**
     * @var GetSubscriptionDetailsResult $getSubscriptionDetailsResult
     */
    private $getSubscriptionDetailsResult = null;

    /**
     * @return GetSubscriptionDetailsResult
     */
    public function getGetSubscriptionDetailsResult()
    {
        return $this->getSubscriptionDetailsResult;
    }

    /**
     * @param GetSubscriptionDetailsResult $getSubscriptionDetailsResult
     * @return GetSubscriptionDetailsResponse
     */
    public function setGetSubscriptionDetailsResult($getSubscriptionDetailsResult)
    {
        $this->getSubscriptionDetailsResult = $getSubscriptionDetailsResult;
        return $this;
    }
}
