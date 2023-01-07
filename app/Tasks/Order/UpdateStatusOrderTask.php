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
    private $user;

    public function __construct($order, $newStatus, $user)
    {
        $this->order = $order;
        $this->newStatus = $newStatus;
        $this->user = $user;
        $this->orderService = new OrderService();
        $this->orderHistoryStateService = new OrderHistoryStateService();
    }

    public function run()
    {
        $this->orderService->updateStatus($this->order->id, $this->newStatus);
        $this->orderHistoryStateService->create([
            'order_id' => $this->order->id,
            'user_id' => $this->user ? $this->user->id : null,
            'state' => $this->newStatus
        ]);
    }
}
