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
            'price' => $product->price_getter,
            'discount' => $product->discount_getter,
            'size' => $product->size_getter,
            'power_range' => $product->power_range_getter,
            'input_voltage' => $product->input_voltage_getter,
            'battery_capacity' => $product->battery_capacity_getter,
            'e_liquid_capacity' => $product->e_liquid_capacity_getter,
            'concentration' => $product->concentration_getter,
            'resistance' => $product->resistance_getter,
            'absorbable_quantity' => $product->absorbable_quantity_getter,
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
