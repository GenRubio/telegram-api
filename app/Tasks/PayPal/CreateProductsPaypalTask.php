<?php

namespace App\Tasks\PayPal;

class CreateProductsPaypalTask
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
            'name' => $this->getNameProduct($product),
            'name' => $this->getNameProduct($product),
            "type" => "DIGITAL",
            "category" => "COMPUTER_AND_DATA_PROCESSING_SERVICES",
            "amount" => [
                "currency_code" => 'EUR',
                "value" => $product->amount
            ]
        ];
    }

    private function getNameProduct($product)
    {
        return $product->productModel->name . " ({$product->productModelsFlavor->name})";
    }
}
