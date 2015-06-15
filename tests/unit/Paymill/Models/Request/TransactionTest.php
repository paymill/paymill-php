<?php

namespace Paymill\Test\Unit\Models\Request;

use Paymill\Models\Request as Request;
use Paymill\Models\Request\Transaction;
use PHPUnit_Framework_TestCase;

/**
 * Paymill\Models\Request\Transaction test case.
 */
class TransactionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Transaction
     */
    private $_transaction;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_transaction = new Transaction();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_transaction = null;
        parent::tearDown();
    }

    /**
     * Tests the getters and setters of the model
     * @test
     */
    public function setGetTest()
    {
        $sample = $this->getSampleData();

        $this->_transaction
            ->setAmount($sample['amount'])
            ->setCurrency($sample['currency'])
            ->setPayment($sample['payment'])
            ->setToken($sample['token'])
            ->setClient($sample['client'])
            ->setPreauthorization($sample['preauthorization'])
            ->setFeeAmount($sample['fee_amount'])
            ->setFeePayment($sample['fee_payment'])
            ->setFeeCurrency($sample['fee_currency'])
            ->setDescription($sample['description'])
            ->setSource($sample['source'])
            ->setShippingAddress($sample['shipping_address'])
            ->setBillingAddress($sample['billing_address'])
            ->setMandateReference($sample['mandate_reference']);

        $this->assertEquals($this->_transaction->getAmount(), $sample['amount']);
        $this->assertEquals($this->_transaction->getCurrency(), $sample['currency']);
        $this->assertEquals($this->_transaction->getPayment(), $sample['payment']);
        $this->assertEquals($this->_transaction->getToken(), $sample['token']);
        $this->assertEquals($this->_transaction->getClient(), $sample['client']);
        $this->assertEquals($this->_transaction->getPreauthorization(), $sample['preauthorization']);
        $this->assertEquals($this->_transaction->getFeeAmount(), $sample['fee_amount']);
        $this->assertEquals($this->_transaction->getFeePayment(), $sample['fee_payment']);
        $this->assertEquals($this->_transaction->getFeeCurrency(), $sample['fee_currency']);
        $this->assertEquals($this->_transaction->getDescription(), $sample['description']);
        $this->assertEquals($this->_transaction->getSource(), $sample['source']);
        $this->assertEquals($this->_transaction->getShippingAddress(), $sample['shipping_address']);
        $this->assertEquals($this->_transaction->getBillingAddress(), $sample['billing_address']);
        $this->assertEquals($this->_transaction->getMandateReference(), $sample['mandate_reference']);

        return $this->_transaction;
    }

    /**
     * Test the Parameterize function of the model
     *
     * @param Transaction $transaction
     *
     * @test
     * @depends setGetTest
     */
    public function parameterizeTest(Transaction $transaction)
    {
        $sample = $this->getSampleData();
        $testId = "transaction_88a388d9dd48f86c3136";
        $transaction->setId($testId);

        $creationArray = $transaction->parameterize("create");
        $updateArray   = $transaction->parameterize("update");
        $getOneArray   = $transaction->parameterize("getOne");

        $this->assertEquals(array(
            'amount'           => $sample['amount'], // e.g. "4200" for 42.00 EUR
            'currency'         => $sample['currency'], // ISO 4217
            'client'           => $sample['client'],
            'preauthorization' => $sample['preauthorization'],
            'fee_amount'       => $sample['fee_amount'], // e.g. "420" for 4.20 EUR
            'fee_payment'      => $sample['fee_payment'],
            'fee_currency'     => $sample['fee_currency'],
            'description'      => $sample['description'],
            'source'           => $sample['source'],
            'mandate_reference' => $sample['mandate_reference'],
            'shipping_address' => $sample['shipping_address'],
            'billing_address'  => $sample['billing_address']
        ), $creationArray);

        $this->assertEquals(array(
            'description' => 'Test Transaction'
        ), $updateArray);

        $this->assertEquals(array(
            'count' => 1,
            'offset' => 0
            ), $getOneArray
        );
    }

    /**
     * Returns array of sample data
     *
     * @return array
     */
    private function getSampleData()
    {
        $shippingAddress = array(
            'name'                    => 'Sam Shippy',
            'street_address'          => 'St. Cajetanstr. 43',
            'street_address_addition' => '5. OG',
            'postal_code'             => '814669',
            'city'                    => 'München',
            'state'                   => 'Bayern',
            'country'                 => 'DE',
            'phone'                   => '+49 89 189 045 300'
        );

        $billingAddress = array(
            'name'                    => 'Biff Billy',
            'street_address'          => 'St. Cajetanstr. 43',
            'street_address_addition' => '5. OG',
            'postal_code'             => '814669',
            'city'                    => 'München',
            'state'                   => 'Bayern',
            'country'                 => 'DE',
            'phone'                   => '+49 89 189 045 300'
        );

        $sample = array(
            'amount'           => '4200', // e.g. "4200" for 42.00 EUR
            'currency'         => 'EUR', // ISO 4217
            'payment'          => 'pay_2f82a672574647cd911d',
            'token'            => '098f6bcd4621d373cade4e832627b4f6',
            'client'           => 'client_c781b1d2f7f0f664b4d9',
            'preauthorization' => 'preauth_ec54f67e52e92051bd65',
            'fee_amount'       => '420', // e.g. "420" for 4.20 EUR
            'fee_payment'      => 'pay_098f6bcd4621d373cade4e832627b4f6',
            'fee_currency'     => 'EUR',
            'description'      => 'Test Transaction',
            'source'           => 'merchantcenter',
            'mandate_reference' =>'DE1234TEST',
            'shipping_address' => $shippingAddress,
            'billing_address'  => $billingAddress
        );

        return $sample;
    }
}
