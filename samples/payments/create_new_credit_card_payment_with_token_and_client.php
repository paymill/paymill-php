$payment = new Paymill\Models\Request\Payment();
$payment->setToken('098f6bcd4621d373cade4e832627b4f6')
        ->setClient('client_88a388d9dd48f86c3136');

$response = $request->create($payment);
