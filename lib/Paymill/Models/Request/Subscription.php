<?php

namespace Paymill\Models\Request;

/**
 * Subscription Model
 * Subscriptions allow you to charge recurring payments on a client’s credit card / to a client’s direct debit.
 * A subscription connects a client to the offers-object. A client can have several subscriptions to different offers,
 * but only one subscription to the same offer.
 * @todo does this still apply?
 * @tutorial https://paymill.com/de-de/dokumentation/referenz/api-referenz/#document-subscriptions
 */
class Subscription extends Base
{

    /**
     * @var string
     */
    private $_name;

    /**
     * @var int
     */
    private $_amount;

    /**
     * @var string
     */
    private $_currency;

    /**
     * @var string
     */
    private $_interval;

    /**
     * @var string
     */
    private $_offer;
    
    /**
     * @var boolean
     */
    private $_cancelAtPeriodEnd;
    
    /**
     * @var string
     */
    private $_payment;
    
    /**
     * @var string
     */
    private $_client;
    
    /**
     * @var integer
     */
    private $_startAt;

    /**
     * @var string
     */
    private $_periodOfValidity;

    /**
     * @var boolean
     */
    private $_pause;

    /**
     * Creates an instance of the subscription request model
     */
    public function __construct()
    {
        $this->_serviceResource = 'Subscriptions/';
    }


    /**
     * Returns name of subscription
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets name of the subscription
     * @param $name string
     * @return \Paymill\Models\Request\Subscription
     */
    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    /**
     * Returns the amount as an integer
     * @return integer
     */
    public function getAmount()
    {
        return $this->_amount;
    }

    /**
     * Sets the amount.
     * Every interval the specified amount will be charged. Only integer values are allowed (e.g. 42.00 = 4200)
     * @param integer $amount
     * @return \Paymill\Models\Request\Subscription
     */
    public function setAmount($amount)
    {
        $this->_amount = (int) $amount;
        return $this;
    }

    /**
     * Returns the interval defining how often the client should be charged.
     * @return string
     */
    public function getInterval()
    {
        return $this->_interval;
    }

    /**
     * Sets the interval defining how often the client should be charged.
     * Additionally a special day of the week can be appended (unless daily interval)
     * @example Format: number DAY | WEEK | MONTH | YEAR [, MONDAY | TUESDAY | ... | SUNDAY] Example: 3 WEEK, MONDAY
     * @param string $interval
     * @return \Paymill\Models\Request\Subscription
     */
    public function setInterval($interval)
    {
        $this->_interval = $interval;
        return $this;
    }

    /**
     * Returns the currency
     * @return string
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * Sets the currency
     * @param string $currency
     * @return \Paymill\Models\Request\Subscription
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
        return $this;
    }


    public function getOffer()
    {
        return $this->_offer;
    }

    /**
     * Sets the identifier of the offer the subscription is based on
     * @param string $offer
     * @return \Paymill\Models\Request\Subscription
     */
    public function setOffer($offer)
    {
        $this->_offer = $offer;
        return $this;
    }

    /**
     * Returns the identifier of the payment object registered with this subscription
     * @return string
     */
    public function getPayment()
    {
        return $this->_payment;
    }

    /**
     * Sets the identifier of the payment object registered with this subscription
     * @param string $payment
     * @return \Paymill\Models\Request\Subscription
     */
    public function setPayment($payment)
    {
        $this->_payment = $payment;
        return $this;
    }

    /**
     * Returns the id of the client associated with this subscription
     * @return string
     */
    public function getClient()
    {
        return $this->_client;
    }

    /**
     * Sets the id of the client associated with this subscription
     * @param string $client
     * @return \Paymill\Models\Request\Subscription
     */
    public function setClient($client)
    {
        $this->_client = $client;
        return $this;
    }

    /**
     * Returns the Unix-Timestamp for the trial period start
     * @return integer
     */
    public function getStartAt()
    {
        return $this->_startAt;
    }

    /**
     * Sets the Unix-Timestamp for the trial period start
     * @param integer $startAt
     * @return \Paymill\Models\Request\Subscription
     */
    public function setStartAt($startAt)
    {
        $this->_startAt = $startAt;
        return $this;
    }

    /**
     * Sets the period of validity the subscriptions shall be active (starting creation date)
     * @param $periodOfValidity string
     * @return \Paymill\Models\Request\Subscription
     */
    public function setPeriodOfValidity($periodOfValidity)
    {
        $this->_periodOfValidity = $periodOfValidity;
        return $this;
    }

    /**
     * Returns if subscription is paused or not
     * @return boolean
     */
    public function getPause()
    {
        return $this->_pause;
    }

    /**
     * Sets the state of subscription to paused or unpaused
     * @param $pause boolean
     * @return \Paymill\Models\Request\Subscription
     */
    public function setPause($pause)
    {
        $this->_pause = $pause;
        return $this;
    }

    /**
     * Returns an array of parameters customized for the argumented methodname
     * @param string $method
     * @return array
     */
    public function parameterize($method)
    {
        $parameterArray = array();
        switch ($method) {
            case 'create':
                $parameterArray['client'] = $this->getClient();
                $parameterArray['offer'] = $this->getOffer();
                $parameterArray['payment'] = $this->getPayment();
                $parameterArray['start_at'] = $this->getStartAt();
                $parameterArray['amount'] = $this->getAmount();
                $parameterArray['currency'] = $this->getCurrency();
                $parameterArray['interval'] = $this->getInterval();
                $parameterArray['name'] = $this->getName();
                break;
            case 'update':
                $parameterArray['offer'] = $this->getOffer();
                $parameterArray['payment'] = $this->getPayment();
                $parameterArray['amount'] = $this->getAmount();
                $parameterArray['currency'] = $this->getCurrency();
                $parameterArray['interval'] = $this->getInterval();
                $parameterArray['name'] = $this->getName();
                $parameterArray['pause'] = $this->getPause();
                break;
            case 'getOne':
                $parameterArray['count'] = 1;
                $parameterArray['offset'] = 0;
                break;
            case 'getAll':
                 $parameterArray = $this->getFilter();
                break;
            case 'delete':
                $parameterArray = $this->getFilter();
                break;
        }

        return $parameterArray;
    }
}
