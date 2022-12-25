<?php

namespace App\Tasks;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\ProductModelsFlavorService;

class AcceptOrderTask
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
        $this->removeStock();
        $this->removeBlockedStock();
    }

    private function updateStatus()
    {
        $this->orderService->updateStatus($this->order->id, OrderStatusEnum::STATUS_IDS['payment_accepted']);
    }

    private function removeStock()
    {
        foreach ($this->order->orderProducts as $item) {
            $this->productModelsFlavorService->updateRemoveStock($item->productModelsFlavor->id, $item->amount);
        }
    }

    private function removeBlockedStock()
    {
        foreach ($this->order->orderProducts as $item) {
            $this->productModelsFlavorService->updateRemoveBlockedStock($item->productModelsFlavor->id, $item->amount);
        }
    }
}
