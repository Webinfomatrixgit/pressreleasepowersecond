<?php

namespace App\Payment\Paypal;

use App\Models\PaymentGateway;
use GuzzleHttp\Client;

class PayPalClient
{
    protected array $credentials;

    private Client $client;

    private $accessToken;

    public function __construct()
    {
        $this->credentials = PaymentGateway::getCredentials('paypal');

        $this->client = new Client([
            'base_uri' => $this->credentials['mode'] === 'sandbox'
                ? 'https://api.sandbox.paypal.com/'
                : 'https://api.paypal.com/',
        ]);
    }

    // Fetch Access Token from PayPal
    protected function getAccessToken(): string
    {
        if (! $this->accessToken) {
            $response = $this->client->post('v1/oauth2/token', [
                'auth' => [$this->credentials['client_id'], $this->credentials['client_secret']],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $this->accessToken = json_decode($response->getBody()->getContents())->access_token;
        }

        return $this->accessToken;
    }

    // Centralize API requests
    protected function makeRequest(string $method, string $uri, array $data = [])
    {
        $response = $this->client->request($method, $uri, [
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents());
    }

    // Function to create a payment request
    public function createPayment(array $payload)
    {
        return $this->makeRequest('POST', 'v1/payments/payment', $payload);
    }

    // Function to execute an approved payment
    public function executePayment(string $paymentId, string $payerId)
    {
        return $this->makeRequest('POST', "v1/payments/payment/{$paymentId}/execute", [
            'payer_id' => $payerId,
        ]);
    }
}
