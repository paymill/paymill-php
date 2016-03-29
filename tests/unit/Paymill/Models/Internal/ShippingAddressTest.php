<?php

use Paymill\Models\Internal\ShippingAddress;

/**
 * Class ShippingAddressTest
 */
class ShippingAddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ShippingAddress
     */
    private $_shippingAddress;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_shippingAddress = new ShippingAddress();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_shippingAddress = null;
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
            'name'                    => 'Max Muster',
            'street_address'          => 'Musterstrasse 1',
            'street_address_addition' => 'EG',
            'city'                    => 'Musterhausen',
            'state'                   => 'BY',
            'postal_code'             => '99999',
            'country'                 => 'DE',
            'phone'                   => '+49 89 1234567',
        );

        $this->_shippingAddress->setName($sample['name'])
            ->setStreetAddress($sample['street_address'])
            ->setStreetAddressAddition($sample['street_address_addition'])
            ->setCity($sample['city'])
            ->setState($sample['state'])
            ->setPostalCode($sample['postal_code'])
            ->setCountry($sample['country'])
            ->setPhone($sample['phone']);

        $this->assertEquals($this->_shippingAddress->getName(), $sample['name']);
        $this->assertEquals($this->_shippingAddress->getStreetAddress(), $sample['street_address']);
        $this->assertEquals($this->_shippingAddress->getStreetAddressAddition(), $sample['street_address_addition']);
        $this->assertEquals($this->_shippingAddress->getCity(), $sample['city']);
        $this->assertEquals($this->_shippingAddress->getState(), $sample['state']);
        $this->assertEquals($this->_shippingAddress->getPostalCode(), $sample['postal_code']);
        $this->assertEquals($this->_shippingAddress->getCountry(), $sample['country']);
        $this->assertEquals($this->_shippingAddress->getPhone(), $sample['phone']);

        return $this->_shippingAddress;
    }
}
