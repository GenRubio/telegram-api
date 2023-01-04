<?php

namespace App\Tasks\Stripe;

use Stripe\Stripe;
use Stripe\StripeClient;

class ValidatePaymentStripeTask
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
        if ($session->payment_status == 'paid' && $session->status == 'complete') {
            return true;
        }
        return false;
    }
}
