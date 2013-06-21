<?php

require_once '../lib/Services/Paymill/PaymentProcessor.php';
require_once '../lib/Services/Paymill/PaymentProcessorInterface.php';
require_once '../lib/Services/Paymill/Payments.php';
require_once '../lib/Services/Paymill/Clients.php';
require_once '../lib/Services/Paymill/Transactions.php';

require_once 'TestBase.php';

/**
 * Services_Paymill_Payments test case.
 */
class Services_Paymill_PaymentProcessorTest extends Services_Paymill_TestBase implements Services_Paymill_PaymentProcessorInterface
{

    /**
     * @var PaymentProcessor
     */
    private $_paymentProcessor;

    /**
     * @var actualLoggingMessage
     */
    private $_actualLoggingMessage;

    /**
     * @var debugMessage
     */
    private $_debugMessage;

    /**
     * @var _client
     */
    private $_clientObject;

    /**
     * @var _payment
     */
    private $_paymentObject;

    /**
     * @var _transactionObject
     */
    private $_transactionObject;

    /**
     * @var _client
     */
    private $_clientId;

    /**
     * @var _payment
     */
    private $_paymentId;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->_actualLoggingMessage = null;
        $this->_paymentProcessor = new Services_Paymill_PaymentProcessor($this->_apiTestKey, $this->_apiUrl, null, null, $this);
        $this->_clientObject = new Services_Paymill_Clients($this->_apiTestKey, $this->_apiUrl);
        $this->_paymentObject = new Services_Paymill_Payments($this->_apiTestKey, $this->_apiUrl);
        $this->_transactionObject = new Services_Paymill_Transactions($this->_apiTestKey, $this->_apiUrl);

