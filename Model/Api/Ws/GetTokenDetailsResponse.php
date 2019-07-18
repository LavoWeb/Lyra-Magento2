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

class GetTokenDetailsResponse extends WsResponse
{
    /**
     * @var GetTokenDetailsResult $getTokenDetailsResult
     */
    private $getTokenDetailsResult = null;

    /**
     * @return GetTokenDetailsResult
     */
    public function getGetTokenDetailsResult()
    {
        return $this->getTokenDetailsResult;
    }

    /**
     * @param GetTokenDetailsResult $getTokenDetailsResult
     * @return GetTokenDetailsResponse
     */
    public function setGetTokenDetailsResult($getTokenDetailsResult)
    {
        $this->getTokenDetailsResult = $getTokenDetailsResult;
        return $this;
    }
}
