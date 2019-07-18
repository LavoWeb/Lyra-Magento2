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

class ExtendedResponseRequest
{
    /**
     * @var boolean $isNsuRequested
     */
    private $isNsuRequested = null;

    /**
     * @var boolean $isWalletRequested
     */
    private $isWalletRequested = null;

    /**
     * @var boolean $isBankLabelRequested
     */
    private $isBankLabelRequested = null;

    /**
     * @return boolean
     */
    public function getIsNsuRequested()
    {
        return $this->isNsuRequested;
    }

    /**
     * @param boolean $isNsuRequested
     * @return ExtendedResponseRequest
     */
    public function setIsNsuRequested($isNsuRequested)
    {
        $this->isNsuRequested = $isNsuRequested;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsWalletRequested()
    {
        return $this->isWalletRequested;
    }

    /**
     * @param boolean $isWalletRequested
     * @return ExtendedResponseRequest
     */
    public function setIsWalletRequested($isWalletRequested)
    {
        $this->isWalletRequested = $isWalletRequested;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getIsBankLabelRequested()
    {
        return $this->isBankLabelRequested;
    }

    /**
     * @param boolean $isBankLabelRequested
     * @return ExtendedResponseRequest
     */
    public function setIsBankLabelRequested($isBankLabelRequested)
    {
        $this->isBankLabelRequested = $isBankLabelRequested;
        return $this;
    }
}
