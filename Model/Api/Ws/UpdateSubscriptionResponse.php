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

class UpdateSubscriptionResponse extends WsResponse
{
    /**
     * @var UpdateSubscriptionResult $updateSubscriptionResult
     */
    private $updateSubscriptionResult = null;

    /**
     * @return UpdateSubscriptionResult
     */
    public function getUpdateSubscriptionResult()
    {
        return $this->updateSubscriptionResult;
    }

    /**
     * @param UpdateSubscriptionResult $updateSubscriptionResult
     * @return UpdateSubscriptionResponse
     */
    public function setUpdateSubscriptionResult($updateSubscriptionResult)
    {
        $this->updateSubscriptionResult = $updateSubscriptionResult;
        return $this;
    }
}
