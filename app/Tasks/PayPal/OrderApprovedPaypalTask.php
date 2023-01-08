<?php

namespace App\Tasks\PayPal;

class OrderApprovedPaypalTask
{
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function run()
    {
        $detail = (new GetRetrieveOrderPaypalTask($this->order))->run();
        if ($detail['status'] == "APPROVED") {
            return true;
        }
        return false;
    }
}
