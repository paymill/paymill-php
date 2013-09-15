<?php
namespace Paymill\Services;

use Paymill\Models\Response\Error;

/**
 * PaymillException
 */
class PaymillException extends \Exception
{
    private $_errorModel;

    /**
     *
     * @param Error $errorModel
     * @param string $message
     * @param int $code
     * @param Exception $previous
     */
    public function __construct($errorModel = null, $message = null, $code = null, $previous = null)
    {
        $this->_setErrorModel($errorModel);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @param Error $model
     */
    private function _setErrorModel($model){
        $this->_errorModel = $model;
    }

    /**
     *
     * @return Error
     */
    public function getErrorModel(){
        return $this->_errorModel;
    }
}
