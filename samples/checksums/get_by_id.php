$checksum = new Paymill\Models\Request\Checksum();
$checksum->setId('chk_9db8a1793e084a896da4289bf050');

$response = $request->getOne($checksum);
