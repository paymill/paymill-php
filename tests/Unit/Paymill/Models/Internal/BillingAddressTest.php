<?php

namespace Paymill\Tests\Unit\Models\Internal;

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

    private $sample = array(
        'name' => 'Max Muster',
        'street_address' => 'Musterstrasse 1',
        'street_address_addition' => 'EG',
        'city' => 'Musterhausen',
        'state' => 'BY',
        'postal_code' => '99999',
        'country' => 'DE',
        'phone' => '+49 89 1234567',
    );

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_billingAddress = new BillingAddress();
        $this->_billingAddress->setName($this->sample['name'])
            ->setStreetAddress($this->sample['street_address'])
            ->setStreetAddressAddition($this->sample['street_address_addition'])
            ->setCity($this->sample['city'])
            ->setState($this->sample['state'])
            ->setPostalCode($this->sample['postal_code'])
            ->setCountry($this->sample['country'])
            ->setPhone($this->sample['phone']);
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
        $this->assertEquals($this->_billingAddress->getName(), $this->sample['name']);
        $this->assertEquals($this->_billingAddress->getStreetAddress(), $this->sample['street_address']);
        $this->assertEquals($this->_billingAddress->getStreetAddressAddition(), $this->sample['street_address_addition']);
        $this->assertEquals($this->_billingAddress->getCity(), $this->sample['city']);
        $this->assertEquals($this->_billingAddress->getState(), $this->sample['state']);
        $this->assertEquals($this->_billingAddress->getPostalCode(), $this->sample['postal_code']);
        $this->assertEquals($this->_billingAddress->getCountry(), $this->sample['country']);
        $this->assertEquals($this->_billingAddress->getPhone(), $this->sample['phone']);

        return $this->_billingAddress;
    }

    /**
     * Tests the getters and setters of the model
     * @test
     */
    public function modelToArray()
    {
        $this->assertEquals($this->sample, $this->_billingAddress->toArray());
    }
    
}
