<?php

namespace App\Prepares;

class OrderProductPrepare
{
    private $order;
    private $validateProductStock;

    public function __construct($order, $validateProductStock)
    {
        $this->order = $order;
        $this->validateProductStock = $validateProductStock;
    }

    public function run()
    {
        $response = [];
        foreach ($this->validateProductStock->flavors as $item) {
            $flavor = $item['flavor'];
            $amount = $item['amount'];
            $response[] = $this->productData($flavor, $amount);
        }
        return $response;
    }

    private function productData($flavor, $amount)
    {
        return [
            'order_id' => $this->order->id,
            'product_model_id' => $flavor->productModel->id,
            'product_models_flavor_id' => $flavor->id,
            'amount' => $amount,
            'unit_price' => $flavor->productModel->price,
            'total_price' => $flavor->productModel->price * $amount,
        ];
    }
}
