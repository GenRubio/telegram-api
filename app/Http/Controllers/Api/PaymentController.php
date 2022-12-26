<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\OrderService;
use App\Tasks\AcceptOrderTask;
use App\Tasks\CancelOrderTask;
use App\Services\SettingService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Bot\SendErrorPaymentMessageTask;
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
            $order = (new OrderService())->getByReference(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            (new AcceptOrderTask($order))->run();
            (new SendSuccessPaymentMessageTask($order))->run();
        } catch (GenericException | Exception $e) {
        }
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }

    public function stripePaymentError(Request $request)
    {
        //try {
        //    $order = (new OrderService())->getByReference(decrypt($request->reference));
        //    if (is_null($order)) {
        //        throw new GenericException("Order not found");
        //    }
        //    (new CancelOrderTask($order))->run();
        //    (new SendErrorPaymentMessageTask($order))->run();
        //} catch (GenericException | Exception $e) {
        //}
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }
}
