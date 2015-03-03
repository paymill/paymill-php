$webhook = new Paymill\Models\Request\Webhook();
$webhook->setEmail('<your-webhook-email>')
        ->setEventTypes(array(
            'transaction.succeeded',
            'transaction.failed'
        ));

$response = $request->create($webhook);
