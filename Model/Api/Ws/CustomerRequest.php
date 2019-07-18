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

class CustomerRequest
{
    /**
     * @var BillingDetailsRequest $billingDetails
     */
    private $billingDetails = null;

    /**
     * @var ShippingDetailsRequest $shippingDetails
     */
    private $shippingDetails = null;

    /**
     * @var ExtraDetailsRequest $extraDetails
     */
    private $extraDetails = null;

    /**
     * @return BillingDetailsRequest
     */
    public function getBillingDetails()
    {
        return $this->billingDetails;
    }

    /**
     * @param BillingDetailsRequest $billingDetails
     * @return CustomerRequest
     */
    public function setBillingDetails($billingDetails)
    {
        $this->billingDetails = $billingDetails;
        return $this;
    }

    /**
     * @return ShippingDetailsRequest
     */
    public function getShippingDetails()
    {
        return $this->shippingDetails;
    }

    /**
     * @param ShippingDetailsRequest $shippingDetails
     * @return CustomerRequest
     */
    public function setShippingDetails($shippingDetails)
    {
        $this->shippingDetails = $shippingDetails;
        return $this;
    }

    /**
     * @return ExtraDetailsRequest
     */
    public function getExtraDetails()
    {
        return $this->extraDetails;
    }

    /**
     * @param ExtraDetailsRequest $extraDetails
     * @return CustomerRequest
     */
    public function setExtraDetails($extraDetails)
    {
        $this->extraDetails = $extraDetails;
        return $this;
    }
}
