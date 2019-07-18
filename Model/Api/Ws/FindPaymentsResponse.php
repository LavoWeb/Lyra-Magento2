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

class FindPaymentsResponse extends WsResponse
{
    /**
     * @var FindPaymentsResult $findPaymentsResult
     */
    private $findPaymentsResult = null;

    /**
     * @return FindPaymentsResult
     */
    public function getFindPaymentsResult()
    {
        return $this->findPaymentsResult;
    }

    /**
     * @param FindPaymentsResult $findPaymentsResult
     * @return FindPaymentsResponse
     */
    public function setFindPaymentsResult($findPaymentsResult)
    {
        $this->findPaymentsResult = $findPaymentsResult;
        return $this;
    }
}
