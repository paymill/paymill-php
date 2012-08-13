<?php

require_once ('Base.php');

/**
 * Paymill API wrapper for refunds resource
 */

class Services_Paymill_Refunds extends Services_Paymill_Base
{
    /**
     * Paymill API refunds resource relative path name
     *
     * @var string
     */
    protected $_serviceResource = 'refunds/';

    /**
     * Perform refund
     *
     * @param array $transactionId
     * @param $params
     * @return array|mixed
     */
    public function create($transactionId, $params)
    {
        return $this->_httpClient->request(
                $this->_serviceResource . "$transactionId",
                $params,
                Services_Paymill_Apiclient_Interface::HTTP_POST
        );
    }

    /**
     * DELETE not supported
     *
     * @param null $identifier
     * @return array|void
     * @throws Services_Paymill_Exception
     */
    public function delete($identifier = null) {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404");
    }

    /**
     * PUT not supported
     *
     * @param null $identifier
     * @return array|void
     * @throws Services_Paymill_Exception
     */
    public function update($identifier = null) {
        throw new Services_Paymill_Exception( __CLASS__ . " does not support " . __METHOD__, "404" );
    }

}