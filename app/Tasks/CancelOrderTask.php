<?php

namespace App\Tasks;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\ProductModelsFlavorService;

class CancelOrderTask
{
    private $order;
    private $orderService;
    private $productModelsFlavorService;

    public function __construct($order)
    {
        $this->order = $order;
        $this->orderService = new OrderService();
        $this->productModelsFlavorService = new ProductModelsFlavorService();
    }

    public function run()
    {
        $this->updateStatus();
        $this->removeBlockedStock();
    }

    private function updateStatus()
    {
        $this->orderService->updateStatus($this->order->id, OrderStatusEnum::STATUS_IDS['cancel']);
    }

    private function removeBlockedStock()
    {
        foreach ($this->order->orderProducts as $item) {
            $this->productModelsFlavorService->updateRemoveBlockedStock($item->productModelsFlavor->id, $item->amount);
        }
    }
}
