<?php

namespace Paymill\Models\Request;

/**
 * Checksum Model
 *
 * A checksum validation is a simple method to nearly ensure the integrity of transferred data.
 * Basically we generate a hash out of the over given parameters and your private key.
 * If you send us a request with transaction data and the generated checksum, we can easily validate the data
 * because we know your private key and the used hash algorithm.
 * To make the checksum computation as easy as possible we provide this endpoint for you.
 * @tutorial https://paymill.com/de-de/dokumentation/referenz/api-referenz/#document-checksum
 */
class Checksum extends Base
{
    /**
     * @var string
     */
    private $_checksumType = null;

    /**
     * @var string
     */
    private $_amount = null;

    /**
     * @var array
     */
    private $_currency = null;

    /**
     * @var array
     */
    private $_description = null;

    /**
     * @var null|string
     */
    private $_appId = null;

    /**
     * @var null|string
     */
    private $_feeAmount = null;

    /**
     * @var null|string
     */
    private $_feeCurrency = null;

    /**
     * @var null|string
     */
    private $_feePayment = null;

    /**
     * Creates an instance of the checksum request model
     */
    function __construct()
    {
        $this->_serviceResource = 'checksum/';
    }

    /**
     * @param string $amount
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * @param string $checksumType
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setChecksumType($checksumType)
    {
        $this->_checksumType = $checksumType;
        return $this;
    }

    /**
     * @return string
     *
     * @return $this
     */
    public function getChecksumType()
    {
        return $this->_checksumType;
    }

    /**
     * @param array $currency
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
        return $this;
    }

    /**
     * @return array
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param array $description
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setDescription($description)
    {
        $this->_description = $description;
        return $this;
    }

    /**
     * @return array
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param null|string $appId
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setAppId($appId)
    {
        $this->_appId = $appId;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAppId()
    {
        return $this->_appId;
    }

    /**
     * @param null|string $feeAmount
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setFeeAmount($feeAmount)
    {
        $this->_feeAmount = $feeAmount;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFeeAmount()
    {
        return $this->_feeAmount;
    }

    /**
     * @param null|string $feeCurrency
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setFeeCurrency($feeCurrency)
    {
        $this->_feeCurrency = $feeCurrency;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFeeCurrency()
    {
        return $this->_feeCurrency;
    }

    /**
     * @param null|string $feePayment
     *
     * @return \Paymill\Models\Request\Checksum
     */
    public function setFeePayment($feePayment)
    {
        $this->_feePayment = $feePayment;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFeePayment()
    {
        return $this->_feePayment;
    }

    /**
     * Returns an array of parameters customized for the given method name
     *
     * @param string $method
     *
     * @return array
     */
    public function parameterize($method)
    {
        $parameterArray = array();
        switch ($method) {
            case 'getOne':
                if($this->getChecksumType()) {
                    $parameterArray['checksum_type'] = $this->getChecksumType();
                }

                if($this->getAmount()) {
                    $parameterArray['amount']        = $this->getAmount();
                }

                if($this->getCurrency()) {
                    $parameterArray['currency']      = $this->getCurrency();
                }

                if($this->getDescription()){
                    $parameterArray['description']   = $this->getDescription();
                }

                // Unite params:

                if($this->getAppId()) {
                    $parameterArray['app_id']        = $this->getAppId();
                }

                if($this->getFeeAmount()) {
                    $parameterArray['fee_amount']    = $this->getFeeAmount();
                }

                if($this->getFeeCurrency()) {
                    $parameterArray['fee_currency']  = $this->getFeeCurrency();
                }

                if($this->getFeePayment()) {
                    $parameterArray['fee_payment']   = $this->getFeePayment();
                }

                break;
        }

        return $parameterArray;
    }
}
