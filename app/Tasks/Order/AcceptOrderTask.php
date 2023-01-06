<?php

namespace App\Tasks\Order;

use App\Enums\OrderStatusEnum;
use App\Tasks\Product\ProductStockManagerTask;

class AcceptOrderTask
{
    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function run()
    {
        $this->updateStatus();
        $this->removeStock();
        $this->removeBlockedStock();
    }

    private function updateStatus()
    {
        (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['payment_accepted']))->run();
    }

    private function removeStock()
    {
        (new ProductStockManagerTask($this->order->orderProducts))->removeStock();
    }

    private function removeBlockedStock()
    {
        (new ProductStockManagerTask($this->order->orderProducts))->removeBlockedStock();
    }
}
