<?php

namespace App\Drivers;

use Exception;
use App\Services\OrderService;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentDriver
{
    private $order;
    private $provider;
    private $token;
    private $orderService;
    #https://srmklive.github.io/laravel-paypal/docs.html
    #https://github.com/srmklive/laravel-paypal/issues/407
    #Test User
    #sb-97c6v24773152@personal.example.com
    #lu4XH*)?
    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
        $this->orderService = new OrderService();
    }

    public function run()
    {
        try {
            $order = $this->provider->createOrder([
                'intent' => 'CAPTURE',
                'purchase_units' => [[
                    'reference_id' => $this->order->reference,
                    //'description' => $plan->name,
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => '20.00'
                    ],
                    //'items' => [
                    //    [
                    //        'name' => number_format($plan->credits) . ' Plan',
                    //        'unit_amount' => 10,
                    //        'quantity' => 1,
                    //        'description' => $plan->name,
                    //        'category' => 'DIGITAL_GOODS',
                    //    ]
                    //]
                ]],
                'application_context' => [
                    'cancel_url' => route('paypal.payment.cancel', ['reference' => encrypt($this->order->reference)]),
                    'return_url' => route('paypal.payment.success', ['reference' => encrypt($this->order->reference)])
                ]
            ]);
        } catch (Exception $e) {
            dd($e);
        }
        $this->orderService->updatePaypalId($this->order->id, $order['id']);
        return $order['links'][1]['href'];
    }
}
