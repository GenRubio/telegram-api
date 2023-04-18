<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use App\Enums\OrderStatusEnum;
use App\Tasks\API\Translations\GenericTextTask;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Order\ProductsOrderResource;
use App\Http\Resources\Api\Order\HistoryStateOrderResource;

class OrdersResource extends JsonResource
{
    private $orders;
    private $telegraphChat;

    public function __construct($telegraphChat)
    {
        $this->telegraphChat = $telegraphChat;
        $this->orders = $this->telegraphChat->orders;
    }

    public function toArray($request)
    {
        $response = [];
        $response['orders'] = $this->getPreparedOrders();
        return $response;
    }

    private function getPreparedOrders()
    {
        $orders = [];
        foreach ($this->orders as $order) {
            if ($order->status == OrderStatusEnum::STATUS_IDS['cancel']) {
                if (!empty($order->order_cancel_detail)) {
                    $orders[] = $this->getOrderData($order);
                }
            } else {
                $orders[] = $this->getOrderData($order);
            }
        }
        return $orders;
    }

    private function getOrderData($order)
    {
        return [
            'reference' => $order->reference,
            'price' => $order->price,
            'total_price' => $order->total_price,
            'shipping_price' => $order->shipping_price,
            'provider_url' => $order->provider_url,
            'order_cancel_detail' => $order->order_cancel_detail,
            'created_at' => Carbon::parse($order->created_at)->format('d-m-Y H:i:s'),
            'updated_at' => Carbon::parse($order->updated_at)->format('d-m-Y H:i:s'),
            'address' => [
                'address' => $order->address,
                'postal_code' => $order->postal_code,
                'city' => $order->city,
                'province' => $order->province,
                'country' => $order->country,
            ],
            'count_products' => count($order->orderProducts),
            'order_products' => json_decode(json_encode(new ProductsOrderResource($order->orderProducts))),
            'history_states' => json_decode(json_encode(new HistoryStateOrderResource(
                $order->orderHistoryStates,
                $this->telegraphChat
            )))
        ];
    }
}
