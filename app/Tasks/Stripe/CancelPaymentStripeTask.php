<?php

namespace App\Tasks\Stripe;

use Stripe\Stripe;
use Stripe\StripeClient;

class CancelPaymentStripeTask
{
    private $stripeId;

    public function __construct($stripeId)
    {
        $this->stripeId = $stripeId;
    }

    public function run()
    {
        Stripe::setApiKey(config('app.stripe_private'));
        $stripe = new StripeClient(config('app.stripe_private'));
        $session = $stripe->checkout->sessions->retrieve($this->stripeId);
        if ($session->status == 'open') {
            $stripe->checkout->sessions->expire(
                $this->stripeId,
                []
            );
        }
    }
}
