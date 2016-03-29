<?php

namespace Paymill\Tests\Unit\Models\Internal;

use Paymill\Models\Internal\Item;

/**
 * Class ItemTest
 */
class ItemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Item
     */
    private $_item;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_item = new Item();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_item = null;
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
            'name'        => 'Product 1',
            'description' => 'Product description',
            'item_number' => 'ITM123456',
            'url'         => 'https://shop.example.com/item/1',
            'amount'      => '1999',
            'quantity'    => 1,
        );

        $this->_item->setName($sample['name'])
            ->setDescription($sample['description'])
            ->setItemNumber($sample['item_number'])
            ->setUrl($sample['url'])
            ->setAmount($sample['amount'])
            ->setQuantity($sample['quantity']);

        $this->assertEquals($this->_item->getName(), $sample['name']);
        $this->assertEquals($this->_item->getDescription(), $sample['description']);
        $this->assertEquals($this->_item->getItemNumber(), $sample['item_number']);
        $this->assertEquals($this->_item->getUrl(), $sample['url']);
        $this->assertEquals($this->_item->getAmount(), $sample['amount']);
        $this->assertEquals($this->_item->getQuantity(), $sample['quantity']);

        return $this->_item;
    }
}
