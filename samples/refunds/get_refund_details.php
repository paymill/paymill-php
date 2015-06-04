$refund = new Paymill\Models\Request\Refund();
$refund->setId('refund_87bc404a95d5ce616049');

$response = $request->getOne($refund);