        $this->_paymentProcessor->setAmount(1000);
        $this->_paymentProcessor->setAuthorizedAmount(1000);
        $this->_paymentProcessor->setCurrency('EUR');
        $this->_paymentProcessor->setDescription('Deuterium Cartridge');
        $this->_paymentProcessor->setEmail('John@doe.net');
        $this->_paymentProcessor->setName('John Doe');
        $this->_paymentProcessor->setToken($this->getToken());
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_paymentProcessor = null;
        $this->_actualLoggingMessage = null;
        $this->_paymentObject = null;
        $this->_clientObject = null;
        parent::tearDown();
    }

    /**
     * @param string $actual
     * @param string $debugmessage
     */
    public function log($actual, $debugmessage)
    {
        $this->_actualLoggingMessage = $actual;
        $this->_debugMessage = $debugmessage;
    }

    /**
     * Processes the Payment
     */
    protected function ProcessPayment()
    {
        $result = $this->_paymentProcessor->processPayment();
        $this->_clientId = $this->_paymentProcessor->getClientId();
        $this->_paymentId = $this->_paymentProcessor->getPaymentId();
        return $result;
    }

    /**
     * Tests the processPayment() without any parameter
     */
    public function testValidationWithMissingParameter()
    {
        $this->_paymentProcessor->setAmount(null);
        $this->assertFalse($this->_paymentProcessor->processPayment());
    }

    /**
     * Tests the processPayment() without any parameter
     */
    public function testValidationWithWrongParameter()
    {
        $this->_paymentProcessor->setAmount('100'); // should be integer
        $this->assertFalse($this->_paymentProcessor->processPayment());
    }

    /**
     * Tests the Log-function
     */
    public function testLogging()
    {
        $this->_paymentProcessor->setName(null);
        $this->assertFalse($this->_paymentProcessor->processPayment());
        $this->assertEquals("The Parameter name is missing.", $this->_actualLoggingMessage);

        $this->_paymentProcessor->setName(12345);
        $this->assertFalse($this->_paymentProcessor->processPayment());
        $this->assertEquals("The Parameter name is not a string.", $this->_actualLoggingMessage);
    }

    /**
     * tests the Paymentprocess
     */
    public function testProcessPayment()
    {
        $this->assertTrue($this->ProcessPayment());
        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the fest checkout
     */
    public function testFastCheckout()
    {
        $this->assertTrue($this->ProcessPayment());

        $this->assertNotEmpty($this->_clientId);
        $this->assertNotEmpty($this->_paymentId);

        $this->_paymentProcessor->setClientId($this->_clientId);
        $this->_paymentProcessor->setPaymentId($this->_paymentId);

        $this->assertTrue($this->_paymentProcessor->processPayment(), $this->_actualLoggingMessage);
        $this->assertEquals($this->_paymentProcessor->getClientId(), $this->_clientId, 'ClientId doesn´t match.');
        $this->assertEquals($this->_paymentProcessor->getPaymentId(), $this->_paymentId, 'PaymentId doesn´t match.');

        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the Paymentprocess
     */
    public function testProcessPaymentWithWrongApiUrl()
    {
        $this->_paymentProcessor = new Services_Paymill_PaymentProcessor($this->_apiTestKey, $this->_apiUrl . '/', null, null, $this);
        $this->_paymentProcessor->setAmount(1000);
        $this->_paymentProcessor->setCurrency('EUR');
        $this->_paymentProcessor->setEmail('John@doe.net');
        $this->_paymentProcessor->setName('John Doe');
        $this->_paymentProcessor->setDescription('Deuterium Cartridge');
        $this->_paymentProcessor->setToken($this->getToken());

        $this->assertFalse($this->ProcessPayment());
        $this->assertEquals('Exception thrown from paymill wrapper.', $this->_actualLoggingMessage);
        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the Paymentprocess when apikey has spaces
     *
     * This testcase can not be reproduced.
     */
    public function testProcessPaymentWithSpaceInApikey()
    {
        $this->_apiTestKey = $this->_apiTestKey . " ";
        $this->_paymentProcessor = new Services_Paymill_PaymentProcessor($this->_apiTestKey, $this->_apiUrl, null, null, $this);
        $this->_paymentProcessor->setAmount(1000);
        $this->_paymentProcessor->setCurrency('EUR');
        $this->_paymentProcessor->setEmail('John@doe.net');
        $this->_paymentProcessor->setName('John Doe');
        $this->_paymentProcessor->setDescription('Deuterium Cartridge');
        $this->_paymentProcessor->setToken($this->getToken());

        $this->markTestIncomplete(
                'This testcase can not be reproduced.'
        );

        $this->assertFalse($this->ProcessPayment());
        $this->assertEquals('Exception thrown from paymill wrapper.', $this->_actualLoggingMessage);
        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the failing of Paymentprocess
     *
     */
    public function testProcessPaymentWithWrongCurrency()
    {
        $this->_paymentProcessor->setCurrency('EURonen');

        $this->assertFalse($this->ProcessPayment());
        $this->assertEquals('Exception thrown from paymill wrapper.', $this->_actualLoggingMessage);
        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the fallback for 3DSecure
     *
     * The authorized amount is higher than the actual Basketamount
     * example: Added a credit/coupon after creating the token
     *
     * The difference will be refunded
     */
    public function testHigherAuthorizedAmount()
    {
        $this->_paymentProcessor->setAuthorizedAmount(1500);
        $this->_paymentProcessor->setAmount(1000);
        $this->assertTrue($this->ProcessPayment(), $this->_debugMessage);

        $transaction = $this->_paymentProcessor->getTransactionId();
        $this->assertInternalType('string', $transaction);

        $transaction = $this->_transactionObject->getOne($transaction);
        $this->assertInternalType('array', $transaction);

        $this->assertArrayHasKey('origin_amount', $transaction);
        $this->assertEquals(1500, $transaction['origin_amount']);
        $this->assertArrayHasKey('amount', $transaction);
        $this->assertEquals("1000", $transaction['amount']);

        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the fallback for 3DSecure
     *
     * The authorized amount is lower than the actual Basketamount
     * example: Added a payment surcharge after creating the token
     */
    public function testLowerAuthorizedAmount()
    {
        $this->_paymentProcessor->setAuthorizedAmount(1000);
        $this->_paymentProcessor->setAmount(1500);
        $this->assertTrue($this->ProcessPayment(), $this->_debugMessage);

        $transactionId = $this->_paymentProcessor->getTransactionId();
        $this->assertInternalType('string', $transactionId);
        $transaction = $this->_transactionObject->getOne($transactionId);
        $this->assertInternalType('array', $transaction);
        $this->assertArrayHasKey('origin_amount', $transaction);
        $this->assertArrayHasKey('amount', $transaction);

        $this->assertEquals(1000, $transaction['origin_amount']);
        $this->assertEquals("1000", $transaction['amount']);

        $secondTransactionId = $this->_paymentProcessor->getSecondTransactionId();
        $this->assertInternalType('string', $secondTransactionId);
        $secondTransaction = $this->_transactionObject->getOne($secondTransactionId);
        $this->assertInternalType('array', $secondTransaction);
        $this->assertArrayHasKey('origin_amount', $secondTransaction);
        $this->assertArrayHasKey('amount', $secondTransaction);

        $this->assertEquals(500, $secondTransaction['origin_amount']);
        $this->assertEquals("500", $secondTransaction['amount']);

        $this->_paymentObject->delete($this->_paymentId);
        $this->_clientObject->delete($this->_clientId);
    }

    /**
     * tests the toArray-function
     */
    public function testToArray()
    {

        $toArrayResult = $this->_paymentProcessor->toArray();
        $this->assertEquals($this->_apiTestKey, $toArrayResult['privatekey']);
        $this->assertEquals($this->_apiUrl, $toArrayResult['apiurl']);
        $this->assertInstanceOf('Services_Paymill_PaymentProcessorTest', $toArrayResult['logger']);
        $this->assertEquals(dirname(realpath('../lib/Services/Paymill/PaymentProcessor.php')) . DIRECTORY_SEPARATOR, $toArrayResult['libbase']);
        $this->assertEquals(1000, $toArrayResult['amount']);
        $this->assertEquals(1000, $toArrayResult['authorizedamount']);
        $this->assertEquals('EUR', $toArrayResult['currency']);
        $this->assertEquals('Deuterium Cartridge', $toArrayResult['description']);
        $this->assertEquals('John@doe.net', $toArrayResult['email']);
        $this->assertEquals('John Doe', $toArrayResult['name']);
        $this->assertEquals($this->getToken(), $toArrayResult['token']);
    }

    /**
     * tests the getLastResponse-function
     */
    public function testGetLastResponse()
    {
        $expectedResult = array(
            'error' => 'Token not Found',
            'response_code' => ''
        );

        $this->_paymentProcessor->setToken('wrongToken');
        $this->assertFalse($this->ProcessPayment());
        $response = $this->_paymentProcessor->getLastResponse();
        $this->assertInternalType('array', $response);
        $this->assertEquals($expectedResult, $response);
    }

}
