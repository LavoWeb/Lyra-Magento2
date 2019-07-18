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

class UpdatePaymentDetailsResponse extends WsResponse
{
    /**
     * @var UpdatePaymentDetailsResult $updatePaymentDetailsResult
     */
    private $updatePaymentDetailsResult = null;

    /**
     * @return UpdatePaymentDetailsResult
     */
    public function getUpdatePaymentDetailsResult()
    {
        return $this->updatePaymentDetailsResult;
    }

    /**
     * @param UpdatePaymentDetailsResult $updatePaymentDetailsResult
     * @return UpdatePaymentDetailsResponse
     */
    public function setUpdatePaymentDetailsResult($updatePaymentDetailsResult)
    {
        $this->updatePaymentDetailsResult = $updatePaymentDetailsResult;
        return $this;
    }
}
