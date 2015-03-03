$webhook = new Paymill\Models\Request\Webhook();
$webhook->setUrl('<your-webhook-url>')
        ->setEventTypes(array(
            'transaction.succeeded',
            'transaction.failed'
        ));

$response = $request->create($webhook);
