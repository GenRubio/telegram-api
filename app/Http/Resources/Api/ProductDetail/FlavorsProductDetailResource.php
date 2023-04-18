<?php

namespace App\Http\Resources\Api\ProductDetail;

use Illuminate\Http\Resources\Json\JsonResource;

class FlavorsProductDetailResource extends JsonResource
{
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->product->productModelsFlavors as $flavor) {
            $response[] = [
                'reference' => $flavor->reference,
                'name' => $flavor->name,
                'image' => url($flavor->image),
                'stock' => $flavor->stock - $flavor->stock_bloqued,
                'product_model' => [
                    'reference' => $flavor->productModel->reference,
                    'name' => $flavor->productModel->name,
                    'image' => url($flavor->productModel->image),
                    'price' => $flavor->productModel->price,
                    'discount' => $flavor->productModel->discount,
                    'price_with_discount' => $flavor->productModel->price_with_discount,
                    'brand' => $flavor->productModel->productBrand->name,
                    'multiple_flavors' => $flavor->productModel->multiple_flavors,
                ],
            ];
        }
        return $response;
    }
}
