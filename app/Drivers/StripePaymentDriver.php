<?php

namespace App\Drivers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Tasks\Stripe\CreateProductsStripeTask;

class StripePaymentDriver
{
    private $order;
    private $orderProducts;

    public function __construct($order)
    {
        $this->order = $order;
        $this->orderProducts = (new CreateProductsStripeTask($order->orderProducts))->run();
    }

    public function run()
    {
        Stripe::setApiKey(config('app.stripe_private'));
        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$this->orderProducts],
            'mode' => 'payment',
            'success_url' => route('stripe.payment.success', encrypt($this->order->reference)),
            'cancel_url' => route('stripe.payment.cancel', encrypt($this->order->reference)),
        ]);
    }
}
