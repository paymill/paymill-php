$transaction = new Paymill\Models\Request\Transaction();
$transaction->setId('tran_023d3b5769321c649435')
            ->setDescription('My updated transaction description');

$response = $request->update($transaction);
