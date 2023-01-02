<?php

namespace App\Tasks\Order;

class GetPaymentUrlTask
{
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function run()
    {
        $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        if ($this->order->payment_method == 'stripe') {
            $paymentUrl = route('stripe.payment', ['reference' => encrypt($this->order->reference)]);
        }
        return $paymentUrl;
    }
}
