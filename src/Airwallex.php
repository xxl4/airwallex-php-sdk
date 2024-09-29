<?php

namespace Nicelizhi\Airwallex;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use RuntimeException as GlobalRuntimeException;

class Airwallex
{
    const VERSION = '1.0.0';

    const API_BASE = 'https://api.airwallex.com';

    const API_VERSION = 'v1';

    const API_URL = self::API_BASE . '/' . self::API_VERSION;

    private $apiKey;

    private $apiBase;

    private $env; 

    private $client;

    private $clientId;


    public function __construct($apiKey = null, $clientId=null, $env = null, $apiBase = null)
    {
        $this->apiKey = $apiKey;
        $this->apiBase = $apiBase ?: self::API_BASE;
        $this->env = $env;
        $this->clientId = $clientId;

        if(empty($this->client)) {
            $this->client = new Client(
                [
                    'base_uri' => $this->apiBase,
                    'timeout' => 10.0,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Charset' => 'UTF-8',
                        'Version' => self::VERSION,
                        'Authorization' => 'Bearer ' . $this->getToken()
                    ]
                ]
            );
        }
        
    }

    // Get token from Airwallex API
    public function getToken()
    {
        // Get token from Airwallex API

        try {

            $response = $this->client->request('POST', "/api/v1/authentication/login", [ 
                'headers' => [
                     'Accept' => 'application/json', 
                     'content-type' => 'application/json',
                     'x-client-id' => $this->clientId, 
                     'x-api-key' => $this->apiKey, 
                ]
            ]);

            $body = json_decode($response->getBody()->getContents(), true);
            return $body['token'];
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createPayment($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payments", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getPayment($paymentId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/payments/{$paymentId}", [ 
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createPayout($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payouts", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getPayout($payoutId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/payouts/{$payoutId}", [ 
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createTransfer($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/transfers", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }

    }

    public function getTransfer($transferId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/transfers/{$transferId}", [ 
            ]);

            return json_decode($response->getBody()->getContents(), true);

        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }

    }

    public function createRefund($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/refunds", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getRefund($refundId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/refunds/{$refundId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createWebhook($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/webhooks", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getWebhook($webhookId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/webhooks/{$webhookId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getWebhooks()
    {
        try {
            $response = $this->client->request('GET', "/api/v1/webhooks", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function deleteWebhook($webhookId)
    {
        try {
            $response = $this->client->request('DELETE', "/api/v1/webhooks/{$webhookId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function updateWebhook($webhookId, $data)
    {
        try {
            $response = $this->client->request('PUT', "/api/v1/webhooks/{$webhookId}", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createWebhookEvent($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/webhook-events", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getWebhookEvent($webhookEventId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/webhook-events/{$webhookEventId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getWebhookEvents()
    {
        try {
            $response = $this->client->request('GET', "/api/v1/webhook-events", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function deleteWebhookEvent($webhookEventId)
    {
        try {
            $response = $this->client->request('DELETE', "/api/v1/webhook-events/{$webhookEventId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function updateWebhookEvent($webhookEventId, $data)
    {
        try {
            $response = $this->client->request('PUT', "/api/v1/webhook-events/{$webhookEventId}", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createPaymentIntent($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-intents", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getPaymentIntent($paymentIntentId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/payment-intents/{$paymentIntentId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function cancelPaymentIntent($paymentIntentId)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-intents/{$paymentIntentId}/cancel", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function capturePaymentIntent($paymentIntentId, $data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-intents/{$paymentIntentId}/capture", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function confirmPaymentIntent($paymentIntentId, $data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-intents/{$paymentIntentId}/confirm", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createPaymentMethod($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-methods", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getPaymentMethod($paymentMethodId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/payment-methods/{$paymentMethodId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function detachPaymentMethod($paymentMethodId)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-methods/{$paymentMethodId}/detach", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function createPaymentMethodToken($data)
    {
        try {
            $response = $this->client->request('POST', "/api/v1/payment-method-tokens", [ 
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }

    public function getPaymentMethodToken($paymentMethodTokenId)
    {
        try {
            $response = $this->client->request('GET', "/api/v1/payment-method-tokens/{$paymentMethodTokenId}", []);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $e) {
            throw new GlobalRuntimeException($e->getMessage());
        }
    }


}