<?php
/**
 * Copyright © Lyra Network.
 * This file is part of Lyra Collect plugin for Magento 2. See COPYING.md for license details.
 *
 * @author    Lyra Network (https://www.lyra.com/)
 * @copyright Lyra Network
 * @license   https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
namespace Lyranetwork\Lyra\Helper;

use Lyranetwork\Lyra\Model\Api\LyraApi;

class Rest
{

    /**
     *
     * @var \Lyranetwork\Lyra\Helper\Data
     */
    protected $dataHelper;

    /**
     *
     * @var \Lyranetwork\Lyra\Model\Method\Lyra
     */
    protected $method;

    /**
     *
     * @param \Lyranetwork\Lyra\Helper\Data $dataHelper
     * @param \Magento\Payment\Helper\Data $magentoPaymentHelper
     */
    public function __construct(
        \Lyranetwork\Lyra\Helper\Data $dataHelper,
        \Magento\Payment\Helper\Data $magentoPaymentHelper
    ) {
        $this->dataHelper = $dataHelper;
        $this->method = $magentoPaymentHelper->getMethodInstance(\Lyranetwork\Lyra\Helper\Data::METHOD_STANDARD);
    }

    public function convertRestResult($answer)
    {
        if (!is_array($answer) || empty($answer)) {
            return [];
        }

        $transactions = $this->getProperty($answer, 'transactions');

        if (! is_array($transactions) || empty($transactions)) {
            return [];
        }

        $transaction = $transactions[0];

        $response = [];

        $response['vads_result'] = $this->getProperty($transaction, 'errorCode') ? $this->getProperty($transaction, 'errorCode') : '00';
        $response['vads_extra_result'] = $this->getProperty($transaction, 'detailedErrorCode');

        $response['vads_trans_status'] = $this->getProperty($transaction, 'detailedStatus');
        $response['vads_trans_uuid'] = $this->getProperty($transaction, 'uuid');
        $response['vads_operation_type'] = $this->getProperty($transaction, 'operationType');
        $response['vads_effective_creation_date'] = $this->getProperty($transaction, 'creationDate');
        $response['vads_payment_config'] = 'SINGLE'; // Only single payments are possible via REST API at this time.

        if (($customer = $this->getProperty($answer, 'customer')) && ($billingDetails = $this->getProperty($customer, 'billingDetails'))) {
            $response['vads_language'] = $this->getProperty($billingDetails, 'language');
        }

        $response['vads_amount'] = $this->getProperty($transaction, 'amount');
        $response['vads_currency'] = LyraApi::getCurrencyNumCode($this->getProperty($transaction, 'currency'));

        if ($orderDetails = $this->getProperty($answer, 'orderDetails')) {
            $response['vads_order_id'] = $this->getProperty($orderDetails, 'orderId');
        }

        if (($metadata = $this->getProperty($transaction, 'metadata')) && is_array($metadata)) {
            foreach ($metadata as $key => $value) {
                $response['vads_ext_info_' . $key] = $value;
            }
        }

        if ($transactionDetails = $this->getProperty($transaction, 'transactionDetails')) {
            $response['vads_sequence_number'] = $this->getProperty($transactionDetails, 'sequenceNumber');
            $response['vads_effective_amount'] = $this->getProperty($transactionDetails, 'effectiveAmount');
            $response['vads_effective_currency'] = LyraApi::getCurrencyNumCode($this->getProperty($transactionDetails, 'effectiveCurrency'));
            $response['vads_warranty_result'] = $this->getProperty($transactionDetails, 'liabilityShift');

            if ($cardDetails = $this->getProperty($transactionDetails, 'cardDetails')) {
                $response['vads_trans_id'] = $this->getProperty($cardDetails, 'legacyTransId'); // Deprecated.
                $response['vads_presentation_date'] = $this->getProperty($cardDetails, 'expectedCaptureDate');

                $response['vads_card_brand'] = $this->getProperty($cardDetails, 'effectiveBrand');
                $response['vads_card_number'] = $this->getProperty($cardDetails, 'pan');
                $response['vads_expiry_month'] = $this->getProperty($cardDetails, 'expiryMonth');
                $response['vads_expiry_year'] = $this->getProperty($cardDetails, 'expiryYear');

                if ($authorizationResponse = $this->getProperty($cardDetails, 'authorizationResponse')) {
                    $response['vads_auth_result'] = $this->getProperty($authorizationResponse, 'authorizationResult');
                }

                if (($threeDSResponse = $this->getProperty($cardDetails, 'threeDSResponse'))
                    && ($authenticationResultData = $this->getProperty($threeDSResponse, 'authenticationResultData'))) {
                    $response['vads_threeds_cavv'] = $this->getProperty($authenticationResultData, 'cavv');
                    $response['vads_threeds_status'] = $this->getProperty($authenticationResultData, 'status');
                }
            }

            if ($fraudManagement = $this->getProperty($transactionDetails, 'fraudManagement')) {
                if ($riskControl = $this->getProperty($fraudManagement, 'riskControl')) {
                    $response['vads_risk_control'] = '';

                    foreach ($riskControl as $key => $value) {
                        $response['vads_risk_control'] .= "$key=$value;";
                    }
                }

                if ($riskAssessments = $this->getProperty($fraudManagement, 'riskAssessments')) {
                    $response['vads_risk_assessment_result'] = $this->getProperty($riskAssessments, 'results');
                }
            }
        }

        return $response;
    }

    private function getProperty($restResult, $key)
    {
        if (isset($restResult[$key])) {
            return $restResult[$key];
        }

        return null;
    }

    public function checkResponseFormat($data)
    {
        return isset($data['kr-hash']) && isset($data['kr-hash-algorithm']) && isset($data['kr-answer']);
    }

    public function checkResponseHash($data, $key)
    {
        $supportedSignAlgos = array('sha256_hmac');

        // Check if the hash algorithm is supported.
        if (! in_array($data['kr-hash-algorithm'], $supportedSignAlgos)) {
            $this->dataHelper->log('Hash algorithm is not supported: ' . $data['kr-hash-algorithm'], \Psr\Log\LogLevel::ERROR);
            return false;
        }

        // On some servers, / can be escaped.
        $krAnswer = str_replace('\/', '/', $data['kr-answer']);

        $hash = hash_hmac('sha256', $krAnswer, $key);

        // Return true if calculated hash and sent hash are the same.
        return ($hash === $data['kr-hash']);
    }

    /**
     * Get REST API SHA 256 return key.
     *
     * @return string
     */
    public function getReturnKey($storeId = null)
    {
        $test = $this->dataHelper->getCommonConfigData('ctx_mode', $storeId);
        return $this->method->getConfigData($test ? 'rest_return_key_test' : 'rest_return_key_prod', $storeId);
    }

    /**
     * Get REST API private key.
     *
     * @return string
     */
    public function getPrivateKey($storeId = null)
    {
        $test = $this->dataHelper->getCommonConfigData('ctx_mode', $storeId);
        return $this->method->getConfigData($test ? 'rest_private_key_test' : 'rest_private_key_prod', $storeId);
    }
}
