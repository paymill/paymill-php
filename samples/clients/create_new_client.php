$client = new Paymill\Models\Request\Client();
$client->setEmail('max.mustermann@example.com')
       ->setDescription('Lovely Client')

$response = $request->create($client);
