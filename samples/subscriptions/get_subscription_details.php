$subscription = new Paymill\Models\Request\Subscription();
$subscription->setId('sub_dc180b755d10da324864');

$response = $request->getOne($subscription);
