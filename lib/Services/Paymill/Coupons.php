<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for coupons resource
 */
class Services_Paymill_Coupons extends Services_Paymill_Base
{
    public static $FIXED_VALUE = "fixed_value";
    public static $PERCENT_VALUE = "percent_value";

    /**
     * {@inheritDoc}
     */
    protected $_serviceResource = 'coupons/';

    /**
     * General REST PUT verb
     * Update resource item
     *
     * @param array $itemData
     *
     * @return array item updated or null
     */
    public function update(array $itemData = array())
    {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }
}