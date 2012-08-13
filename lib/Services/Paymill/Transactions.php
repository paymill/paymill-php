<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for transactions resource
 */
class Services_Paymill_Transactions extends Services_Paymill_Base
{
    /**
     * Paymill API transactions resource relative path name
     * 
     * @var string
     */
    protected $_serviceResource = 'transactions/';

    /**
     * Rest UPDATE verb not supported
     *
     * @param null $identifier
     * @return array|void
     * @throws Services_Paymill_Exception
     */
    public function update($identifier = null) {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }

    /**
     * Rest DELETE verb not supported
     *
     * @param null $identifier
     * @return array|void
     * @throws Services_Paymill_Exception
     */
    public function delete($identifier = null) {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }

}