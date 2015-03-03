$payment = new Paymill\Models\Request\Payment();
$payment->setId('pay_3af44644dd6d25c820a8');

$response = $request->delete($payment);
