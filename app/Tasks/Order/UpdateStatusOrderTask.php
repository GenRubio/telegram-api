<?php

namespace App\Tasks\Order;

use App\Services\OrderService;
use App\Services\OrderHistoryStateService;

class UpdateStatusOrderTask
{
    private $order;
    private $newStatus;
    private $orderService;
    private $orderHistoryStateService;

    public function __construct($order, $newStatus)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
        $this->orderService = new OrderService();
        $this->orderHistoryStateService = new OrderHistoryStateService();
    }

    public function run()
    {
        $this->orderService->updateStatus($this->order->id, $this->newStatus);
        $this->orderHistoryStateService->create([
            'order_id' => $this->order->id,
            'user_id' => backpack_user() ? backpack_user()->id : null,
            'state' => $this->newStatus
        ]);
    }
}
