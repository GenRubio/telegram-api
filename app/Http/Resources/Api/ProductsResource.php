<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    private $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    public function toArray($request)
    {
        $response = [];
        $response['products'] = $this->getPreparedProducts();
        return $response;
    }

    private function getPreparedProducts()
    {
        $products = [];
        foreach ($this->products as $product) {
            $products[] = $this->getProductData($product);
        }
        return $products;
    }

    private function getProductData($product)
    {
        return [
            'reference' => $product->reference,
            'name' => $product->name,
            'image' => url($product->image),
            'price' => $product->price,
            'discount' => $product->discount,
            'price_with_discount' => $product->price_with_discount,
            'brand' => $product->productBrand->name,
            'multiple_flavors' => $product->multiple_flavors,
            'flavors' => count($product->productModelsFlavors)
        ];
    }
}
