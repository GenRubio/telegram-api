<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\OrderService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        try {
            $order = (new OrderService())->getByReference(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            if ($order->payment_method == "stripe") {
                $response = (new StripePaymentDriver($order))->run();
                return response()->json([
                    'id' => $response->id,
                ], Response::HTTP_CREATED);
            } else if ($order->payment_method == "paypal") {
                throw new GenericException("PayPal not working");
            }
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }

    public function paymentError(Request $request)
    {
        $settingService = new SettingService();
        return Redirect::to($settingService->getByKey('1671894524.6744')->value);
    }
}
