$offer = new Paymill\Models\Request\Offer();
$offer->setId('offer_40237e20a7d5a231d99b');

$response = $request->getOne($offer);
