<?php

namespace Paymill\Tests\Integration;

use Paymill\Models as Models;

/**
 * RefundTest
 */
class RefundTest extends IntegrationBase
{
    /**
     * @var \Paymill\Models\Request\Refund
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_model = new Models\Request\Refund();
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
    public function createRefund()
    {
        $transactionModel = new Models\Request\Transaction();
        $transactionModel->setAmount(200)
            ->setCurrency('EUR')
            ->setToken($this->createToken());
        $transactionModelResponse = $this->_service->create($transactionModel);
        $this->assertInstanceOf('Paymill\Models\Response\Transaction', $transactionModelResponse, var_export($transactionModelResponse, true));

        $this->_model->setAmount(100)
            ->setDescription('EUR')
            ->setId($transactionModelResponse->getId());
        $result = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Refund', $result, var_export($result, true));
        return $result;
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createRefund
     * @expectedException \Paymill\Services\PaymillException
     * @expectedExceptionMessage Method not Found
     */
    public function updateRefund($model)
    {
        $this->_model->setId($model->getId());
        $this->_service->update($this->_model);
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createRefund
     */
    public function getOneRefund($model)
    {
        $this->_model->setId($model->getId());
        $this->assertInstanceOf('Paymill\Models\Response\Refund', $result = $this->_service->getOne($this->_model), var_export($result, true));
        $this->assertEquals($model->getId(), $result->getId());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createRefund
     */
    public function getAllRefund()
    {
        $this->_model;
        $result = $this->_service->getAll($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createRefund
     */
    public function getAllRefundAsModel()
    {
        $this->_model;
        $result = $this->_service->getAllAsModel($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
		$this->assertInstanceOf('Paymill\Models\Response\Refund', array_pop($result));
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function getAllRefundWithFilter()
    {
        $this->_model->setFilter(array(
            'count' => 1,
            'offset' => 0
            )
        );
        $result = $this->_service->getAll($this->_model);
        $this->assertEquals(1, count($result), var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createRefund
     * @depends getOneRefund
     * @depends updateRefund
     * @expectedException \Paymill\Services\PaymillException
     * @expectedExceptionMessage Method not Found
     */
    public function deleteRefund($model)
    {
        $this->_model->setId($model->getId());
        $result = $this->_service->delete($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Error', $result, var_export($result, true));
        $this->assertEquals('Method not Found', $result->getErrorMessage());
    }

}
