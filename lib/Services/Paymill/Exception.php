<?php

/**
 * Services_Paymill_Exception class
 */
class Services_Paymill_Exception extends Exception
{

  /**
   * Services Paymill Exception constructor
   * 
   * @param string $message
   * @param int $code
   */
  public function __construct($message, $code)
  {
        parent::__construct($message, $code);
  }

}