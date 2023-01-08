<?php

namespace App\Tasks\Stripe;

class ValidatePaymentStripeTask
{
    private $stripeId;

    public function __construct($stripeId)
    {
        $this->stripeId = $stripeId;
    }

    public function run()
    {
        $session = (new GetRetrieveStripeTask($this->stripeId))->run();
        if ($session->payment_status == 'paid' && $session->status == 'complete') {
            return true;
        }
        return false;
    }
}
