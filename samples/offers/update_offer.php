$offer = new Paymill\Models\Request\Offer();
$offer->setId('offer_40237e20a7d5a231d99b')
      ->setName('Extended Special')
      ->setInterval('1 MONTH')
      ->setAmount(3333)
      ->setCurrency('USD')
      ->setTrialPeriodDays(33)
      ->updateSubscriptions(true);

$response = $request->update($offer)
