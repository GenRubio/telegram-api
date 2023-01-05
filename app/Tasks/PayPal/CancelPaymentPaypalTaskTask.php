<?php

namespace App\Tasks\PayPal;

use App\Services\OrderService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CancelPaymentPaypalTaskTask
{
    private $order;
    private $orderService;
    //private $provider;
    //private $token;

    public function __construct($order)
    {
        $this->order = $order;
        $this->orderService = new OrderService();
    }

    public function run()
    {
        //$order = $this->provider->showOrderDetails($this->paypalId);
        //$this->provider->voidAuthorizedPayment($this->paypalId);
        //dd($this->provider->showOrderDetails($this->paypalId));
        $this->orderService->updatePaypalId($this->order->id, null);
    }
}
