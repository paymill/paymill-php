<?php

namespace Paymill\Tests\Integration;

use Paymill\Models as Models;
use Paymill\Models\Request\Checksum;

/**
 * ChecksumTest
 */
class ChecksumTest extends IntegrationBase
{
    /**
     * @var Checksum
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_model = new Checksum();
        $this->_model->setChecksumType(Checksum::TYPE_PAYPAL);
        $this->_model->setChecksumAction(Checksum::ACTION_TRANSACTION);
        $this->_model->setAmount('200');
        $this->_model->setCurrency('EUR');
        $this->_model->setDescription('Dummy description');
        $this->_model->setReturnUrl('http://dummy.url');
        $this->_model->setCancelUrl('http://dummy.url');

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_model = null;
        parent::tearDown();
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function createChecksum()
    {
        $result = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Checksum', $result, var_export($result, true));

        return $result;
    }
}
