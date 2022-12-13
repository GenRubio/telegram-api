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
            'description' => [
                [
                    'name' => 'Size',
                    'value' => $product->size,
                    'simbol' => 'mm',
                    'image' => url('images/icons/bg3-1.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'Power Range',
                    'value' => $product->power_range,
                    'simbol' => 'W',
                    'has_images' => false
                ],
                [
                    'name' => 'Battery Capacity',
                    'value' => $product->battery_capacity,
                    'simbol' => 'mAh',
                    'image' => url('images/icons/bg3-4.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'E-liquid Capacity',
                    'value' => $product->e_liquid_capacity,
                    'simbol' => 'ml',
                    'image' => url('images/icons/bg3-5.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'Nicotine Salt',
                    'value' => $product->concentration,
                    'simbol' => 'mg/ml',
                    'image' => url('images/icons/bg3-1.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'Resistance',
                    'value' => $product->resistance,
                    'simbol' => 'Ω',
                    'image' => url('images/icons/bg3-6.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'Absorbable quantity',
                    'value' => $product->absorbable_quantity,
                    'simbol' => 'Puffs',
                    'image' => url('images/icons/bg3-2.png'),
                    'has_images' => true
                ],
                [
                    'name' => 'Charging port',
                    'value' => $product->charging_port,
                    'simbol' => null,
                    'image' => url('images/icons/bg3-3.png'),
                    'has_images' => true
                ]
            ]
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
