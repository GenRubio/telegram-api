<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Enums\OrderStatusEnum;
use App\Services\OrderService;
use App\Tasks\CancelOrderTask;
use App\Services\SettingService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Tasks\Bot\SendErrorPaymentMessageTask;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            $order = (new OrderService())
                ->getByReferenceAndStatus(decrypt($request->reference), OrderStatusEnum::STATUS_IDS['pd_payment']);
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ($order->payment_method == "stripe") {
                $response = (new StripePaymentDriver($order))->run();
                return Redirect::to($response->url);
            } else if ($order->payment_method == "paypal") {
                throw new GenericException("PayPal not working");
            }
        } catch (GenericException | Exception $e) {
            $settingService = new SettingService();
            return Redirect::to($settingService->getByKey('1671894524.6744')->value);
        }
    }

    public function paymentSuccess(Request $request)
    {
        try {
            $order = (new OrderService())->getByReference(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
        } catch (GenericException | Exception $e) {
        }
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }

    public function paymentError(Request $request)
    {
        try {
            $order = (new OrderService())->getByReference(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            (new CancelOrderTask($order))->run();
            (new SendErrorPaymentMessageTask($order))->run();
        } catch (GenericException | Exception $e) {
        }
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }
}
