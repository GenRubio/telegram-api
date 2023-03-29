<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\BotChatService;
use App\Services\CustomerService;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Order\CreateOrderTask;
use App\Tasks\Order\GetPaymentUrlTask;
use App\Tasks\ValidateProductsStockTask;
use App\Http\Resources\OrderDataResource;
use App\Http\Resources\Api\OrdersResource;
use App\Tasks\Geocoding\ValidateAddressTask;
use App\Tasks\API\Translations\AddressNotFoundTextTask;

class OrderController extends Controller
{
    public function getOrder(Request $request)
    {
        try {
            $order = (new OrderService())->getByReference($request->reference);
            if (is_null($order)) {
                throw new GenericException("Error");
            }
            return response()->json(new OrderDataResource($order));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => 'Undefined'
            ]);
        }
    }

    public function getOrders(Request $request)
    {
        try {
            $chat = (new BotChatService())->getByChatId(requestAttrEncrypt($request->token));
            return response()->json(new OrdersResource($chat));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => 'Undefined'
            ]);
        }
    }

    public function createOrder(Request $request)
    {
        try {
            /**
             * TODO: CustomerService is deprecated. Usar el BotChatService
             */
            $customer = (new CustomerService())->getByChat(requestAttrEncrypt($request->token));
            if (!(new ValidateAddressTask($request))->run()) {
                throw new GenericException((new AddressNotFoundTextTask($customer->botChat))->run());
            }
            $validateProductStock = new ValidateProductsStockTask($request->products, $customer->botChat);
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
