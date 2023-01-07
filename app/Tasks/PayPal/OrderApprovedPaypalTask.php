<?php

namespace App\Tasks\PayPal;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class OrderApprovedPaypalTask
{
    private $order;
    private $provider;
    private $token;

    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

    public function run()
    {
        $detail = $this->provider->showOrderDetails($this->order->paypal_id);
        if ($detail['status'] == "APPROVED") {
            return true;
        }
        return false;
    }
}
