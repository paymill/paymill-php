<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for transactions resource
 */
class Services_Paymill_Transactions extends Services_Paymill_Base
{
    /**
     * {@inheritDoc}
     */
    protected $_serviceResource = 'transactions/';

    /**
     * {@inheritDoc}
     */
    public function update(array $itemData = array())
    {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }

    /**
     * {@inheritDoc}
     */
    public function delete($clientId = null)
    {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }
}