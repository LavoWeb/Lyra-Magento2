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

class CreatePaymentResponse extends WsResponse
{
    /**
     * @var CreatePaymentResult $createPaymentResult
     */
    private $createPaymentResult = null;

    /**
     * @return CreatePaymentResult
     */
    public function getCreatePaymentResult()
    {
        return $this->createPaymentResult;
    }

    /**
     * @param CreatePaymentResult $createPaymentResult
     * @return CreatePaymentResponse
     */
    public function setCreatePaymentResult($createPaymentResult)
    {
        $this->createPaymentResult = $createPaymentResult;
        return $this;
    }
}
