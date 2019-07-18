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

class ThreeDSRequest
{
    /**
     * @var ThreeDSMode $mode
     */
    private $mode = null;

    /**
     * @var string $requestId
     */
    private $requestId = null;

    /**
     * @var string $pares
     */
    private $pares = null;

    /**
     * @var string $brand
     */
    private $brand = null;

    /**
     * @var string $enrolled
     */
    private $enrolled = null;

    /**
     * @var string $status
     */
    private $status = null;

    /**
     * @var string $eci
     */
    private $eci = null;

    /**
     * @var string $xid
     */
    private $xid = null;

    /**
     * @var string $cavv
     */
    private $cavv = null;

    /**
     * @var string $algorithm
     */
    private $algorithm = null;

    /**
     * @var MpiExtensionRequest $mpiExtension
     */
    private $mpiExtension = null;

    /**
     * @return ThreeDSMode
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param ThreeDSMode $mode
     * @return ThreeDSRequest
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param string $requestId
     * @return ThreeDSRequest
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @return string
     */
    public function getPares()
    {
        return $this->pares;
    }

    /**
     * @param string $pares
     * @return ThreeDSRequest
     */
    public function setPares($pares)
    {
        $this->pares = $pares;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return ThreeDSRequest
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return string
     */
    public function getEnrolled()
    {
        return $this->enrolled;
    }

    /**
     * @param string $enrolled
     * @return ThreeDSRequest
     */
    public function setEnrolled($enrolled)
    {
        $this->enrolled = $enrolled;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return ThreeDSRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getEci()
    {
        return $this->eci;
    }

    /**
     * @param string $eci
     * @return ThreeDSRequest
     */
    public function setEci($eci)
    {
        $this->eci = $eci;
        return $this;
    }

    /**
     * @return string
     */
    public function getXid()
    {
        return $this->xid;
    }

    /**
     * @param string $xid
     * @return ThreeDSRequest
     */
    public function setXid($xid)
    {
        $this->xid = $xid;
        return $this;
    }

    /**
     * @return string
     */
    public function getCavv()
    {
        return $this->cavv;
    }

    /**
     * @param string $cavv
     * @return ThreeDSRequest
     */
    public function setCavv($cavv)
    {
        $this->cavv = $cavv;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    /**
     * @param string $algorithm
     * @return ThreeDSRequest
     */
    public function setAlgorithm($algorithm)
    {
        $this->algorithm = $algorithm;
        return $this;
    }

    /**
     * @return MpiExtensionRequest
     */
    public function getMpiExtension()
    {
        return $this->mpiExtension;
    }

    /**
     * @param MpiExtensionRequest $mpiExtension
     * @return ThreeDSRequest
     */
    public function setMpiExtension($mpiExtension)
    {
        $this->mpiExtension = $mpiExtension;
        return $this;
    }
}
