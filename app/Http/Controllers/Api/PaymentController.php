<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\OrderService;
use App\Tasks\AcceptOrderTask;
use App\Services\SettingService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Stripe\ValidatePaymentTask;
use App\Tasks\Stripe\CancelPaymentStripeTask;
use App\Tasks\Bot\SendSuccessPaymentMessageTask;

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
                throw new GenericException("PayPal not working");
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
    }

    public function stripePaymentSuccess(Request $request)
    {
        try {
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ((new ValidatePaymentTask($order->stripe_id))->run()) {
                (new AcceptOrderTask($order))->run();
                (new CancelPaymentStripeTask($order->stripe_id))->run();
                (new SendSuccessPaymentMessageTask($order))->run();
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
        return Redirect::to($order->bot()->bot_url);
    }

    public function stripePaymentError(Request $request)
    {
        try {
            $order = (new OrderService())->getPaymentOrder(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
        return Redirect::to($order->bot()->bot_url);
    }
}
