$subscription = new Paymill\Models\Request\Subscription();
$subscription->setId('sub_dea86e5c65b2087202e3');
             ->setRemove(true);

$response = $request->delete($subscription);
