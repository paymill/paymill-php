$webhook = new Paymill\Models\Request\Webhook();
$webhook->setId('hook_40237e20a7d5a231d99b')
        ->setUrl('<your-webhook-url>')
        ->setEventTypes(array(
            'transaction.failed',
            'subscription.failed'
        ));

$response = $request->update($webhook);
