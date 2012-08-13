    <?php

require_once '../lib/Services/Paymill/Transactions.php';

require_once 'TestBase.php';

/**
 * Services_Paymill_Transactions test case.
 */
class Services_Paymill_TransactionsTest extends Services_Paymill_TestBase
{
    /**
     * @var Services_Paymill_Transactions
     */
    private $_transaction;
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->_transaction = new Services_Paymill_Transactions($this->_apiTestKey,  $this->_apiUrl);
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
     * Tests Services_Paymill_Transactions->create()
     */
    public function testCreate()
    {
        $params = array('amount' => 999,
                        'currency'=> 'eur',
                        'description' => 'Deuterium Cartridge',
                        'token' => $this->getToken()
                        );

        $transaction = $this->_transaction->create($params);

        $this->assertInternalType('array', $transaction);
        $this->assertArrayHasKey('id', $transaction);
        $this->assertNotEmpty($transaction['id']);
        $this->assertEquals($transaction['amount'], 999);
        $this->assertEquals($transaction['description'], 'Deuterium Cartridge');

        $transactionId = $transaction['id'];
        
        return $transactionId;
    }

    /**
     * Tests Services_Paymill_Transactions->get()
     * @depends testCreate
     */
    public function testGet()
    {   
        $filters = array('count'=>5,'offset'=>0);
        $transactions = $this->_transaction->get($filters);
        
        $this->assertInternalType('array', $transactions);
        $this->assertGreaterThanOrEqual(1, count($transactions));
        $this->assertArrayHasKey('id', $transactions[0]);
    }

    /**
     * Tests Services_Paymill_Transactions->getOne()
     * @depends testCreate
     */
    public function testGetOne($transactionId)
    {
        $transaction = $this->_transaction->getOne($transactionId);
        $this->assertEquals($transactionId, $transaction['id']);
    }
    
    /**
     * Tests Services_Paymill_Transaction->update()
     */
    public function testUpdate()
    {
        try {
            $this->_transaction->update();
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }
    }
    
    /**
     * Tests Services_Paymill_Transaction->delete()
     */
    public function testDelete()
    {
        try {
            $this->_transaction->delete();
        } catch (Exception $e) {
            $this->assertInstanceOf('Services_Paymill_Exception', $e);
            $this->assertEquals(404, $e->getCode() );
        }
    }
}