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

class ShippingDetailsRequest
{
    /**
     * @var CustStatus $type
     */
    private $type = null;

    /**
     * @var string $firstName
     */
    private $firstName = null;

    /**
     * @var string $lastName
     */
    private $lastName = null;

    /**
     * @var string $phoneNumber
     */
    private $phoneNumber = null;

    /**
     * @var string $streetNumber
     */
    private $streetNumber = null;

    /**
     * @var string $address
     */
    private $address = null;

    /**
     * @var string $address2
     */
    private $address2 = null;

    /**
     * @var string $district
     */
    private $district = null;

    /**
     * @var string $zipCode
     */
    private $zipCode = null;

    /**
     * @var string $city
     */
    private $city = null;

    /**
     * @var string $state
     */
    private $state = null;

    /**
     * @var string $country
     */
    private $country = null;

    /**
     * @var string $deliveryCompanyName
     */
    private $deliveryCompanyName = null;

    /**
     * @var DeliverySpeed $shippingSpeed
     */
    private $shippingSpeed = null;

    /**
     * @var DeliveryType $shippingMethod
     */
    private $shippingMethod = null;

    /**
     * @var string $legalName
     */
    private $legalName = null;

    /**
     * @var string $identityCode
     */
    private $identityCode = null;

    /**
     * @return CustStatus
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param CustStatus $type
     * @return ShippingDetailsRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return ShippingDetailsRequest
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return ShippingDetailsRequest
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return ShippingDetailsRequest
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     * @return ShippingDetailsRequest
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return ShippingDetailsRequest
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return ShippingDetailsRequest
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return ShippingDetailsRequest
     */
    public function setDistrict($district)
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return ShippingDetailsRequest
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return ShippingDetailsRequest
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return ShippingDetailsRequest
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return ShippingDetailsRequest
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getDeliveryCompanyName()
    {
        return $this->deliveryCompanyName;
    }

    /**
     * @param string $deliveryCompanyName
     * @return ShippingDetailsRequest
     */
    public function setDeliveryCompanyName($deliveryCompanyName)
    {
        $this->deliveryCompanyName = $deliveryCompanyName;
        return $this;
    }

    /**
     * @return DeliverySpeed
     */
    public function getShippingSpeed()
    {
        return $this->shippingSpeed;
    }

    /**
     * @param DeliverySpeed $shippingSpeed
     * @return ShippingDetailsRequest
     */
    public function setShippingSpeed($shippingSpeed)
    {
        $this->shippingSpeed = $shippingSpeed;
        return $this;
    }

    /**
     * @return DeliveryType
     */
    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    /**
     * @param DeliveryType $shippingMethod
     * @return ShippingDetailsRequest
     */
    public function setShippingMethod($shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
        return $this;
    }

    /**
     * @return string
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * @param string $legalName
     * @return ShippingDetailsRequest
     */
    public function setLegalName($legalName)
    {
        $this->legalName = $legalName;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentityCode()
    {
        return $this->identityCode;
    }

    /**
     * @param string $identityCode
     * @return ShippingDetailsRequest
     */
    public function setIdentityCode($identityCode)
    {
        $this->identityCode = $identityCode;
        return $this;
    }
}
