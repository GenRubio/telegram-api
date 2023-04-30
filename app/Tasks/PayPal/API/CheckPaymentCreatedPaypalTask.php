<?php

namespace App\Tasks\PayPal\API;

class CheckPaymentCreatedPaypalTask
{
    private $order;
    private $paypal;
    private $clientId;
    private $secret;
    private $accessToken;
    private $apiUrl;

    public function __construct($order)
    {
        $this->order = $order;
        $this->paypal = $this->order->paymentAPICredentials();
        $this->apiUrl = $this->paypal['mode'] == "sandbox" ? "https://api.sandbox.paypal.com" : "https://api.paypal.com";
        $this->clientId = $this->paypal['mode'] == "sandbox" ? $this->paypal['sandbox']['client_id'] : $this->paypal['live']['client_id'];
        $this->secret = $this->paypal['mode'] == "sandbox" ? $this->paypal['sandbox']['client_secret'] : $this->paypal['live']['client_secret'];
        $this->accessToken = $this->getAccessToken();
    }

    public function run()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->apiUrl}/v2/payments/authorizations/{$this->order->payment_id}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->accessToken,
            'Content-Type: application/json',
        ));
        $response = curl_exec($ch);
        $json = json_decode($response);
        if ($json->status == 'CREATED') {
            return true;
        }
        return false;
    }

    private function getAccessToken()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->apiUrl}/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->clientId . ':' . $this->secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');
        $response = curl_exec($ch);
        $json = json_decode($response);
        return $json->access_token;
    }
}
