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
     * Different checksum types which will enable different validations for
     * the input parameters.
     */
    const TYPE_PAYPAL = 'paypal';

    /**
     * Different checksum actions which will enable different validations for
     * the input parameters.
     */
    const ACTION_PAYMENT = 'payment';
    const ACTION_TRANSACTION = 'transaction';

    /**
     * Checksum type
     *
     * @var string
     */
    private $_checksumType = null;

    /**
     * Checksum action
     *
     * @var string
     */
    private $_checksumAction = null;

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
     * @var string
     */
    private $_returnUrl = null;

    /**
     * @var string
     */
    private $_cancelUrl = null;

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
     * Shipping address
     *
     * @var array $_shippingAddress
     */
    private $_shippingAddress;

    /**
     * Billing address
     *
     * @var array $_billingAddress
     */
    private $_billingAddress;

    /**
     * Items
     *
     * @var array $_items
     */
    private $_items;

    /**
     * Shipping amount
     *
     * @var int $_shipping_amount
     */
    private $_shipping_amount;

    /**
     * Handling amount
     *
     * @var int $_handling_amount
     */
    private $_handling_amount;

    /**
     * Client identifier 
     * 
     * @var string $_client
     */
    private $_client;

    /**
     * Reusable payment
     *
     * @var bool $_requireReusablePayment
     */
    private $_requireReusablePayment;

    /**
     * Reusable payment description
     *
     * @var string $_reusablePaymentDescription
     */
    private $_reusablePaymentDescription;

    /**
     * Creates an instance of the checksum request model
     */
    function __construct()
    {
        $this->_serviceResource = 'checksums/';
    }

    /**
     * Sets the identifier of the Client for the transaction
     * 
     * @param string $clientId Client identifier
     * 
     * @return $this
     */
    public function setClient($client)
    {
        $this->_client = $client;

        return $this;
    }

    /**
     * Returns the identifier of the Client associated with the checksum. If no client is available null will be returned
     * 
     * @return string
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Set amount
     *
     * @param string $amount Amount in s the smallest unit (e.g. Cent)
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string Amount in s the smallest unit (e.g. Cent)
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Set checksum type
     *
     * @param string $checksumType
     *
     * @return $this
     */
    public function setChecksumType($checksumType)
    {
        $this->_checksumType = $checksumType;

        return $this;
    }

    /**
     * Get checksum type
     *
     * @return string
     *
     * @return $this
     */
    public function getChecksumType()
    {
        return $this->_checksumType;
    }

    /**
     * Get checksum action
     *
     * @return string
     */
    public function getChecksumAction()
    {
        return $this->_checksumAction;
    }

    /**
     * Set checksum action
     *
     * @param string $checksumAction Checksum action
     *
     * @return $this
     */
    public function setChecksumAction($checksumAction)
    {
        $this->_checksumAction = $checksumAction;

        return $this;
    }

    /**
     * Set currency
     *
     * @param string $currency (alpha 3)
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string (alpha 3)
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->_description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Get return url
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->_returnUrl;
    }

    /**
     * Set return url
     *
     * @param string $returnUrl return url
     *
     * @return $this
     */
    public function setReturnUrl($returnUrl)
    {
        $this->_returnUrl = $returnUrl;

        return $this;
    }

    /**
     * Get cancel url
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->_cancelUrl;
    }

    /**
     * Set cancel url
     *
     * @param string $cancelUrl cancel url
     *
     * @return $this
     */
    public function setCancelUrl($cancelUrl)
    {
        $this->_cancelUrl = $cancelUrl;

        return $this;
    }

    /**
     * Set app ID
     *
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
     * Get app Id
     *
     * @return null|string
     */
    public function getAppId()
    {
        return $this->_appId;
    }

    /**
     * Set fee amount
     *
     * @param null|string $feeAmount
     *
     * @return $this
     */
    public function setFeeAmount($feeAmount)
    {
        $this->_feeAmount = $feeAmount;

        return $this;
    }

    /**
     * Get fee amount
     *
     * @return null|string
     */
    public function getFeeAmount()
    {
        return $this->_feeAmount;
    }

    /**
     * Set fee currency
     *
     * @param null|string $feeCurrency
     *
     * @return $this
     */
    public function setFeeCurrency($feeCurrency)
    {
        $this->_feeCurrency = $feeCurrency;

        return $this;
    }

    /**
     * Get fee currency
     *
     * @return null|string
     */
    public function getFeeCurrency()
    {
        return $this->_feeCurrency;
    }

    /**
     * Set fee payment
     *
     * @param null|string $feePayment
     *
     * @return $this
     */
    public function setFeePayment($feePayment)
    {
        $this->_feePayment = $feePayment;

        return $this;
    }

    /**
     * get fee payment
     *
     * @return null|string
     */
    public function getFeePayment()
    {
        return $this->_feePayment;
    }

    /**
     * Get shipping address
     *
     * @return array
     */
    public function getShippingAddress()
    {
        return $this->_shippingAddress;
    }

    /**
     * Set shipping address
     *
     * @param array $shippingAddress Shipping address
     *
     * @return $this
     */
    public function setShippingAddress(array $shippingAddress)
    {
        $this->_shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * Get billing address
     *
     * @return array
     */
    public function getBillingAddress()
    {
        return $this->_billingAddress;
    }

    /**
     * Set billing address
     *
     * @param array $billingAddress Billing address
     *
     * @return $this
     */
    public function setBillingAddress(array $billingAddress)
    {
        $this->_billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * Set items
     *
     * @param array $items Items
     *
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->_items = $items;

        return $this;
    }

    /**
     * Get shipping amount
     *
     * @return int
     */
    public function getShippingAmount()
    {
        return $this->_shipping_amount;
    }

    /**
     * Set shipping_amount
     *
     * @param int $shipping_amount Shipping amount
     *
     * @return $this
     */
    public function setShippingAmount($shipping_amount)
    {
        $this->_shipping_amount = $shipping_amount;

        return $this;
    }

    /**
     * Get handling amount
     *
     * @return int
     */
    public function getHandlingAmount()
    {
        return $this->_handling_amount;
    }

    /**
     * Set handling amount
     *
     * @param int $handling_amount Handling amount
     *
     * @return $this
     */
    public function setHandlingAmount($handling_amount)
    {
        $this->_handling_amount = $handling_amount;

        return $this;
    }

    /**
     * Get require reusable payment
     *
     * @return bool
     */
    public function getRequireReusablePayment()
    {
        return $this->_requireReusablePayment;
    }

    /**
     * Set require reusable payment
     *
     * @param bool $requireReusablePayment Reusable payment
     *
     * @return $this
     */
    public function setRequireReusablePayment($requireReusablePayment)
    {
        $this->_requireReusablePayment = $requireReusablePayment;

        return $this;
    }

    /**
     * Get reusable payment description
     *
     * @return string
     */
    public function getReusablePaymentDescription()
    {
        return $this->_reusablePaymentDescription;
    }

    /**
     * Set reusable payment description
     *
     * @param string $reusablePaymentDescription Reusable payment description
     *
     * @return $this
     */
    public function setReusablePaymentDescription($reusablePaymentDescription)
    {
        $this->_reusablePaymentDescription = $reusablePaymentDescription;

        return $this;
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
                $parameterArray['count'] = 1;
                $parameterArray['offset'] = 0;
                break;
            case 'getAll':
                $parameterArray = $this->getFilter();
                break;
            case 'create':
                if($this->getChecksumType()) {
                    $parameterArray['checksum_type'] = $this->getChecksumType();
                }

                if($this->getChecksumAction()) {
                    $parameterArray['checksum_action'] = $this->getChecksumAction();
                }

                if($this->getAmount()) {
                    $parameterArray['amount'] = $this->getAmount();
                }

                if($this->getCurrency()) {
                    $parameterArray['currency'] = $this->getCurrency();
                }

                if($this->getDescription()){
                    $parameterArray['description'] = $this->getDescription();
                }

                if($this->getReturnUrl()){
                    $parameterArray['return_url'] = $this->getReturnUrl();
                }

                if($this->getCancelUrl()){
                    $parameterArray['cancel_url'] = $this->getCancelUrl();
                }

                if($this->getShippingAddress()) {
                    $parameterArray['shipping_address'] = $this->getShippingAddress();
                }

                if($this->getBillingAddress()) {
                    $parameterArray['billing_address'] = $this->getBillingAddress();
                }

                if($this->getItems()) {
                    $parameterArray['items'] = $this->getItems();
                }

                if($this->getShippingAmount()) {
                    $parameterArray['shipping_amount'] = $this->getShippingAmount();
                }

                if($this->getHandlingAmount()) {
                    $parameterArray['handling_amount'] = $this->getHandlingAmount();
                }

                if($this->getRequireReusablePayment()) {
                    $parameterArray['require_reusable_payment'] = $this->getRequireReusablePayment();
                }

                if($this->getReusablePaymentDescription()) {
                    $parameterArray['reusable_payment_description'] = $this->getReusablePaymentDescription();
                }

                if($this->getClient()) {
                    $parameterArray['client'] = $this->getClient();
                }

                // Unite params:

                if($this->getAppId()) {
                    $parameterArray['app_id'] = $this->getAppId();
                }

                if($this->getFeeAmount()) {
                    $parameterArray['fee_amount'] = $this->getFeeAmount();
                }

                if($this->getFeeCurrency()) {
                    $parameterArray['fee_currency'] = $this->getFeeCurrency();
                }

                if($this->getFeePayment()) {
                    $parameterArray['fee_payment'] = $this->getFeePayment();
                }

                break;
        }

        return $parameterArray;
    }
}
