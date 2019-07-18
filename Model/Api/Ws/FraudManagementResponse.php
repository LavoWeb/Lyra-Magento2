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

class FraudManagementResponse
{
    /**
     * @var RiskControl[] $riskControl
     */
    private $riskControl = null;

    /**
     * @var RiskAnalysis[] $riskAnalysis
     */
    private $riskAnalysis = null;

    /**
     * @var RiskAssessments $riskAssessments
     */
    private $riskAssessments = null;

    /**
     * @return RiskControl[]
     */
    public function getRiskControl()
    {
        return $this->riskControl;
    }

    /**
     * @param RiskControl[] $riskControl
     * @return FraudManagementResponse
     */
    public function setRiskControl(array $riskControl = null)
    {
        $this->riskControl = $riskControl;
        return $this;
    }

    /**
     * @return RiskAnalysis[]
     */
    public function getRiskAnalysis()
    {
        return $this->riskAnalysis;
    }

    /**
     * @param RiskAnalysis[] $riskAnalysis
     * @return FraudManagementResponse
     */
    public function setRiskAnalysis(array $riskAnalysis = null)
    {
        $this->riskAnalysis = $riskAnalysis;
        return $this;
    }

    /**
     * @return RiskAssessments
     */
    public function getRiskAssessments()
    {
        return $this->riskAssessments;
    }

    /**
     * @param RiskAssessments $riskAssessments
     * @return FraudManagementResponse
     */
    public function setRiskAssessments($riskAssessments)
    {
        $this->riskAssessments = $riskAssessments;
        return $this;
    }
}
