Paymill-PHP
===========

[![Build Status](https://travis-ci.org/paymill/paymill-php.png?branch=master)](https://travis-ci.org/paymill/paymill-php)

Getting started with Paymill
----------------------------

1.  Include the required autoloader:
    ```php
        require_once 'autoloader.php';
    ```

2.  Instantiate the request class with the following parameters:
    $apiKey: First parameter is always your private API (test) Key

    ```php
        $paymillService = new Request($apiKey);
    ```
3.  Instantiate the model class with the parameters described in the API-reference:
    ```php
        $PaymentModel = new Payment();
        $PaymentModel->setToken("098f6bcd4621d373cade4e832627b4f6");
    ```
4.  Use your desired function:

    ```php
        $PaymentModelResponse = $paymillService->create($PaymentModel);
        $paymentId = $PaymentModelResponse->getId();
    ```

    It recommend to wrap it into a "try/catch" to handle exceptions like this:
    ```php
        try{
            $PaymentModelResponse = $paymillService->create($PaymentModel);
            $paymentId = $PaymentModelResponse->getId();
        }catch(PaymillException $exception){
            //Do something with the error informations below
            //$exception->getResponseCode();
            //$exception->getHttpStatusCode();
            //$exception->getErrorMessage();
        }
    ```

API versions
--------------

The master branch reflects the newest API version, which is v2 for now. In order to use an older version just checkout the corresponding tag.

For further information, please refer to our official PHP library reference: https://www.paymill.com/en-gb/documentation-3/reference/api-reference/index.html
