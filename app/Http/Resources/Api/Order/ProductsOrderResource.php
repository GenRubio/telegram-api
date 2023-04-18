<?php

namespace App\Http\Resources\Api\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsOrderResource extends JsonResource
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->products as $product) {
            $response[] = [
                'amount' => $product->amount,
                'unit_price' => $product->unit_price,
                'total_price' => $product->total_price,
                'product_model' => [
                    'reference' => $product->productModel->reference,
                    'name' => $product->productModel->name,
                    'image' => url($product->productModel->image),
                    'multiple_flavors' => $product->productModel->multiple_flavors,
                    'model' => [
                        'name' =>  $product->productModel->productBrand->name,
                    ]
                ],
                'product_model_flavor' => [
                    'reference' =>  $product->productModelsFlavor->reference,
                    'name' =>  $product->productModelsFlavor->name,
                    'image' =>  url($product->productModelsFlavor->image),
                ]
            ];
        }
        return $response;
    }
}
