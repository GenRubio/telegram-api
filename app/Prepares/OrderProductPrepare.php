<?php

namespace App\Prepares;

use App\Exceptions\GenericException;

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
            'unit_price' => $unitPrice = $this->getUnitPrice($flavor->productModel),
            'total_price' => $unitPrice * $amount,
        ];
    }

    private function getUnitPrice($productModel)
    {
        $productDiscount = 0;
        if (!is_null($productModel->discount > 0) && $productModel->discount > 0) {
            $productDiscount = ($productModel->price * $productModel->discount / 100);
        }
        return $productModel->price - $productDiscount;
    }
}
