$refund = new Paymill\Models\Request\Refund();
$refund->setId('refund_773ab6f9cd03428953c9');

$response = $request->getOne($refund);
