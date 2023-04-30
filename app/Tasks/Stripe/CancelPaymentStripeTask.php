<?php

namespace App\Tasks\Stripe;

use Stripe\Stripe;
use Stripe\StripeClient;

class CancelPaymentStripeTask
{
    private $stripeId;
    private $privateKey;

    public function __construct($stripeId, $privateKey)
    {
        $this->stripeId = $stripeId;
        $this->privateKey = $privateKey;
    }

    public function run()
    {
        Stripe::setApiKey($this->privateKey);
        $stripe = new StripeClient($this->privateKey);
        $session = $stripe->checkout->sessions->retrieve($this->stripeId);
        if ($session->status == 'open') {
            $stripe->checkout->sessions->expire(
                $this->stripeId,
                []
            );
        }
    }
}
