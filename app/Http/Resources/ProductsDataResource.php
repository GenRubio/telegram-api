<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsDataResource extends JsonResource
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
            $productData = $this->getProductData($product);
            $productData['flavors'] = $this->getFlavorsData($product);
            $response[] = $productData;
        }
        return $response;
    }

    private function getProductData($product)
    {
        return [
            'name' => $product->name,
            'image' => url($product->image),
            'price' => $product->price,
            'discount' => $product->discount,
            'size' => $product->size,
            'power_range' => $product->power_range,
            'input_voltage' => $product->input_voltage,
            'battery_capacity' => $product->battery_capacity,
            'e_liquid_capacity' => $product->e_liquid_capacity,
            'concentration' => $product->concentration,
            'resistance' => $product->resistance,
            'absorbable_quantity' => $product->absorbable_quantity,
            'charging_port' => $product->charging_port,
        ];
    }

    private function getFlavorsData($product)
    {
        $flavors = [];
        foreach ($product->productModelsFlavors as $flavor) {
            $flavors[] = [
                'name' => $flavor->name,
                'image' => url($flavor->image),
                'stock' => $flavor->stock,
            ];
        }
        return $flavors;
    }
}
