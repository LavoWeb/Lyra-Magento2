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

class VerifyThreeDSEnrollmentResponse extends WsResponse
{
    /**
     * @var VerifyThreeDSEnrollmentResult $verifyThreeDSEnrollmentResult
     */
    private $verifyThreeDSEnrollmentResult = null;

    /**
     * @return VerifyThreeDSEnrollmentResult
     */
    public function getVerifyThreeDSEnrollmentResult()
    {
        return $this->verifyThreeDSEnrollmentResult;
    }

    /**
     * @param VerifyThreeDSEnrollmentResult $verifyThreeDSEnrollmentResult
     * @return VerifyThreeDSEnrollmentResponse
     */
    public function setVerifyThreeDSEnrollmentResult($verifyThreeDSEnrollmentResult)
    {
        $this->verifyThreeDSEnrollmentResult = $verifyThreeDSEnrollmentResult;
        return $this;
    }
}
