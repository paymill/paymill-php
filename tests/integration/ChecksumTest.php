<?php

namespace Paymill\Test\Integration;

use Paymill\API\Curl;
use Paymill\Models as Models;
use Paymill\Request;
use PHPUnit_Framework_TestCase;

/**
 * ChecksumTest
 */
class ChecksumTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Paymill\Services\Request
     */
    private $_service;

    /**
     * @var \Paymill\Models\Request\Checksum
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_service = new Request();
        $this->_service->setConnectionClass(
            new Curl(API_TEST_KEY, API_HOST, array(CURLOPT_SSL_VERIFYPEER => SSL_VERIFY_PEER))
        );

        $this->_model = new Models\Request\Checksum();
        $this->_model->setChecksumType('postfinance_card');
        $this->_model->setAmount('200');
        $this->_model->setCurrency('CHF');
        $this->_model->setDescription('dummy description');

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_service = null;
        $this->_model = null;
        parent::tearDown();
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function createChecksum()
    {
        $result = $this->_service->getOne($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Checksum', $result, var_export($result, true));
		return $result;
    }
}
