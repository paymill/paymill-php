<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for creditcards resource
 */
class Services_Paymill_Creditcards extends Services_Paymill_Base
{
    /**
     * {@inheritDoc}
     */
    protected $_serviceResource = 'creditcards/';

    /**
     * {@inheritDoc}
     */
    public function update(array $itemData = array())
    {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }
}