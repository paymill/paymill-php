$offer = new Paymill\Models\Request\Offer();
$offer->setAmount(4200)
      ->setCurrency('EUR')
      ->setInterval('1 WEEK')
      ->setName('Nerd Special');

$response = $request->create($offer);
