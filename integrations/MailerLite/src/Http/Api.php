<?php

namespace Integrations\MailerLite\Http;

use GuzzleHttp\Client;
use Exception;

class Api
{
    public $mailerLiteApiEndpoint;
    public $storeUrl;
    public $apiToken;

    function __construct($apiToken)
    {
        $this->mailerLiteApiEndpoint = config('mailerlite.api_endpoint');
        $this->apiToken = $apiToken;
    }

    function validateApiToken()
    {
        return $this->makeCall('subscribers?limit=0', 'GET');
    }

    function addOrUpdateSubscriber($subsciber)
    {
        return $this->makeCall('subscribers', 'POST', $subsciber);
    }

    function getSubscribersList($params)
    {
        return $this->makeCall('subscribers', 'GET', null, $params);
    }

    function getSubscriber($subsciberId)
    {
        return $this->makeCall('subscribers/' . $subsciberId, 'GET');
    }

    function removeSubscriber($subsciberId)
    {
        return $this->makeCall('subscribers/' . $subsciberId, 'DELETE');
    }

    function makeCall($endpoint, $method, $data = null, $params = [])
    {
        $headers = [];
        $requestData = [];
        
        if (!empty($params)) {
            $endpoint .= '?' . http_build_query($params);
        }
        
        $endpoint = $this->mailerLiteApiEndpoint . $endpoint;
        $headers['Authorization'] = 'Bearer ' . $this->apiToken;
        $headers['Content-Type'] = 'application/json';
        $headers['Accept'] = 'application/json';

        if (!empty($data)) {
            $requestData = array_merge($requestData, $data);
        }

        try {
            $client = new Client([
                'verify' => false
            ]);

            $options = [
                'headers' => $headers,
            ];

            if ($method != 'GET') {
                $options['body'] = json_encode($requestData);
            }

            $response = $client->request($method, $endpoint, $options);

            if (in_array($response->getStatusCode(), [200, 201, 204])) {
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
}
