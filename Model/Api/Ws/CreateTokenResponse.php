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

class CreateTokenResponse extends WsResponse
{
    /**
     * @var CreateTokenResult $createTokenResult
     */
    private $createTokenResult = null;

    /**
     * @return CreateTokenResult
     */
    public function getCreateTokenResult()
    {
        return $this->createTokenResult;
    }

    /**
     * @param CreateTokenResult $createTokenResult
     * @return CreateTokenResponse
     */
    public function setCreateTokenResult($createTokenResult)
    {
        $this->createTokenResult = $createTokenResult;
        return $this;
    }
}
