<?php

require_once ('PHPUnit/Framework/TestCase.php');

class Services_Paymill_TestBase extends PHPUnit_Framework_TestCase
{
    protected $_apiTestKey = '';
    protected $_publicTestKey = '';
    protected $_apiUrl;

    protected function setUp()
    {   
        if (API_TEST_KEY !== '') {
            $this->_apiTestKey = API_TEST_KEY;
        } else {
            throw new Services_Paymill_Exception('Please provide the ApiTestKey in bootstrap.php or via environment', '401');
        }
        
        if (PUBLIC_TEST_KEY !== '') {
            $this->_publicTestKey = PUBLIC_TEST_KEY;
        } else {
            throw new Services_Paymill_Exception('Please provide the PublicTestKey in bootstrap.php or via environment','401');
        }
        
        if (API_HOST !== '') {
            $this->_apiUrl = API_HOST;
        } else {
            throw new Services_Paymill_Exception('Please provide the API_HOST in bootstrap.php or via environment','401');
        }
    }

    /**
     * @return string
     */
    protected function getToken()
    {
        $params = array(
            'requesttype' => 'create_token',
            'merchantkey' => $this->_publicTestKey,
            'card'        => array(
                'number'          => '4111111111111111'
                ,'cvc'            => 343
                ,'exp_month'      => 12
                ,'exp_year'       => 2012
                ,'cardholdername' => 'Test Person'
            )
        );

        $curlOpts = array(
            CURLOPT_URL            => TEST_TOKEN_HOST,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS     => json_encode($params),
        );

        $curl = curl_init();
        curl_setopt_array($curl, $curlOpts);
        $responseBody = curl_exec($curl);
        curl_close($curl);
        $responseBodyAsArray = json_decode($responseBody,true);

        return $responseBodyAsArray['token'];
    }
}