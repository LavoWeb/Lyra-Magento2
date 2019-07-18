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

class CheckThreeDSAuthenticationResponse extends WsResponse
{
    /**
     * @var CheckThreeDSAuthenticationResult $checkThreeDSAuthenticationResult
     */
    private $checkThreeDSAuthenticationResult = null;

    /**
     * @return CheckThreeDSAuthenticationResult
     */
    public function getCheckThreeDSAuthenticationResult()
    {
        return $this->checkThreeDSAuthenticationResult;
    }

    /**
     * @param CheckThreeDSAuthenticationResult $checkThreeDSAuthenticationResult
     * @return CheckThreeDSAuthenticationResponse
     */
    public function setCheckThreeDSAuthenticationResult($checkThreeDSAuthenticationResult)
    {
        $this->checkThreeDSAuthenticationResult = $checkThreeDSAuthenticationResult;
        return $this;
    }
}
