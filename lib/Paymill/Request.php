<?php

namespace Paymill;

use \Exception;
use Paymill\API\CommunicationAbstract;
use Paymill\API\Curl;
use Paymill\Models\Request\Base;
use Paymill\Models\Response\Error;
use Paymill\Services\PaymillException;
use Paymill\Services\ResponseHandler;

/**
 * Base
 * @version 3.0.2
 */
class Request
{

    /**
     * @var \Paymill\API\CommunicationAbstract|Curl
     */
    private $_connectionClass;

    /**
     * @var array
     */
    private $_lastResponse;

    /**
     * @var array
     */
    private $_lastRequest;

    /**
     * @var string
     */
    private $_version = "3.0.2";

    /**
     * @var string
     */
    private $_source;


    /**
     * Creates a Request object instance
     * @param string|null $privateKey
     */
    public function __construct($privateKey = null)
    {
        if(!is_null($privateKey)){
            $this->setConnectionClass(new Curl($privateKey));
        }
    }

    /**
     * @param \Paymill\API\CommunicationAbstract|Curl $communicationClass
     * @return $this
     */
    public function setConnectionClass(CommunicationAbstract $communicationClass = null)
    {
        $this->_connectionClass = $communicationClass;
        return $this;
    }

    /**
     * Sends a creation request using the provided model
     * @param \Paymill\Models\Request\Base $model
     * @throws PaymillException
     * @return \Paymill\Models\Response\Base
     */
    public function create($model)
    {
        return $this->_request($model, __FUNCTION__);
    }

    /**
     * Sends an update request using the provided model
     * @param \Paymill\Models\Request\Base $model
     * @throws PaymillException
     * @return \Paymill\Models\Response\Base
     */
    public function update($model)
    {
        return $this->_request($model, __FUNCTION__);
    }

    /**
     * Sends a delete request using the provided model
     * @param \Paymill\Models\Request\Base $model
     * @throws PaymillException
     * @return \Paymill\Models\Response\Base
     */
    public function delete($model)
    {
        return $this->_request($model, __FUNCTION__);
    }

    /**
     * Sends a getAll request using the provided model
     * @param \Paymill\Models\Request\Base $model
     * @throws PaymillException
     * @return array
     */
    public function getAll($model)
    {
        return $this->_request($model, __FUNCTION__);
    }

    /**
     * Sends a getOne request using the provided model
     * @param \Paymill\Models\Request\Base $model
     * @throws PaymillException
     * @return \Paymill\Models\Response\Base
     */
    public function getOne($model)
    {
        return $this->_request($model, __FUNCTION__);
    }

    /**
     * Returns the response of the last request
     * @return array
     */
    public function getLastResponse()
    {
        return $this->_lastResponse;
    }

    /**
     * Returns the parameter which were used for the last request
     * @return array
     */
    public function getLastRequest()
    {
        return $this->_lastRequest;
    }

    /**
     * Returns the Version of this Lib
     *
     * @return string
     */
    public function getVersion(){
        return $this->_version;
    }

        /**
     * Returns the LastResponse as StdClassObject. Returns false if no request was made earlier.
     *
     * @return false | stdClass
     */
    public function getJSONObject(){
        $result = false;
        $responseHandler = new ResponseHandler();
        if(is_array($this->_lastResponse)){
            $result = $responseHandler->arrayToObject($this->_lastResponse['body']);
        }
        return $result;
    }

    /**
     *
     * @param string $method
     * @return string
     */
    private function _getHTTPMethod($method)
    {
        $httpMethod = 'POST';
        switch ($method) {
            case 'create':
                $httpMethod = 'POST';
                break;
            case 'update':
                $httpMethod = 'PUT';
                break;
            case 'delete':
                $httpMethod = 'DELETE';
                break;
            case 'getAll':
            case 'getOne':
                $httpMethod = 'GET';
                break;
        }
        return $httpMethod;
    }

    /**
     * Sends a request based on the provided request model and according to the argumented method
     * @param \Paymill\Models\Request\Base $model
     * @param string $method (Create, update, delete, getAll, getOne)
     * @throws PaymillException
     * @return \Paymill\Models\Response\Base|\Paymill\Models\Response\Error
     */
    private function _request(Base $model, $method)
    {
        if(!is_a($this->_connectionClass, '\Paymill\API\CommunicationAbstract')){
            throw new PaymillException(null,'The connenction class is missing!');
        }
        $httpMethod = $this->_getHTTPMethod($method);
        $parameter = $model->parameterize($method);
        $serviceResource = $model->getServiceResource() . $model->getId();
        if(is_a($model, "\Paymill\Models\Request\Transaction") && $method === "create"){
            $source = empty($this->_source) ? "PhpLib" . $this->getVersion(): "PhpLib" . $this->getVersion() . "_" . $this->getSource();
            $parameter['source'] = $source;
        }

        try {
            $this->_lastRequest = $parameter;
            $response = $this->_connectionClass->requestApi(
                $serviceResource, $parameter, $httpMethod
            );
            $this->_lastResponse = $response;
            $responseHandler = new ResponseHandler();
            if ($method === 'getAll') {
                if ($responseHandler->validateResponse($response)) {
                    $convertedResponse = $response['body']['data'];
                } else {
                    $convertedResponse = $responseHandler->convertResponse($response, $model->getServiceResource());
                }
            } else {
                $convertedResponse = $responseHandler->convertResponse($response, $model->getServiceResource());
            }
        } catch (\Exception $e) {
            $errorModel = new Error();
            $convertedResponse = $errorModel->setErrorMessage($e->getMessage());
        }

        if (is_a($convertedResponse, '\Paymill\Models\Response\Error')) {
            throw new PaymillException(
            $convertedResponse->getResponseCode(), $convertedResponse->getErrorMessage(), $convertedResponse->getHttpStatusCode()
            );
        }

        return $convertedResponse;
    }

    /**
     * Sets the source for requests
     *
     * @param string $source
     * @return \Paymill\Request
     */
    public function setSource($source){
        if(is_string($source)){
            $this->_source = $source;
        }
        return $this;
    }

    /**
     * Returns the source for requests
     *
     * @return string
     */
    public function getSource(){
        return $this->_source;
    }

}
