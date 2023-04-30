<?php

namespace App\Tasks\PayPal;

use App\Services\OrderService;
use App\Tasks\PayPal\API\VoidAuthorizedPaymentTask;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CancelPaymentPaypalTask
{
    private $order;
    private $provider;
    private $token;
    private $orderService;

    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials($this->order->paymentAPICredentials());
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
        $this->orderService = new OrderService();
    }

    public function run()
    {
        $this->autorizePaymentOrder();
        (new VoidAuthorizedPaymentTask($this->order))->run();
    }

    private function autorizePaymentOrder()
    {
        $autorize = $this->provider->authorizePaymentOrder($this->order->paypal_id);
        $paymentId = $autorize['purchase_units'][0]['payments']['authorizations'][0]['id'];
        $this->order->payment_id = $paymentId;
        $this->orderService->updatePaymentId($this->order->id, $paymentId);
    }
}
