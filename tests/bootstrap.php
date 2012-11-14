<?php
/** 
 * $apiHost should be set to default unit test host for external users
 * can be overriden with environment variable PAYMILL_TEST_API_HOST
 */
if (!defined('API_HOST') && getenv('PAYMILL_TEST_API_HOST'))
    define('API_HOST', getenv('PAYMILL_TEST_API_HOST'));

defined('API_HOST')
    || define('API_HOST', 'https://api.paymill.de/v2/');

/**
 * $apiKey should be set to api test key
 * can be overriden with environment variable API_TEST_KEY 
 */
if (!defined('API_TEST_KEY') && getenv('API_TEST_KEY'))
    define('API_TEST_KEY', getenv('API_TEST_KEY'));

defined('API_TEST_KEY')
    || define('API_TEST_KEY', '3fb33577bb16c8d08a36a064bdb10299');

/**
 * Define path to application directory
 */
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../lib'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
        realpath(APPLICATION_PATH . '/../lib'),
        get_include_path(),
)));