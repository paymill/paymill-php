$preAuth = new Paymill\Models\Request\Preauthorization();
$preAuth->setId('preauth_31eb90495837447f76b7');

$response = $request->getOne($preAuth);
