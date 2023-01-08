<?php

namespace App\Tasks\Stripe;

use Stripe\Stripe;
use Stripe\StripeClient;

class GetRetrieveStripeTask
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
        return $stripe->checkout->sessions->retrieve($this->stripeId);
    }
}
