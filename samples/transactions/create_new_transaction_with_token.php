$transaction = new Paymill\Models\Request\Transaction();
$transaction->setAmount(4200) // e.g. "4200" for 42.00 EUR
            ->setCurrency('EUR')
            ->setToken('098f6bcd4621d373cade4e832627b4f6')
            ->setDescription('Test Transaction');

$response = $request->create($transaction);
