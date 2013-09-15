<?php

/**
 * $apiHost should be set to default unit test host for external users
 * can be overwritten with environment variable PAYMILL_TEST_API_HOST
 */
if (!defined('API_HOST') && getenv('PAYMILL_TEST_API_HOST')) {
    define('API_HOST', getenv('PAYMILL_TEST_API_HOST'));
}
defined('API_HOST') || define('API_HOST', 'https://api.paymill.com/v2/');

/**
 * $apiKey should be set to api test key
 * can be overriden with environment variable API_TEST_KEY
 */
if (!defined('API_TEST_KEY') && getenv('API_TEST_KEY')) {
    define('API_TEST_KEY', getenv('API_TEST_KEY'));
}

/**
 * Define path to application directory
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../'));
spl_autoload_extensions(".php");
spl_autoload_register(function($class) {
        $class = str_replace("\\", "/", $class);
        if (file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $class . '.php')) {
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . $class . '.php');
            }
        }
);

