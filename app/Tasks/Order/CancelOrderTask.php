<?php

namespace App\Tasks\Order;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Services\ProductModelsFlavorService;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\PayPal\CancelPaymentPaypalTaskTask;

class CancelOrderTask
{
    private $order;
    private $productModelsFlavorService;
    private $refund;

    public function __construct($order, $refund = false)
    {
        $this->order = $order;
        $this->productModelsFlavorService = new ProductModelsFlavorService();
        $this->refund = $refund;
    }

    public function run()
    {
        $this->cancelPaymentStripe();
        $this->updateStatus();
        $this->removeBlockedStock();
    }

    private function updateStatus()
    {
        (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['cancel']))->run();
    }

    private function removeBlockedStock()
    {
        foreach ($this->order->orderProducts as $item) {
            $this->productModelsFlavorService->updateRemoveBlockedStock($item->productModelsFlavor->id, $item->amount);
        }
    }

    private function cancelPaymentStripe()
    {
        if ($this->order->payment_method == 'stripe' && !empty($this->order->stripe_id)) {
            (new CancelPaymentStripeTask($this->order->stripe_id))->run();
        }
        if ($this->order->payment_method == 'paypal' && !empty($this->order->paypal_id)) {
            (new CancelPaymentPaypalTaskTask($this->order))->run();
        }
    }
}
