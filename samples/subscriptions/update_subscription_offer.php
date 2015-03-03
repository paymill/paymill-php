$subscription = new Paymill\Models\Request\Subscription();
$subscription->setId('sub_dea86e5c65b2087202e3');
             ->setOffer('offer_d7e9813a25e89c5b78bd');
             ->setOfferChangeType(2);

$response = $request->update($subscription);
