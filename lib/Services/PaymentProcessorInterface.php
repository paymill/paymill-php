<?php

interface Services_Paymill_PaymentProcessorInterface
{

    /**
     * Logging for PaymentProcessor
     *
     * @param type $message
     * @param type $debugInfo
     */
    public function log($message, $debugInfo);

}
