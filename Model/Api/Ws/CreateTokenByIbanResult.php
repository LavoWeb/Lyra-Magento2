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

class CreateTokenByIbanResult
{
    /**
     * @var CommonResponse $commonResponse
     */
    private $commonResponse = null;

    /**
     * @var PaymentResponse $paymentResponse
     */
    private $paymentResponse = null;

    /**
     * @var OrderResponse $orderResponse
     */
    private $orderResponse = null;

    /**
     * @var CardResponse $cardResponse
     */
    private $cardResponse = null;

    /**
     * @var AuthorizationResponse $authorizationResponse
     */
    private $authorizationResponse = null;

    /**
     * @var CaptureResponse $captureResponse
     */
    private $captureResponse = null;

    /**
     * @var CustomerResponse $customerResponse
     */
    private $customerResponse = null;

    /**
     * @var MarkResponse $markResponse
     */
    private $markResponse = null;

    /**
     * @var ThreeDSResponse $threeDSResponse
     */
    private $threeDSResponse = null;

    /**
     * @var ExtraResponse $extraResponse
     */
    private $extraResponse = null;

    /**
     * @var SubscriptionResponse $subscriptionResponse
     */
    private $subscriptionResponse = null;

    /**
     * @var FraudManagementResponse $fraudManagementResponse
     */
    private $fraudManagementResponse = null;

    /**
     * @var ShoppingCartResponse $shoppingCartResponse
     */
    private $shoppingCartResponse = null;

    /**
     * @return CommonResponse
     */
    public function getCommonResponse()
    {
        return $this->commonResponse;
    }

    /**
     * @param CommonResponse $commonResponse
     * @return CreateTokenByIbanResult
     */
    public function setCommonResponse($commonResponse)
    {
        $this->commonResponse = $commonResponse;
        return $this;
    }

    /**
     * @return PaymentResponse
     */
    public function getPaymentResponse()
    {
        return $this->paymentResponse;
    }

    /**
     * @param PaymentResponse $paymentResponse
     * @return CreateTokenByIbanResult
     */
    public function setPaymentResponse($paymentResponse)
    {
        $this->paymentResponse = $paymentResponse;
        return $this;
    }

    /**
     * @return OrderResponse
     */
    public function getOrderResponse()
    {
        return $this->orderResponse;
    }

    /**
     * @param OrderResponse $orderResponse
     * @return CreateTokenByIbanResult
     */
    public function setOrderResponse($orderResponse)
    {
        $this->orderResponse = $orderResponse;
        return $this;
    }

    /**
     * @return CardResponse
     */
    public function getCardResponse()
    {
        return $this->cardResponse;
    }

    /**
     * @param CardResponse $cardResponse
     * @return CreateTokenByIbanResult
     */
    public function setCardResponse($cardResponse)
    {
        $this->cardResponse = $cardResponse;
        return $this;
    }

    /**
     * @return AuthorizationResponse
     */
    public function getAuthorizationResponse()
    {
        return $this->authorizationResponse;
    }

    /**
     * @param AuthorizationResponse $authorizationResponse
     * @return CreateTokenByIbanResult
     */
    public function setAuthorizationResponse($authorizationResponse)
    {
        $this->authorizationResponse = $authorizationResponse;
        return $this;
    }

    /**
     * @return CaptureResponse
     */
    public function getCaptureResponse()
    {
        return $this->captureResponse;
    }

    /**
     * @param CaptureResponse $captureResponse
     * @return CreateTokenByIbanResult
     */
    public function setCaptureResponse($captureResponse)
    {
        $this->captureResponse = $captureResponse;
        return $this;
    }

    /**
     * @return CustomerResponse
     */
    public function getCustomerResponse()
    {
        return $this->customerResponse;
    }

    /**
     * @param CustomerResponse $customerResponse
     * @return CreateTokenByIbanResult
     */
    public function setCustomerResponse($customerResponse)
    {
        $this->customerResponse = $customerResponse;
        return $this;
    }

    /**
     * @return MarkResponse
     */
    public function getMarkResponse()
    {
        return $this->markResponse;
    }

    /**
     * @param MarkResponse $markResponse
     * @return CreateTokenByIbanResult
     */
    public function setMarkResponse($markResponse)
    {
        $this->markResponse = $markResponse;
        return $this;
    }

    /**
     * @return ThreeDSResponse
     */
    public function getThreeDSResponse()
    {
        return $this->threeDSResponse;
    }

    /**
     * @param ThreeDSResponse $threeDSResponse
     * @return CreateTokenByIbanResult
     */
    public function setThreeDSResponse($threeDSResponse)
    {
        $this->threeDSResponse = $threeDSResponse;
        return $this;
    }

    /**
     * @return ExtraResponse
     */
    public function getExtraResponse()
    {
        return $this->extraResponse;
    }

    /**
     * @param ExtraResponse $extraResponse
     * @return CreateTokenByIbanResult
     */
    public function setExtraResponse($extraResponse)
    {
        $this->extraResponse = $extraResponse;
        return $this;
    }

    /**
     * @return SubscriptionResponse
     */
    public function getSubscriptionResponse()
    {
        return $this->subscriptionResponse;
    }

    /**
     * @param SubscriptionResponse $subscriptionResponse
     * @return CreateTokenByIbanResult
     */
    public function setSubscriptionResponse($subscriptionResponse)
    {
        $this->subscriptionResponse = $subscriptionResponse;
        return $this;
    }

    /**
     * @return FraudManagementResponse
     */
    public function getFraudManagementResponse()
    {
        return $this->fraudManagementResponse;
    }

    /**
     * @param FraudManagementResponse $fraudManagementResponse
     * @return CreateTokenByIbanResult
     */
    public function setFraudManagementResponse($fraudManagementResponse)
    {
        $this->fraudManagementResponse = $fraudManagementResponse;
        return $this;
    }

    /**
     * @return ShoppingCartResponse
     */
    public function getShoppingCartResponse()
    {
        return $this->shoppingCartResponse;
    }

    /**
     * @param ShoppingCartResponse $shoppingCartResponse
     * @return CreateTokenByIbanResult
     */
    public function setShoppingCartResponse($shoppingCartResponse)
    {
        $this->shoppingCartResponse = $shoppingCartResponse;
        return $this;
    }
}
