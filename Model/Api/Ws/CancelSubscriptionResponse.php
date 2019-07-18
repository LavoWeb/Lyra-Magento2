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

class CancelSubscriptionResponse extends WsResponse
{
    /**
     * @var CancelSubscriptionResult $cancelSubscriptionResult
     */
    private $cancelSubscriptionResult = null;

    /**
     * @return CancelSubscriptionResult
     */
    public function getCancelSubscriptionResult()
    {
        return $this->cancelSubscriptionResult;
    }

    /**
     * @param CancelSubscriptionResult $cancelSubscriptionResult
     * @return CancelSubscriptionResponse
     */
    public function setCancelSubscriptionResult($cancelSubscriptionResult)
    {
        $this->cancelSubscriptionResult = $cancelSubscriptionResult;
        return $this;
    }
}
