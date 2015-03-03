$subscription = new Paymill\Models\Request\Subscription();
$subscription->setId('sub_dea86e5c65b2087202e3');
             ->setAmount(1234);
             ->setAmountChangeType(0);

$response = $request->update($subscription);
