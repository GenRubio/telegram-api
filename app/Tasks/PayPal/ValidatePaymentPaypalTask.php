<?php

namespace App\Tasks\PayPal;

use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ValidatePaymentPaypalTask
{
    private $paypalId;
    private $provider;
    private $token;

    public function __construct($paypalId)
    {
        $this->paypalId = $paypalId;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

    public function run()
    {
        //
    }

}
