<?php

namespace Paymill\Test\Integration;

use Paymill\API\Curl;
use Paymill\Models as Models;
use Paymill\Request;
use PHPUnit_Framework_TestCase;

/**
 * OfferTest
 */
class OfferTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Paymill\Services\Request
     */
    private $_service;

    /**
     * @var \Paymill\Models\Request\Offer
     */
    private $_model;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        $this->_service = new Request();
        $this->_service->setConnectionClass(
            new Curl(API_TEST_KEY, API_HOST, array(CURLOPT_SSL_VERIFYPEER => SSL_VERIFY_PEER))
        );

        $this->_model = new Models\Request\Offer();
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
     * @test
     * @codeCoverageIgnore
     */
    public function createOffer()
    {
        $this->_model->setAmount(100)
            ->setCurrency('EUR')
            ->setInterval('2 DAY')
            ->setName('TestOffer');
        $offerModelResult = $this->_service->create($this->_model);
        $this->assertInstanceOf('Paymill\Models\Response\Offer', $offerModelResult, var_export($offerModelResult, true));

        return $offerModelResult;
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createOffer
     */
    public function updateOffer($model)
    {
        $this->_model->setId($model->getId())
            ->setName('NewName');
        $result = $this->_service->update($this->_model);

        $this->assertInstanceOf('Paymill\Models\Response\Offer', $result, var_export($result, true));
        $this->assertEquals($model->getId(), $result->getId());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createOffer
     */
    public function getOneOffer($model)
    {
        $this->_model->setId($model->getId());
        $this->assertInstanceOf('Paymill\Models\Response\Offer', $result = $this->_service->getOne($this->_model), var_export($result, true));
        $this->assertEquals($model->getId(), $result->getId());
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createOffer
     */
    public function getAllOffer()
    {
        $this->_model;
        $result = $this->_service->getAll($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
    }

    /**
     * @test
     * @codeCoverageIgnore
     * @depends createOffer
     */
    public function getAllOfferAsModel()
    {
        $this->_model;
        $result = $this->_service->getAllAsModel($this->_model);
        $this->assertInternalType('array', $result, var_export($result, true));
		$this->assertInstanceOf('Paymill\Models\Response\Offer', array_pop($result));
    }

    /**
     * @test
     * @codeCoverageIgnore
     */
    public function getAllOfferWithFilter()
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
     * @depends createOffer
     */
    public function getRequestSubscription($offer)
    {
        $subscriptionModel = new Models\Request\Subscription();
        $subscriptionModel->setOffer($offer->getId());
        $PaymentModel = new Models\Request\Payment();
        $PaymentModel->setToken("098f6bcd4621d373cade4e832627b4f6");
        $PaymentModelResponse = $this->_service->create($PaymentModel);
        $this->assertInstanceOf('Paymill\Models\Response\Payment', $PaymentModelResponse, var_export($PaymentModelResponse, true));

        $subscriptionModel->setClient($PaymentModelResponse->getClient())
            ->setPayment($PaymentModelResponse->getId());
        $subscription = $this->_service->create($subscriptionModel);

        $this->assertEquals($offer->getId(), $subscription->getOffer()->getId());

        return $subscription;
    }



    /**
     * @test
     * @codeCoverageIgnore
     * @depends createOffer
     * @depends getRequestSubscription
     */
    public function deleteOfferWithSubscriptions($model, $subscriptionResponse)
    {
        $subscriptionRequest = new Models\Request\Subscription();
        $subscriptionRequest->setId($subscriptionResponse->getId());

        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $subscriptionWithOffer = $this->_service->getOne($subscriptionRequest), var_export($subscriptionWithOffer, true));

        $this->_model->setRemoveWithSubscriptions(true)
                    ->setId($model->getId());

        $result = $this->_service->delete($this->_model);

        $this->assertInternalType('array', $result, var_export($result, true));

        $subscriptionRequest->setId($subscriptionWithOffer->getId());

        $subscriptionResponse = $this->_service->getOne($subscriptionRequest);

        $this->assertTrue($subscriptionResponse->getIsCanceled());
        $this->assertTrue($subscriptionResponse->getIsDeleted());
    }

    /**
     * @test
     * @codeCoverageIgnore
     *
     *
     */
    public function deleteOfferWithoutSubscriptions()
    {
        $offer =  $this->createOffer();
        $subscriptionResponse = $this->getRequestSubscription($offer);
        $subscriptionRequest = new Models\Request\Subscription();
        $subscriptionRequest->setId($subscriptionResponse->getId());

        $this->assertInstanceOf('Paymill\Models\Response\Subscription', $subscriptionWithOffer = $this->_service->getOne($subscriptionRequest), var_export($subscriptionWithOffer, true));

        $this->_model->setRemoveWithSubscriptions(false)
                    ->setId($offer->getId());

        $result = $this->_service->delete($this->_model);

        $this->assertInternalType('array', $result, var_export($result, true));

        $subscriptionRequest->setId($subscriptionWithOffer->getId());

        $subscriptionResponse = $this->_service->getOne($subscriptionRequest);

        $this->assertFalse($subscriptionResponse->getIsCanceled());
        $this->assertFalse($subscriptionResponse->getIsDeleted());
    }


}
