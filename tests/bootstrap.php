<?php
/** 
 * $apiHost should be set to default unit test host for external users
 * can be overriden with environment variable PAYMILL_TEST_API_HOST
 */
$apiHost = 'https://api.paymill.de/v1/';
if (getenv('PAYMILL_TEST_API_HOST') ) $apiHost = getenv('PAYMILL_TEST_API_HOST');
define('API_HOST', $apiHost);

/** 
 * $testTokenHost should be set to default unit token host for external users
 * can be overriden with environment variable TEST_TOKEN_HOST
 */
$testTokenHost = 'https://test-token.paymill.de';
if (getenv('TEST_TOKEN_HOST') ) $testTokenHost = getenv('TEST_TOKEN_HOST');
define('TEST_TOKEN_HOST', $testTokenHost);

/**
 * $apiKey should be set to api test key
 * can be overriden with environment variable API_TEST_KEY 
 */
$apiTestKey = '';
if (getenv('API_TEST_KEY') ) $apiTestKey = getenv('API_TEST_KEY');
define('API_TEST_KEY', $apiTestKey);

/** 
 * $apiKey should be set to api test key
 * can be overriden with environment variable API_TEST_KEY
 */
$publicTestKey = '';
if (getenv('PUBLIC_TEST_KEY') ) $publicTestKey = getenv('PUBLIC_TEST_KEY');
define('PUBLIC_TEST_KEY', $publicTestKey);

// Define path to application directory
defined('APPLICATION_PATH')
|| define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../lib'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
        realpath(APPLICATION_PATH . '/../lib'),
        get_include_path(),
)));