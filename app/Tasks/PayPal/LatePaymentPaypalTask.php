<?php

namespace App\Tasks\PayPal;

use App\Enums\OrderStatusEnum;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\Product\ProductStockManagerTask;
use App\Tasks\Bot\SendPaymentDeniedMessageTask;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class LatePaymentPaypalTask
{
    private $order;
    private $provider;
    private $token;

    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

    public function run()
    {
        $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_late']);
        if ((new ProductStockManagerTask($this->order))->enoughStock()) {
            $this->provider->capturePaymentOrder($this->order->paypal_id);
            $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_accepted']);
            $this->removeStock();
        } else {
            $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_denied']);
            (new SendPaymentDeniedMessageTask($this->order))->run();
        }
    }

    private function updateStatus($status)
    {
        (new UpdateStatusOrderTask($this->order, $status))->run();
    }

    private function removeStock()
    {
        (new ProductStockManagerTask($this->order->orderProducts))->removeStock();
    }
}
