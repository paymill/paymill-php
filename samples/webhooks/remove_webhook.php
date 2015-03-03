$webhook = new Paymill\Models\Request\Webhook();
$webhook->setId('hook_40237e20a7d5a231d99b');

$response = $request->delete($webhook);
