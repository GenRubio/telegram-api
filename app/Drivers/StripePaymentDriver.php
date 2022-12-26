<?php

namespace App\Drivers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Services\OrderService;
use App\Tasks\Stripe\CreateProductsStripeTask;

class StripePaymentDriver
{
    private $order;
    private $orderProducts;
    private $orderService;

    public function __construct($order)
    {
        $this->order = $order;
        $this->orderProducts = (new CreateProductsStripeTask($order->orderProducts))->run();
        $this->orderService = new OrderService();
    }

    public function run()
    {
        Stripe::setApiKey(config('app.stripe_private'));
        if (!empty($this->order->stripe_id)) {
            $session = $this->getSession($this->order->stripe_id);
        } else {
            $session = $this->createSession();
        }
        return $session;
    }

    private function getSession($stripeId)
    {
        return Session::retrieve($stripeId);
    }

    private function createSession()
    {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$this->orderProducts],
            'mode' => 'payment',
            'success_url' => route('stripe.payment.success', encrypt($this->order->reference)),
            'cancel_url' => route('stripe.payment.cancel', encrypt($this->order->reference)),
        ]);
        $this->orderService->updateStripeId($this->order->id, $session->id);
        return $session;
    }
}
