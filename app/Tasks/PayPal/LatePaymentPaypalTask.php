<?php

namespace App\Tasks\PayPal;

use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Tasks\Order\UpdateStatusOrderTask;
use App\Tasks\Bot\SendPaymentErrorMessageTask;
use App\Tasks\Product\ProductStockManagerTask;
use App\Tasks\Bot\SendPaymentDeniedMessageTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;
use App\Tasks\PayPal\API\VoidAuthorizedPaymentTask;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Tasks\PayPal\API\CheckPaymentCreatedPaypalTask;
use App\Tasks\PayPal\API\CheckPaymentCompletedPaypalTask;
use App\Tasks\PayPal\API\CaptureAuthorizedPaymentPaypalTask;

class LatePaymentPaypalTask
{
    private $order;
    private $provider;
    private $token;
    private $orderService;
    private $capture;

    public function __construct($order)
    {
        $this->order = $order;
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
        $this->orderService = new OrderService();
    }

    public function run()
    {
        $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_late']);
        $this->capturePaymentOrder();
        if ((new CheckPaymentCreatedPaypalTask($this->order))->run()) {
            if ((new ProductStockManagerTask($this->order))->enoughStock()) {
                $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_accepted']);
                $this->removeStock();
                (new CaptureAuthorizedPaymentPaypalTask($this->order))->run();
                $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_completed']);
                (new SendSuccessPaymentMessageTask($this->order))->run();
            } else {
                (new VoidAuthorizedPaymentTask($this->order))->run();
                $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_denied']);
                (new SendPaymentDeniedMessageTask($this->order))->run();
            }
        } else {
            $this->updateStatus(OrderStatusEnum::STATUS_IDS['payment_denied']);
            (new SendPaymentErrorMessageTask($this->order))->run();
        }
    }

    private function capturePaymentOrder()
    {
        $this->capture = $this->provider->capturePaymentOrder($this->order->paypal_id);
        $paymentId = $this->capture['purchase_units'][0]['payments']['captures'][0]['id'];
        $this->order->payment_id = $paymentId;
        $this->orderService->updatePaymentId($this->order->id, $paymentId);
    }

    private function updateStatus($status)
    {
        (new UpdateStatusOrderTask($this->order, $status, null))->run();
    }

    private function removeStock()
    {
        (new ProductStockManagerTask($this->order->orderProducts))->removeStock();
    }
}
