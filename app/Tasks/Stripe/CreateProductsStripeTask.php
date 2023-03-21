<?php

namespace App\Tasks\Stripe;

class CreateProductsStripeTask
{
    private $products;
    private $responseData;

    public function __construct($products)
    {
        $this->products = $products;
        $this->responseData = [];
    }

    public function run()
    {
        foreach ($this->products as $product) {
            $this->responseData[] = $this->preapreProduct($product);
        }
        return $this->responseData;
    }

    private function preapreProduct($product)
    {
        return [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $this->getNameProduct($product),
                ],
                'unit_amount' => $product->unit_price * 100,
            ],
            'quantity' => $product->amount
        ];
    }

    private function getNameProduct($product)
    {
        return $product->productModel->name . " ({$product->productModelsFlavor->reference})";
    }
}
