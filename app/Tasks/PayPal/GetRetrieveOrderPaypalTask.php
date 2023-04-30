<?php

namespace App\Tasks\PayPal;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class GetRetrieveOrderPaypalTask
{
    private $order;
    private $provider;
    private $token;

    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials($this->order->paymentAPICredentials());
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

    public function run()
    {
        return $this->provider->showOrderDetails($this->order->paypal_id);
    }
}
