$webhook = new Paymill\Models\Request\Webhook();
$webhook->setFilter(array(
    'count' => 2,
    'offset' => 0
));

$response = $request->getAll($webhook);
