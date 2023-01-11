<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\CustomerService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\CreateOrderTask;
use App\Tasks\Order\GetPaymentUrlTask;
use App\Tasks\ValidateProductsStockTask;
use App\Http\Resources\OrderDataResource;
use App\Tasks\Geocoding\ValidateAddressTask;

class OrderController extends Controller
{
    public function getOrder(Request $request)
    {
        try {
            $order = (new OrderService())->getByReference($request->reference);
            if (is_null($order)) {
                throw new GenericException("Order not found");
            }
            return response()->json(new OrderDataResource($order));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => 'Undefined'
            ]);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            $customer = (new CustomerService())->getByChat($request->token);
            if (is_null($customer)) {
                throw new GenericException("Ha ocurrido un error");
            }
            if (!(new ValidateAddressTask($request))->run()) {
                throw new GenericException("No hemos podido localizar tu direccion. Requerda que solo hacemos envios a España");
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
