<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for offers resource
 */
class Services_Paymill_Offers extends Services_Paymill_Base
{

    /**
     * Paymill API offers resource relative path name
     * 
     * @var string
     */
    protected $_serviceResource = 'offers/';

}