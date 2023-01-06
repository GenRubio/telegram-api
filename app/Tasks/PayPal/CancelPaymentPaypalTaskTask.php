<?php

namespace App\Tasks\PayPal;

use App\Services\OrderService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CancelPaymentPaypalTaskTask
{
    private $order;
    private $orderService;
    private $provider;
    private $token;

    public function __construct($order)
    {
        $this->order = $order;
        $this->orderService = new OrderService();
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

    public function run()
    {
        //$detail = $this->provider->showOrderDetails($this->order->paypal_id);
        //$this->provider->orderVoid($this->order->paypal_id);
        $this->orderService->updatePaypalId($this->order->id, null);
    }
}
