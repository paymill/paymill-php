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
     * Returns an array of parameters customized for the argumented methodname
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
                $parameterArray['checksum_type'] = $this->getChecksumType();
                $parameterArray['amount']        = $this->getAmount();
                $parameterArray['currency']      = $this->getCurrency();
                $parameterArray['description']   = $this->getDescription();
                break;
        }

        return $parameterArray;
    }
}
