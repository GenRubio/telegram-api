<?php

namespace App\Tasks\Order;

use App\Services\OrderService;

class UpdateStatusOrderTask
{
    private $order;
    private $newStatus;
    private $orderService;

    public function __construct($order, $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
        $this->orderService = new OrderService();
    }

    public function run()
    {
        $this->orderService->updateStatus($this->order->id, $this->newStatus);
    }
}
