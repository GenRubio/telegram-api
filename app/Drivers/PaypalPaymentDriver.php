<?php

namespace App\Drivers;

use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentDriver
{
    private $order;
    protected $provider;
    private $token;
    #https://srmklive.github.io/laravel-paypal/docs.html
    #https://github.com/srmklive/laravel-paypal/issues/407
    #Test User
    #sb-97c6v24773152@personal.example.com
    #lu4XH*)?
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function run()
    {
        try{
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal')); // Pull values from Config
            $token = $provider->getAccessToken();
            $provider->setAccessToken($token);
    
            // Prepare Order
            $order = $provider->createOrder([
                'intent'=> 'CAPTURE',
                'purchase_units'=> [[
                    'reference_id' => $this->order->reference,
                    'amount'=> [
                      'currency_code'=> 'EUR',
                      'value'=> '20.00'
                    ]
                ]],
                'application_context' => [
                     'cancel_url' => route('paypal.payment.cancel', ['reference' => encrypt($this->order->reference)]),
                     'return_url' => route('paypal.payment.success', ['reference' => encrypt($this->order->reference)])
                ]
            ]);
        }
        catch(Exception $e){
            dd($e);
        }
        return $order['links'][1]['href'];
    }
}
