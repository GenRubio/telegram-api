<?php

namespace App\Tasks\Stripe;

use Stripe\Stripe;
use Stripe\StripeClient;

class GetRetrieveStripeTask
{
    private $privateKey;
    private $stripeId;

    public function __construct($stripeId, $privateKey)
    {
        $this->stripeId = $stripeId;
        $this->privateKey = $privateKey;
    }

    public function run()
    {
        Stripe::setApiKey($this->privateKey);
        $stripe = new StripeClient($this->privateKey);
        return $stripe->checkout->sessions->retrieve($this->stripeId);
    }
}
