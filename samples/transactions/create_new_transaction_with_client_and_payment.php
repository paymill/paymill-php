$transaction = new Paymill\Models\Request\Transaction();
$transaction->setAmount(4200) // e.g. "4200" for 42.00 EUR
            ->setCurrency('EUR')
            ->setClient('client_c781b1d2f7f0f664b4d9')
            ->setPayment('pay_2f82a672574647cd911d')
            ->setDescription('Test Transaction');

$response = $request->create($transaction);
