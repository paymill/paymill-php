<?php

namespace Paymill\Test\Integration;

class IntegrationBase extends \PHPUnit_Framework_TestCase
{
    public function createToken()
    {
        $params = [
            'channel_id' => API_PUBLIC_TEST_KEY,
            'transaction_mode' => 'CONNECTOR_TEST',
            'account_number' => '4111111111111111',
            'account_holder' => 'Max Muster',
            'account_expiry_month' => '12',
            'account_expiry_year' => date('Y', strtotime('+1 year')),

        ];
        $token = json_decode(file_get_contents(TOKEN_HOST . '?' . http_build_query($params)), true);
        if (isset($token['transaction']['identification']['uniqueId'])) {
            return $token['transaction']['identification']['uniqueId'];
        }

        return null;
    }
}
