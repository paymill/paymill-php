<?php

namespace Paymill\Test\Unit\Models\Request;

use Paymill\Models\Request;
use Paymill\Models\Request\Checksum;
use PHPUnit_Framework_TestCase;

/**
 * Paymill\Models\Request\Checksum test case.
 */
class ChecksumTest extends PHPUnit_Framework_TestCase
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
        parent::setUp();
        $this->_model = new Checksum();
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
     * Tests the getters and setters of the model
     * @test
     */
    public function setGetTest()
    {
        $sample = array(
            'checksum_type' => Checksum::TYPE_PAYPAL,
            'amount'        => '200',
            'currency'      => 'EUR',
            'description'   => 'foo bar',
            'return_url'    => 'https://www.example.com',
            'cancel_url'    => 'https://www.example.com',
            'shipping_address' => array(
                'name' => 'Noch ein test',
                'street_address' => 'Unit street',
                'street_address_additional' => 'uff',
                'city' => 'Test city',
                'postal_code' => 'BLABLA',
                'state' => 'BAVARIA',
                'country' => 'DE',
                'phone' => '0892353453'
            ),
            'billing_address' => array(
                'name' => 'Noch ein test',
                'street_address' => 'Unit street',
                'street_address_additional' => 'uff',
                'city' => 'Test city',
                'postal_code' => 'BLABLA',
                'state' => 'BAVARIA',
                'country' => 'DE',
                'phone' => '0892353453'
            ),
            'items' => array(
                array(
                    'name' => 'Foo',
                    'description' => 'Bar',
                    'item_number' => 'PROD1',
                    'url' => 'http://www.foo.de',
                    'amount' => '200',
                    'quantity' => 1
                ),
                array(
                    'name' => 'Foo',
                    'description' => 'bock auf testing',
                    'item_number' => 'PROD2',
                    'url' => 'http://www.bar.de',
                    'amount' => '200',
                    'quantity' => 1
                )
            ),
            'shipping_amount' => '50',
            'handling_amount' => '50'
        );

        $this->_model
            ->setChecksumType($sample['checksum_type'])
            ->setAmount($sample['amount'])
            ->setCurrency($sample['currency'])
            ->setDescription($sample['description'])
            ->setReturnUrl($sample['return_url'])
            ->setCancelUrl($sample['cancel_url'])
            ->setShippingAddress($sample['shipping_address'])
            ->setBillingAddress($sample['billing_address'])
            ->setItems($sample['items'])
            ->setShippingAmount($sample['shipping_amount'])
            ->setHandlingAmount($sample['handling_amount'])
        ;

        $this->assertEquals($this->_model->getChecksumType(), $sample['checksum_type']);
        $this->assertEquals($this->_model->getAmount(),       $sample['amount']);
        $this->assertEquals($this->_model->getCurrency(),     $sample['currency']);
        $this->assertEquals($this->_model->getDescription(),  $sample['description']);
        $this->assertEquals($this->_model->getReturnUrl(),    $sample['return_url']);
        $this->assertEquals($this->_model->getCancelUrl(),    $sample['cancel_url']);
        $this->assertEquals($this->_model->getShippingAddress(),    $sample['shipping_address']);
        $this->assertEquals($this->_model->getBillingAddress(),     $sample['billing_address']);
        $this->assertEquals($this->_model->getItems(),              $sample['items']);
        $this->assertEquals($this->_model->getShippingAmount(),     $sample['shipping_amount']);
        $this->assertEquals($this->_model->getHandlingAmount(),     $sample['handling_amount']);

        return $this->_model;
    }

    /**
     * Test the Parameterize function of the model
     *
     * @param Checksum $model
     *
     * @test
     * @depends setGetTest
     */
    public function parameterizeTestGetOne(Checksum $model)
    {
        $model->setId('chk_123');
        $parameterArray = array(
            'count' => 1,
            'offset' => 0
        );

        $creationArray = $model->parameterize("getOne");

        $this->assertEquals($creationArray, $parameterArray);
    }

    /**
     * Test the Parameterize function of the model
     *
     * @param Checksum $model
     *
     * @test
     * @depends setGetTest
     */
    public function parameterizeTestCreate(Checksum $model)
    {
        $parameterArray = array();
        $parameterArray['checksum_type'] = Checksum::TYPE_PAYPAL;
        $parameterArray['amount']        = '200';
        $parameterArray['currency']      = 'EUR';
        $parameterArray['description']   = 'foo bar';
        $parameterArray['return_url']    = 'https://www.example.com';
        $parameterArray['cancel_url']    = 'https://www.example.com';
        $parameterArray['shipping_address'] = array(
            'name' => 'Noch ein test',
            'street_address' => 'Unit street',
            'street_address_additional' => 'uff',
            'city' => 'Test city',
            'postal_code' => 'BLABLA',
            'state' => 'BAVARIA',
            'country' => 'DE',
            'phone' => '0892353453'
        );
        $parameterArray['billing_address'] = array(
            'name' => 'Noch ein test',
            'street_address' => 'Unit street',
            'street_address_additional' => 'uff',
            'city' => 'Test city',
            'postal_code' => 'BLABLA',
            'state' => 'BAVARIA',
            'country' => 'DE',
            'phone' => '0892353453'
        );
        $parameterArray['items'] = array(
            array(
                'name' => 'Foo',
                'description' => 'Bar',
                'item_number' => 'PROD1',
                'url' => 'http://www.foo.de',
                'amount' => '200',
                'quantity' => 1
            ),
            array(
                'name' => 'Foo',
                'description' => 'bock auf testing',
                'item_number' => 'PROD2',
                'url' => 'http://www.bar.de',
                'amount' => '200',
                'quantity' => 1
            )
        );
        $parameterArray['shipping_amount'] = '50';
        $parameterArray['handling_amount'] = '50';

        $creationArray = $model->parameterize("create");

        $this->assertEquals($creationArray, $parameterArray);
    }
}
