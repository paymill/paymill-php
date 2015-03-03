$transaction = new Paymill\Models\Request\Transaction();
$transaction->setAmount(4200) // e.g. "4200" for 42.00 EUR
            ->setCurrency('EUR')
            ->setPayment('pay_2f82a672574647cd911d')
            ->setDescription('Test Transaction');

$response = $request->create($transaction);
