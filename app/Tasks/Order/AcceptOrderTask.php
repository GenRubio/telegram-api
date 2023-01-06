<?php

namespace App\Tasks\Order;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\ProductModelsFlavorService;

class AcceptOrderTask
{
    private $order;
    private $productModelsFlavorService;

    public function __construct($order)
    {
        $this->order = $order;
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
        (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['payment_accepted']))->run();
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
