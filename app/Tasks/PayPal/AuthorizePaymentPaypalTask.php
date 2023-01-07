<?php

namespace App\Tasks\PayPal;

use Exception;
use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Tasks\Order\UpdateStatusOrderTask;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Tasks\PayPal\API\CheckPaymentCreatedPaypalTask;
use App\Tasks\PayPal\API\CaptureAuthorizedPaymentPaypalTask;

class AuthorizePaymentPaypalTask
{
    private $order;
    private $provider;
    private $token;
    private $orderService;

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
        $autorize = $this->provider->authorizePaymentOrder($this->order->paypal_id);
        $paymentId = $autorize['purchase_units'][0]['payments']['authorizations'][0]['id'];
        $this->orderService->updatePaymentId($this->order->id, $paymentId);
        $this->order->payment_id = $paymentId;
        if ((new CheckPaymentCreatedPaypalTask($this->order))->run()) {
            (new CaptureAuthorizedPaymentPaypalTask($this->order))->run();
            (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['payment_accepted'], null))->run();
            return true;
        } else {
            (new UpdateStatusOrderTask($this->order, OrderStatusEnum::STATUS_IDS['payment_denied'], null))->run();
        }
        return false;
    }
}
