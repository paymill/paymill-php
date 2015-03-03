$preAuth = new Paymill\Models\Request\Preauthorization();
$preAuth->setPayment('pay_d43cf0ee969d9847512b')
        ->setAmount(4200)
        ->setCurrency('EUR')
        ->setDescription('description example');

$response = $request->create($preAuth);
