Paymill-PHP
===========

[![Build Status](https://travis-ci.org/paymill/paymill-php.png?branch=master)](https://travis-ci.org/paymill/paymill-php)
[![Latest Stable Version](https://poser.pugx.org/paymill/paymill/v/stable.png)](https://packagist.org/packages/paymill/paymill)
[![Total Downloads](https://poser.pugx.org/paymill/paymill/downloads.png)](https://packagist.org/packages/paymill/paymill)


Getting started with Paymill
----------------------------

1.  If you don't use Composer in your project, then include the required PHP file from the paymill PHP library. For example via: 
```php
require_once 'lib/Services/Paymill/Transactions.php';
```    
    If you use Composer then add this line to "require" in the composer.json file for the latest stable release and update your dependencies.
    
        "paymill/paymill": "v2.4.0"

2.  Instantiate the class, for example the Services_Paymill_Transactions class, with the following parameters:

    $apiKey: First parameter is always your private API (test) Key

    $apiEndpoint: Second parameter is to configure the API Endpoint (with ending /), e.g. "https://api.paymill.de/v2/"
```php	
$transactionsObject = new Services_Paymill_Transactions($apiKey, $apiEndpoint);
```
3.  Make the appropriate call on the class instance. For additional parameters please refer to the API-Reference:
```php
$transactionsObject->create($params);
```

For further information, please refer to our official PHP library reference: 

https://www.paymill.com/en-gb/documentation-3/reference/api-reference/index.html
