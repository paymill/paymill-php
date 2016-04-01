<?php

/**
 * Should be set to default unit test host for external users
 * can be overwritten with environment variable PAYMILL_TEST_API_HOST
 */
if (!defined('API_HOST')) {
    define(
        'API_HOST',
        getenv('PAYMILL_API_HOST') ? getenv('PAYMILL_API_HOST') : 'https://api.paymill.com/v2.1/'
    );
}

/**
 * Should be set to token host
 * can be overwritten with environment variable PAYMILL_TOKEN_HOST
 */
if (!defined('TOKEN_HOST')) {
    define(
    'TOKEN_HOST',
    getenv('PAYMILL_TOKEN_HOST') ? getenv('PAYMILL_TOKEN_HOST') : 'https://test-token.paymill.com/'
    );
}

/**
 * $apiKey should be set to api test key
 * can be overriden with environment variable API_TEST_KEY
 */
if (!defined('API_TEST_KEY')) {
    define('API_TEST_KEY', getenv('PAYMILL_API_TEST_KEY') ? getenv('PAYMILL_API_TEST_KEY') : '');
}

/**
 * Should be set to api public test key
 * can be overriden with environment variable API_PUBLIC_TEST_KEY
 */
if (!defined('API_PUBLIC_TEST_KEY')) {
    define('API_PUBLIC_TEST_KEY', getenv('PAYMILL_API_PUBLIC_TEST_KEY') ? getenv('PAYMILL_API_PUBLIC_TEST_KEY') : '');
}

if (!defined('WEBHOOK_1')) {
    define('WEBHOOK_1', getenv('PAYMILL_WH_1') ? getenv('PAYMILL_WH_1') : 'transaction.succeeded');
}

if (!defined('WEBHOOK_2')) {
    define('WEBHOOK_2', getenv('PAYMILL_WH_2') ? getenv('PAYMILL_WH_2') : 'subscription.created');
}

/**
 * SSL_VERIFY_PEER can be deactivated by environment to enable other hosts where the original certificate
 * does not match (i.e. for local development)
 * To activate, set environment variable SSL_VERIFY_PEER=false
 */
if (!defined('SSL_VERIFY_PEER') && getenv('SSL_VERIFY_PEER')) {
    define('SSL_VERIFY_PEER', getenv('SSL_VERIFY_PEER') === 'false' ? false : true);
} else {
    define('SSL_VERIFY_PEER', true);
}

// register silently failing autoloader
spl_autoload_register(function($class) {
    if (0 === strpos($class, 'Paymill\\Tests\\')) {
        $class = str_replace('Paymill\\Tests\\', '\\', $class);
        $path = __DIR__ . '/' . strtr($class, '\\', '/').'.php';
        if (is_file($path) && is_readable($path)) {
            require_once $path;

            return true;
        }
    }
});

require_once '../vendor/autoload.php';