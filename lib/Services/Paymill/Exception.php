<?php

/**
 * Services_Paymill_Exception class
 */
class Services_Paymill_Exception extends Exception
{
  /**
   * {@inheritDoc}
   */
  public function __construct($message, $code)
  {
        parent::__construct($message, $code);
  }
}