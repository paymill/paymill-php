<?php

namespace Paymill\Tests\Integration;

use Paymill\Models as Models;
use Paymill\Models\Response\Transaction as TransactionResponse;

/**
 * Transaction
 */
class Transaction extends IntegrationBase
{
    /**
     * @var \Paymill\Models\Request\Transaction
     */
    private $_model;

    private $_shippingAddress = array(
        'name'                    => 'Max Muster',
        'street_address'          => 'Musterstrasse 1',
        'street_address_addition' => 'EG',
        'city'                    => 'Mustercity',
        'postal_code'             => '99999',
        'country'                 => 'DE',
        'state'                   => 'BY',
        'phone'                   => '123456789'
    );

    private $_billingAddress = array(
        'name'                    => 'Max Muster',
        'street_address'          => 'Musterstrasse 2',
        'street_address_addition' => '1. OG',
        'city'                    => 'London',
        'postal_code'             => '88888',
        'country'                 => 'GB',
        'state'                   => null,
        'phone'                   => '987654321'
    );

    private $_items = array(
        array(
            'name'        => 'Product 1',
            'amount'      => 50,
            'description' => 'Prod 1 description',
            'item_number' => 'ITM123456789',
            'quantity'    => 1,
            'url'         => 'https://sample.shop.com/prod/1'
        ),
        array(
            'name'        => 'Product 2',
            'amount'      => 50,
            'description' => 'Prod 2 description',
            'item_number' => 'ITM987654321',
            'quantity'    => 1,
            'url'         => 'https://sample.shop.com/prod/2'
        ),
    );

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_model = new Models\Request\Transaction();
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
     * @expectedException \Paymill\Services\PaymillException
     * @expectedExceptionMessage Token, Payment or Preauthorization required
     */
    public function createTransactionWithoutToken()
    {
        $this->_model->setAmount(100)
            ->setCurrency('EUR');
        $this->_service->create($this->_model);
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function createTransactionWithToken()
    {
        $this->_model->setAmount(100)
            ->setCurrency('EUR')
            ->setToken($this->createToken())
            ->setShippingAddress($this->_shippingAddress)
            ->setBillingAddress($this->_billingAddress)
            ->setItems($this->_items);

        /** @var Models\Response\Transaction $result */
        $result = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Transaction', $result);
        $this->assertInstanceOf('Paymill\Models\Internal\ShippingAddress', $result->getShippingAddress());
        $this->assertInstanceOf('Paymill\Models\Internal\BillingAddress', $result->getBillingAddress());
        $this->assertInternalType('array', $result->getItems());

        $items = $result->getItems();

        foreach ($items as $item) {
            $this->assertInstanceOf('Paymill\Models\Internal\Item', $item);
        }

        $this->assertEquals($this->_items[0], $items[0]->toArray());
        $this->assertEquals($this->_items[1], $items[1]->toArray());

        $this->assertEquals($this->_shippingAddress, $result->getShippingAddress()->toArray());
        $this->assertEquals($this->_billingAddress, $result->getBillingAddress()->toArray());

        return $result;
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createTransactionWithToken
     * @param TransactionResponse $model
     */
    public function updateTransaction(TransactionResponse $model)
    {
        $this->_model->setId($model->getId())
            ->setDescription('TEST');
        $result = $this->_service->update($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Transaction', $result, var_export($result, true));
        $this->assertEquals('TEST', $result->getDescription());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @expectedException \Paymill\Services\PaymillException
     * @expectedExceptionMessage Transaction not found
     */
    public function updateTransactionWithWrongId()
    {
        $this->_model->setId('YouWillNeverFindMe404')
            ->setDescription('TEST');
        $this->_service->update($this->_model);
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createTransactionWithToken
     */
    public function getOneTransaction($model)
    {
        $this->_model->setId($model->getId());
        $result = $this->_service->getOne($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Transaction', $result, var_export($result, true));
        $this->assertEquals($model->getId(), $result->getId());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createTransactionWithToken
     */
    public function getAllTransaction()
    {
        $this->_model;
        $result = $this->_service->getAll($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createTransactionWithToken
     */
    public function getAllTransactionAsModel()
    {
        $this->_model;
        $result = $this->_service->getAllAsModel($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
		$this->assertInstanceOf('Paymill\Models\Response\Transaction', array_pop($result));
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function getAllTransactionWithFilter()
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
     * @depends createTransactionWithToken
     * @depends getOneTransaction
     * @depends updateTransaction
     * @expectedException \Paymill\Services\PaymillException
     * @expectedExceptionMessage Method not Found
     */
    public function deleteTransaction($model)
    {
        $this->_model->setId($model->getId());
        $this->_service->delete($this->_model);
    }

}
