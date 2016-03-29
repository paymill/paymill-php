<?php

namespace Paymill\Tests\Integration;

use Paymill\API\Curl;
use Paymill\Request;

class IntegrationBase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request
     */
    protected $_service;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_service = new Request();
        $this->_service->setConnectionClass(
            new Curl(API_TEST_KEY, API_HOST, array(CURLOPT_SSL_VERIFYPEER => SSL_VERIFY_PEER))
        );

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_service = null;
        parent::tearDown();
    }

    public function createToken()
    {
        $params = array(
            'channel_id' => API_PUBLIC_TEST_KEY,
            'transaction_mode' => 'CONNECTOR_TEST',
            'account_number' => '4111111111111111',
            'account_holder' => 'Max Muster',
            'account_expiry_month' => '12',
            'account_expiry_year' => date('Y', strtotime('+1 year')),

        );
        $token = json_decode(file_get_contents(TOKEN_HOST . '?' . http_build_query($params)), true);
        if (isset($token['transaction']['identification']['uniqueId'])) {
            return $token['transaction']['identification']['uniqueId'];
        }

        return null;
    }
}
