<?php

require_once '../lib/Services/Paymill/Coupons.php';

require_once 'TestBase.php';

/**
 * Services_Paymill_Coupons test case.
 */
class Services_Paymill_CouponsTest extends Services_Paymill_TestBase
{

    /**
     * @var Services_Paymill_Coupons
     */
    private $_coupons;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_coupons = new Services_Paymill_Coupons($this->_apiTestKey,  $this->_apiUrl);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_coupons = null;

        parent::tearDown();
    }

    /**
     * Tests Services_Paymill_Coupons->create()
     */
    public function testCreateFixedValue()
    {   $params = array(
            "name" => "My Coupon" ,
            "type"  => Services_Paymill_Coupons::$FIXED_VALUE,
            "fixed_value" => 42
        );

        $coupon = $this->_coupons->create($params);
        $this->assertArrayHasKey("id", $coupon, $this->getMessages($coupon));
        $this->assertEquals("My Coupon", $params["name"]);
        $this->assertEquals(Services_Paymill_Coupons::$FIXED_VALUE, $params["type"]);
        $this->assertEquals(42, $params["fixed_value"]);

        return $coupon["id"];
    }


    /**
     * Tests Services_Paymill_Coupons->create()
     */
    public function testCreatePercentageValue()
    {   $params = array(
            "name" => "My Coupon" ,
            "type"  => Services_Paymill_Coupons::$PERCENT_VALUE,
            "percent_value" => 42
        );

        $coupon = $this->_coupons->create($params);
        $this->assertArrayHasKey("id", $coupon, $this->getMessages($coupon));
        $this->assertEquals("My Coupon", $params["name"]);
        $this->assertEquals(Services_Paymill_Coupons::$PERCENT_VALUE, $params["type"]);
        $this->assertEquals(42, $params["percent_value"]);

        return $coupon["id"];
    }


    /**
     * Tests Services_Paymill_Coupons->getOne()
     * @depends testCreateFixedValue
     */
    public function testGetOneFixedValue($couponId)
    {
        $coupon = $this->_coupons->getOne($couponId);

        $this->assertInternalType('array', $coupon);
        $this->assertEquals($coupon['id'],$couponId);
    }

    /**
     * Tests Services_Paymill_Coupons->getOne()
     * @depends testCreatePercentageValue
     */
    public function testGetOnePercentageValue($couponId)
    {
        $coupon = $this->_coupons->getOne($couponId);

        $this->assertInternalType('array', $coupon);
        $this->assertEquals($coupon['id'],$couponId);
    }


    /**
     * Tests Services_Paymill_Coupons->getOne()
     */
    public function testGetWithWrongId()
    {
        try {
            $this->_coupons->getOne('coupon_123456789paymill');
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }
    }

    /**
     * Tests Services_Paymill_Coupons->get()
     */
    public function testGet()
    {
        $coupons = $this->_coupons->get();

        $this->assertInternalType('array', $coupons);
        $this->assertGreaterThan(1,count($coupons));
    }

    /**
     * Tests Services_Paymill_Coupons->delete()
     * @depends testCreateFixedValue
     */
    public function testDeleteFixedValue($couponId)
    {
        $coupon = $this->_coupons->delete($couponId);

        $this->assertInternalType('array', $coupon);
        $this->assertCount(0,$coupon);
    }

    /**
     * Tests Services_Paymill_Coupons->delete()
     * @depends testCreatePercentageValue
     */
    public function testDeletePercentageValue($couponId)
    {
        $coupon = $this->_coupons->delete($couponId);

        $this->assertInternalType('array', $coupon);
        $this->assertCount(0,$coupon);
    }

}