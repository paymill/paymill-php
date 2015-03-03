$subscription = new Paymill\Models\Request\Subscription();
$subscription->setId('sub_dea86e5c65b2087202e3');
             ->setClient('client_81c8ab98a8ac5d69f749')
             ->setOffer('offer_40237e20a7d5a231d99b');
             ->setAmount(3000);
             ->setPayment('pay_95ba26ba2c613ebb0ca8');
             ->setCurrency('USD');
             ->setInterval('1 month,friday');
             ->setName('Changed Subscription');
             ->setPeriodOfValidity('14 MONTH');
             ->setTrialEnd(false);

$response = $request->update($subscription);
