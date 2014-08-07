<?php
namespace Paymill\Test\Integration;


use Paymill\API\Curl;
use Paymill\Models as Models;
use Paymill\Request;
use PHPUnit_Framework_TestCase;

/**
 * SubscriptionTest
 */
class SubscriptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Paymill\Services\Request
     */
    private $_service;

    /**
     * @var \Paymill\Models\Request\Subscription
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_service = new Request();
        $this->_service->setConnectionClass(new Curl(API_TEST_KEY));
        $this->_model = new Models\Request\Subscription();
        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->_service = null;
        $this->_model = null;
        parent::tearDown();
    }

    /**
     * @group testing
     * @test
     * @codeCoverageIgnore
     */
    public function createSubscriptionWithOffer()
    {

        $offerModel = new Models\Request\Offer();
        $offerModel->setAmount(100)
            ->setCurrency('EUR')
            ->setInterval('2 DAY')
            ->setName('TestOffer');
        $offerModelResponse = $this->_service->create($offerModel);
        $this->assertInstanceOf('Paymill\Models\Response\Offer', $offerModelResponse, var_export($offerModelResponse, true));

        $PaymentModel = new Models\Request\Payment();
        $PaymentModel->setToken("098f6bcd4621d373cade4e832627b4f6");
        $PaymentModelResponse = $this->_service->create($PaymentModel);
        $this->assertInstanceOf('Paymill\Models\Response\Payment', $PaymentModelResponse, var_export($PaymentModelResponse, true));

        $this->_model->setClient($PaymentModelResponse->getClient())
            ->setOffer($offerModelResponse->getId())
            ->setPayment($PaymentModelResponse->getId());
        $result = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $result, var_export($result, true));
        $offerModel->setRemoveWithSubscriptions(false);
        $this->_service->delete($offerModel->setId($offerModelResponse->getId()));
        return $result;
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function createSubscriptionWithoutOffer()
    {
        $this->_model->setAmount(2000)
            ->setCurrency('EUR')
            ->setInterval('2 WeEK, tUEsDAY');
        $PaymentModel = new Models\Request\Payment();
        $PaymentModel->setToken("098f6bcd4621d373cade4e832627b4f6");
        $PaymentModelResponse = $this->_service->create($PaymentModel);
        $this->assertInstanceOf('Paymill\Models\Response\Payment', $PaymentModelResponse, var_export($PaymentModelResponse, true));

        $this->_model->setClient($PaymentModelResponse->getClient())
            ->setPayment($PaymentModelResponse->getId());
        $result = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $result, var_export($result, true));

        return $result;
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     */
    public function pauseSubscription($model)
    {
        $this->_model->setId($model->getId());
        $this->_model->setPause(true);
        $result = $this->_service->update($this->_model);

        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $result, var_export($result, true));
        $this->assertEquals('inactive', $result->getStatus());
    }


    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     */
    public function unPauseSubscription($model)
    {
        $this->_model->setId($model->getId());
        $this->_model->setPause(false);
        $result = $this->_service->update($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $result, var_export($result, true));
        $this->assertEquals('active', $result->getStatus());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     */
    public function getOneSubscription($model)
    {
        $this->_model->setId($model->getId());
        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $result = $this->_service->getOne($this->_model), var_export($result, true));
        $this->assertEquals($model->getId(), $result->getId());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     */
    public function getAllSubscription()
    {
        $this->_model;
        $result = $this->_service->getAll($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     */
    public function getAllSubscriptionAsModel()
    {
        $this->_model;
        $result = $this->_service->getAllAsModel($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
		$this->assertInstanceOf('Paymill\Models\Response\Subscription', array_pop($result));
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function getAllSubscriptionWithFilter()
    {
        $this->_model->setFilter(array(
                'count' => 1,
                'offset' => 0
            )
        );
        $result = $this->_service->getAll($this->_model);
        $this->assertEquals(1, count($result), var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createSubscriptionWithOffer
     * @depends getOneSubscription
     * @depends updateSubscription
     */
    public function deleteSubscription($model)
    {
        $this->_model->setId($model->getId());
        $result = $this->_service->delete($this->_model);
        $this->assertTrue($result->getIsCanceled(), var_export($result, true));
        $this->assertFalse($result->getIsDeleted(), var_export($result, true));
    }

    /**
     * @test
     * @depends createSubscriptionWithoutOffer
     */
    public function completelyDeleteSubscription($model)
    {
        $this->_model->setId($model->getId())
            ->setRemove(true);
        $result = $this->_service->delete($this->_model);
        $this->assertTrue($result->getIsCanceled(), var_export($result, true));
        $this->assertTrue($result->getIsDeleted(), var_export($result, true));
    }

}
