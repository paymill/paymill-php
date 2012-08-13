<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for creditcards resource
 */
class Services_Paymill_Creditcards extends Services_Paymill_Base
{

    /**
     * Paymill API creditcards resource relative path name
     * 
     * @var string
     */
    protected $_serviceResource = 'creditcards/';


    /**
     * Rest PUT verb not supported
     *
     * @param null $identifier
     * @return array|void
     * @throws Services_Paymill_Exception
     */
    public function update($identifier = null) {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }
}