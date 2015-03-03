$client = new Paymill\Models\Request\Client();
$client->setId('client_88a388d9dd48f86c3136');

$response = $request->getOne($client);
