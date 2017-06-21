<?php
require __DIR__ . '/../autoload.php';

use Paymill\API\Curl;
use Paymill\Models\Request\Transaction;
use Paymill\Request;

/**
 * Some A-Z demos based on the README.md
 *
 * Just run: php samples/Demo.php
 */

$privateKey = 'your-key-...';

echo PHP_EOL . '======== Start: Transaction GET ==========' . PHP_EOL;
try {
    $transactionId = 'tran_...';
    $request = new Request();
    $request->setConnectionClass(new Curl($privateKey, 'https://api.paymill.dev/v2.1/'));
    $transaction = new Transaction();
    $transaction->setId($transactionId);
    $response = $request->getOne($transaction);

    echo 'Transaction ID: ' . $response->getId();
} catch(\Paymill\Services\PaymillException $e){
    echo $e->getResponseCode() . PHP_EOL;
    echo $e->getStatusCode() . PHP_EOL;
    echo $e->getErrorMessage() . PHP_EOL;
    echo $e->getRawError() . PHP_EOL;
}
echo PHP_EOL . '======== End: Transaction GET ==========' . PHP_EOL;
