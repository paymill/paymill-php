$payment = new Paymill\Models\Request\Payment();
$payment->setToken('098f6bcd4621d373cade4e832627b4f6');

$response = $request->create($payment);
