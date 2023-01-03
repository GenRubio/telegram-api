<?php

namespace App\Http\Controllers\Api;

use App\Drivers\PaypalPaymentDriver;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\OrderService;
use App\Services\SettingService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ($order->payment_method == "stripe") {
                $stripe = (new StripePaymentDriver($order))->run();
                return Redirect::to($stripe->url);
            } else if ($order->payment_method == "paypal") {
                $paypal = (new PaypalPaymentDriver($order))->run();
                return Redirect::to($paypal);
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
    }
}
