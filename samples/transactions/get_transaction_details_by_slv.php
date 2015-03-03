$transaction = new Paymill\Models\Request\Transaction();
$transaction->setId('slv_4125875679');

$response = $request->getOne($transaction);
