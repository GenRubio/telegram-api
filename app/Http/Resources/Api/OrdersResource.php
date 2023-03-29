<?php

namespace App\Http\Resources\Api;

use App\Enums\OrderStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    private $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
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
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
            'count_products' => count($order->orderProducts),
            'history_states' => $this->getPreparedHistoryStates($order->orderHistoryStates)
        ];
    }

    private function getPreparedHistoryStates($states)
    {
        $states = [];
        foreach ($states as $state) {
            $states[] = [
                'state' => $state->state,
                'created_at' => $state->created_at
            ];
        }
        return $states;
    }
}
