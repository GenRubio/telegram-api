<?php

namespace App\Tasks;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\ProductModelsFlavorService;
use App\Tasks\Stripe\CancelPaymentStripeTask;

class CancelOrderTask
{
    private $order;
    private $orderService;
    private $productModelsFlavorService;
    private $refund;

    public function __construct($order, $refund = false)
    {
        $this->order = $order;
        $this->orderService = new OrderService();
        $this->productModelsFlavorService = new ProductModelsFlavorService();
        $this->refund = $refund;
    }

    public function run()
    {
        $this->updateStatus();
        $this->removeBlockedStock();
        $this->cancelPaymentStripe();
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

    private function cancelPaymentStripe()
    {
        if ($this->order->payment_method == 'stripe') {
            (new CancelPaymentStripeTask($this->order->stripe_id))->run();
        }
    }
}
