$transaction = new Paymill\Models\Request\Transaction();
$transaction->setAmount(4200) // e.g. "4200" for 42.00 EUR
            ->setCurrency('EUR')
            ->setPreauthorization('preauth_ec54f67e52e92051bd65')
            ->setDescription('Test Transaction');

$response = $request->create($transaction);
