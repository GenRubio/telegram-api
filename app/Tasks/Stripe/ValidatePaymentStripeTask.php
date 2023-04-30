<?php

namespace App\Tasks\Stripe;

class ValidatePaymentStripeTask
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
        $session = (new GetRetrieveStripeTask($this->stripeId, $this->privateKey))->run();
        if ($session->payment_status == 'paid' && $session->status == 'complete') {
            return true;
        }
        return false;
    }
}
