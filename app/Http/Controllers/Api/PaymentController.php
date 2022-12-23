<?php

namespace App\Http\Controllers\Api;

use Stripe\Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        Stripe::setApiKey(config('app.stripe_private'));
    }

    public function paymentSuccess(Request $request)
    {
    }

    public function paymentError(Request $request)
    {
    }
}
