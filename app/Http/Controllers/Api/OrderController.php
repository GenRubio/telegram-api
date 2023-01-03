<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\CreateOrderTask;
use App\Tasks\Order\GetPaymentUrlTask;
use App\Tasks\ValidateProductsStockTask;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        try {
            $customer = (new CustomerService())->getByChat($request->token);
            if (is_null($customer)) {
                throw new GenericException("User not found");
            }
            $validateProductStock = new ValidateProductsStockTask($request->products);
            $createOrder = new CreateOrderTask($request, $customer, $validateProductStock);
            $paymentUrl = (new GetPaymentUrlTask($createOrder->order))->run();
            return response()->json([
                'success' => true,
                'url' => $paymentUrl
            ]);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
