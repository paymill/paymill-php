$payment = new Paymill\Models\Request\Payment();
$payment->setToken('12a46bcd462sd3r3care4e8336ssb4f5');

$response = $request->create($payment);
