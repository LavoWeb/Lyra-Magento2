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

class UpdateRefundResponse extends WsResponse
{
    /**
     * @var UpdateRefundResult $updateRefundResult
     */
    private $updateRefundResult = null;

    /**
     * @return UpdateRefundResult
     */
    public function getUpdateRefundResult()
    {
        return $this->updateRefundResult;
    }

    /**
     * @param UpdateRefundResult $updateRefundResult
     * @return UpdateRefundResponse
     */
    public function setUpdateRefundResult($updateRefundResult)
    {
        $this->updateRefundResult = $updateRefundResult;
        return $this;
    }
}
