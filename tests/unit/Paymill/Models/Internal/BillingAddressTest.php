<?php

use Paymill\Models\Internal\BillingAddress;

/**
 * Class BillingAddressTest
 */
class BillingAddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BillingAddress
     */
    private $_billingAddress;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_billingAddress = new BillingAddress();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_billingAddress = null;
        parent::tearDown();
    }

    //Testmethods
    /**
     * Tests the getters and setters of the model
     * @test
     */
    public function setGetTest()
    {
        $sample = array(
            'name' => 'Max Muster',
            'street_address' => 'Musterstrasse 1',
            'street_address_addition' => 'EG',
            'city' => 'Musterhausen',
            'state' => 'BY',
            'postal_code' => '99999',
            'country' => 'DE',
            'phone' => '+49 89 1234567',
        );

        $this->_billingAddress->setName($sample['name'])
            ->setStreetAddress($sample['street_address'])
            ->setStreetAddressAddition($sample['street_address_addition'])
            ->setCity($sample['city'])
            ->setState($sample['state'])
            ->setPostalCode($sample['postal_code'])
            ->setCountry($sample['country'])
            ->setPhone($sample['phone']);

        $this->assertEquals($this->_billingAddress->getName(), $sample['name']);
        $this->assertEquals($this->_billingAddress->getStreetAddress(), $sample['street_address']);
        $this->assertEquals($this->_billingAddress->getStreetAddressAddition(), $sample['street_address_addition']);
        $this->assertEquals($this->_billingAddress->getCity(), $sample['city']);
        $this->assertEquals($this->_billingAddress->getState(), $sample['state']);
        $this->assertEquals($this->_billingAddress->getPostalCode(), $sample['postal_code']);
        $this->assertEquals($this->_billingAddress->getCountry(), $sample['country']);
        $this->assertEquals($this->_billingAddress->getPhone(), $sample['phone']);

        return $this->_billingAddress;
    }
}
