<?php

require_once '../lib/Services/Paymill/Apiclient/Curl.php';
require_once '../lib/Services/Paymill/Exception.php';

require_once 'TestBase.php';


/**
 * Services_Paymill_Apiclient_Curl test case.
 */
class Services_Paymill_Apiclient_CurlTest extends Services_Paymill_TestBase
{

    /**
     *
     * @var Services_Paymill_Apiclient_Curl
     */
    private $_curlClient;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_curlClient = new Services_Paymill_Apiclient_Curl($this->_apiTestKey,  $this->_apiUrl);

    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {

        $this->_curlClient = null;
        parent::tearDown();
    }


    /**
     * Tests Services_Paymill_Apiclient_Curl->request()
     */
    public function testRequest()
    {
        $resp = $this->_curlClient->request('clients/', array(), Services_Paymill_Apiclient_Interface::HTTP_GET);
        $this->assertInternalType('array', $resp);
        $this->assertArrayNotHasKey('error', $resp);

    }

    public function testRequestNullParam()
    {
        $resp = $this->_curlClient->request('clients/', null, Services_Paymill_Apiclient_Interface::HTTP_GET);
        $this->assertInternalType('array', $resp);
        $this->assertArrayNotHasKey('error', $resp);

    }

    public function testRequestNullAction()
    {

        try {
            $resp = $this->_curlClient->request(null, null, Services_Paymill_Apiclient_Interface::HTTP_GET);
        } catch (Exception $e ) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }

    }

    public function testAuthenticationError()
    {
        $this->_apiTestKey = 'INVALID_API_KEY';
        $this->_curlClient = new Services_Paymill_Apiclient_Curl($this->_apiTestKey, $this->_apiUrl);
        try {
            $resp = $this->_curlClient->request('clients/', array(), Services_Paymill_Apiclient_Interface::HTTP_GET);
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(401, $e->getCode() );
            $this->assertContains('Access Denied', $e->getMessage(), 'Expected error message not found', true);
        }

    }
}
