<?php

require_once 'Interface.php';

require_once realpath(dirname(__FILE__)) . '/../Exception.php';

if (!function_exists('json_decode')) {
    throw new Exception("Please install the PHP JSON extension");
}

if (!function_exists('curl_init')) {
    throw new Exception("Please install the PHP cURL extension");
}

/**
 *   Services_Paymill cURL HTTP client
 */
class Services_Paymill_Apiclient_Curl implements Services_Paymill_Apiclient_Interface
{

    /**
     * Paymill API merchant key
     *
     * @var string
     */
    private $_apiKey = null;

    /**
     *  Paymill API base url
     *
     *  @var string
     */
    private $_apiUrl = '/';

    const USER_AGENT = 'Paymill-php/0.0.2';

    public static $lastRawResponse;
    public static $lastRawCurlOptions;

    /**
     * cURL HTTP client constructor
     *
     * @param string $apiKey
     * @param string $apiEndpoint
     */
    public function __construct($apiKey, $apiEndpoint)
    {
        $this->_apiKey = $apiKey;
        $this->_apiUrl = $apiEndpoint;
    }

    /**
     * Perform API and handle exceptions
     *
     * @param $action
     * @param array $params
     * @param string $method
     * @return mixed
     * @throws Services_Paymill_Exception
     * @throws Exception
     */
    public function request($action, $params = array(), $method = 'POST')
    {
        if (!is_array($params))
            $params = array();

        try {
            $response = $this->_requestApi($action, $params, $method);
            $httpStatusCode = $response['header']['status'];
            if ($httpStatusCode != 200) {
                $errorMessage = 'Client returned HTTP status code ' . $httpStatusCode;
                if (isset($response['body']['error'])) {
                    $errorMessage = $response['body']['error'];
                }
                $responseCode = '';
                if (isset($response['body']['response_code'])) {
                    $responseCode = $response['body']['response_code'];
                }

                return array("data" => array(
                        "error" => $errorMessage,
                        "response_code" => $responseCode
                        ));
            }

            return $response['body'];
        } catch (Exception $e) {
            return array("data" => array("error" => $e->getMessage()));
        }
    }

    /**
     * Perform HTTP request to REST endpoint
     *
     * @param string $action
     * @param array $params
     * @param string $method
     * @return array
     */
    protected function _requestApi($action = '', $params = array(), $method = 'POST')
    {
        $curlOpts = array(
            CURLOPT_URL => $this->_apiUrl . $action,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_USERAGENT => self::USER_AGENT,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSLVERSION => 3,
//                CURLOPT_CAINFO => realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'paymill.crt',
        );

        if (Services_Paymill_Apiclient_Interface::HTTP_GET === $method) {
            if (0 !== count($params)) {
                $curlOpts[CURLOPT_URL] .= false === strpos($curlOpts[CURLOPT_URL], '?') ? '?' : '&';
                $curlOpts[CURLOPT_URL] .= http_build_query($params, null, '&');
            }
        } else {
            $curlOpts[CURLOPT_POSTFIELDS] = http_build_query($params, null, '&');
        }

        if ($this->_apiKey) {
            $curlOpts[CURLOPT_USERPWD] = $this->_apiKey . ':';
        }

        $curl = curl_init();
        curl_setopt_array($curl, $curlOpts);
        $responseBody = curl_exec($curl);
        self::$lastRawCurlOptions = $curlOpts;
        self::$lastRawResponse = $responseBody;
        $responseInfo = curl_getinfo($curl);
        if ($responseBody === false) {
            $responseBody = array('error' => curl_error($curl));
        }
        curl_close($curl);

        if ('application/json' === $responseInfo['content_type']) {
            $responseBody = json_decode($responseBody, true);
        }

        return array(
            'header' => array(
                'status' => $responseInfo['http_code'],
                'reason' => null,
            ),
            'body' => $responseBody
        );
    }

}