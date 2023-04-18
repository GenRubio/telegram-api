<?php

namespace App\Http\Resources\Api\ProductDetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ValorationsProductDetailResource extends JsonResource
{
    private $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->product->valorations as $valoration) {
            $response[] = [
                'stars' => $valoration->stars,
                'comment' => $valoration->comment,
                'likes' => $valoration->likes,
                'dislikes' => $valoration->dislikes,
                'created_at' => $valoration->created_at,
            ];
        }
        return $response;
    }
}
