<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Drivers\StripePaymentDriver;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;

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
        try{

        }
        catch (GenericException | Exception $e){
           
        }
    }

    public function paymentError(Request $request)
    {
    }
}
