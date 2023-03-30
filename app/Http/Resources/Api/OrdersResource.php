<?php

namespace App\Http\Resources\Api;

use App\Enums\OrderStatusEnum;
use App\Tasks\API\Translations\GenericTextTask;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    private $orders;
    private $chat;

    public function __construct($chat)
    {
        $this->chat = $chat;
        $this->orders = $this->chat->orders;
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
            'address' => [
                'address' => $order->address,
                'postal_code' => $order->postal_code,
                'city' => $order->city,
                'province' => $order->province,
                'country' => $order->country,
            ],
            'count_products' => count($order->orderProducts),
            'order_products' => $this->getPreparedProductsOrder($order->orderProducts),
            'history_states' => $this->getPreparedHistoryStates($order->orderHistoryStates)
        ];
    }

    private function getPreparedProductsOrder($orderProducts)
    {
        $productsData = [];
        foreach ($orderProducts as $orderProduct) {
            $productsData[] = [
                'amount' => $orderProduct->amount,
                'unit_price' => $orderProduct->unit_price,
                'total_price' => $orderProduct->total_price,
                'product_model' => [
                    'reference' => $orderProduct->productModel->reference,
                    'name' => $orderProduct->productModel->name,
                    'image' => $orderProduct->productModel->image,
                    'multiple_flavors' => $orderProduct->productModel->multiple_flavors,
                    'model' => [
                        'name' =>  $orderProduct->productModel->productBrand->name,
                    ]
                ],
                'product_model_flavor' => [
                    'reference' =>  $orderProduct->productModelsFlavor->reference,
                    'name' =>  $orderProduct->productModelsFlavor->name,
                    'image' =>  $orderProduct->productModelsFlavor->image,
                ]
            ];
        }
        return $productsData;
    }

    private function getPreparedHistoryStates($states)
    {
        $statesData = [];
        foreach ($states as $state) {
            $statesData[] = [
                'state' => $state->state,
                'data' => OrderStatusEnum::STATUS_WEB[$state->state],
                'text' => (new GenericTextTask($this->chat, OrderStatusEnum::STATUS_WEB[$state->state]['trans_id']))->run(),
                'created_at' => $state->created_at
            ];
        }
        return $statesData;
    }
}
