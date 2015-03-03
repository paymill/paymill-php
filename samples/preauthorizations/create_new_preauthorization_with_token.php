$preAuth = new Paymill\Models\Request\Preauthorization();
$preAuth->setToken('098f6bcd4621d373cade4e832627b4f6')
        ->setAmount(4200)
        ->setCurrency('EUR')
        ->setDescription('description example');

$response = $request->create($preAuth);
