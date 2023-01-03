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
        return route('payment', ['reference' => encrypt($this->order->reference)]);
    }
}
