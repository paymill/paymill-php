$refund = new Paymill\Models\Request\Refund();
$refund->setId('tran_023d3b5769321c649435')
       ->setAmount(4200) // e.g. "4200" for 42.00 EUR
       ->setDescription('Sample Description');

$response = $request->create($refund);
