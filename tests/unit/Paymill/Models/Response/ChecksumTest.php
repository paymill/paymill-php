<?php

namespace Paymill\Test\Unit\Models\Response;

use Paymill\Models\Response as Response;
use PHPUnit_Framework_TestCase;

/**
 * Paymill\Models\Response\Checksum test case.
 */
class ChecksumTest
        extends PHPUnit_Framework_TestCase
{

    /**
     * @var \Paymill\Models\Response\Checksum
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_model = new Response\Checksum();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_model = null;
        parent::tearDown();
    }

    //Testmethods
    /**
     * Tests the getters and setters of the model
     * @test
     */
    public function setGetTest()
    {
        $this->_model->setLivemode('live')->setChecksum('foobar');

        $this->assertEquals($this->_model->getLivemode(), 'live');
        $this->assertEquals($this->_model->getChecksum(), 'foobar');
    }

}
