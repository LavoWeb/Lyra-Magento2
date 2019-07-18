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

class ThreeDSResponse
{
    /**
     * @var AuthenticationRequestData $authenticationRequestData
     */
    private $authenticationRequestData = null;

    /**
     * @var AuthenticationResultData $authenticationResultData
     */
    private $authenticationResultData = null;

    /**
     * @return AuthenticationRequestData
     */
    public function getAuthenticationRequestData()
    {
        return $this->authenticationRequestData;
    }

    /**
     * @param AuthenticationRequestData $authenticationRequestData
     * @return ThreeDSResponse
     */
    public function setAuthenticationRequestData($authenticationRequestData)
    {
        $this->authenticationRequestData = $authenticationRequestData;
        return $this;
    }

    /**
     * @return AuthenticationResultData
     */
    public function getAuthenticationResultData()
    {
        return $this->authenticationResultData;
    }

    /**
     * @param AuthenticationResultData $authenticationResultData
     * @return ThreeDSResponse
     */
    public function setAuthenticationResultData($authenticationResultData)
    {
        $this->authenticationResultData = $authenticationResultData;
        return $this;
    }
}
