<?php

namespace Integrations\MailerLite\Http;

use GuzzleHttp\Client;
use Exception;

class Api
{
    public $mailerLiteApiEndpoint;
    public $storeUrl;
    public $apiKey;

    function __construct($apiKey)
    {
        $this->mailerLiteApiEndpoint = config('mailerLite.api_endpoint');

        $this->apiKey = $apiKey;
    }

    function makeCall($endpoint, $method, $data = null, $params = [])
    {
        $headers = [];
        $requestData = [];

        $endpoint = $this->mailerLiteApiEndpoint . $endpoint . implode('&', $params);
        $headers['Authorization'] = 'Bearer ' . $this->apiKey;
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';

        if (!empty($data)) {
            $requestData = array_merge($requestData, $data);
        }

        try {
            $client = new Client([
                'verify' => config('app.env') === 'local' ? false : true
            ]);

            $options = [
                'headers' => $headers,
            ];

            if ($method != 'GET') {
                $options['body'] = json_encode($requestData);
            }

            $response = $client->request($method, $endpoint, $options);

            if (in_array($response->getStatusCode(), [200, 201])) {
                $response = array(
                    'success' => true,
                    'code' => $response->getStatusCode(),
                    'data' => json_decode($response->getBody()->getContents(), true),
                    'message' => 'Request OK'
                );
            } else {
                $response = array(
                    'success' => false,
                    'code' => $response->getStatusCode(),
                    'data' => json_decode($response->getBody()->getContents(), true),
                    'message' => 'Request OK'
                );
            }

        } catch (Exception $e) {
            $response = array(
                'success' => false,
                'code' => $e->getCode(),
                'data' => null,
                'message' => $e->getMessage()
            );
        }

        return $response;
    }

    function validateApiKey()
    {
        return $this->makeCall('subscribers?limit=0', 'GET');
    }
}
