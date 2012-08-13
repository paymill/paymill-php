<?php

require_once '../lib/Services/Paymill/Creditcards.php';

require_once 'TestBase.php';

/**
 * Services_Paymill_Creditcards test case.
 */
class Services_Paymill_CreditcardsTest extends Services_Paymill_TestBase
{

    /**
     * @var Services_Paymill_Creditcards
     */
    private $_creditcards;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $options = array( 'api_url' =>  $this->_apiUrl);
        $this->_creditcards = new Services_Paymill_Creditcards($this->_apiTestKey,  $this->_apiUrl);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_creditcards = null;

        parent::tearDown();
    }

    /**
     * Tests Services_Paymill_Creditcards->create()
     */
    public function testCreateWithoutToken()
    {
        $token = $this->getToken();
        try {
            $creditcard = $this->_creditcards->create(null);
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(412, $e->getCode() );
        }
    }  
   
    /**
     * Tests Services_Paymill_Creditcards->create()
     */
    public function testCreateWithoWrongToken()
    {
        $token = 'token_wrongtoken1234';
        try {
            $creditcard = $this->_creditcards->create(array("token"=>$token));
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }
    } 

    /**
     * Tests Services_Paymill_Creditcards->create()
     */
    public function testCreate()
    {
        $token = $this->getToken();
        $creditcard = $this->_creditcards->create(array("token"=>$token));
        
        $this->assertInternalType('array', $creditcard);
        $this->assertEquals($creditcard['last4'],'1111');
        $this->assertEquals($creditcard['expire_month'],'12');
        $this->assertEquals($creditcard['expire_year'],'2012');
        
        $creditcardId = $creditcard['id'];

        return $creditcardId;
    }
    
    /**
     * Tests Services_Paymill_Creditcards->getOne()
     * @depends testCreate
     */
    public function testGetOne($creditcardId)
    {
        $creditcard = $this->_creditcards->getOne($creditcardId);

        $this->assertInternalType('array', $creditcard);
        $this->assertEquals($creditcard['id'],$creditcardId);
    }
    
    /**
     * Tests Services_Paymill_Creditcards->getOne()
     */
    public function testGetWithWrongId()
    {
        try {
            $creditcard = $this->_creditcards->getOne('card_123456789paymill');
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }
    }
    
    /**
     * Tests Services_Paymill_Creditcards->get()
     */
    public function testGet()
    {
        $creditcard = $this->_creditcards->get();
        
        $this->assertInternalType('array', $creditcard);
        $this->assertGreaterThan(1,count($creditcard));
    }
    
    /**
     * Tests Services_Paymill_Creditcards->delete()
     * @depends testCreate
     */
    public function testDelete($creditcardId)
    {
        $creditcard = $this->_creditcards->delete($creditcardId);

        $this->assertInternalType('array', $creditcard);
        $this->assertCount(0,$creditcard);
    }
}