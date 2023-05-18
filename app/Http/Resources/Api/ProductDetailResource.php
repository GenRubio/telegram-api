<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ProductDetail\FlavorsProductDetailResource;
use App\Http\Resources\Api\ProductDetail\ProductProductDetailResource;
use App\Http\Resources\Api\ProductDetail\ValorationsProductDetailResource;

class ProductDetailResource extends JsonResource
{
    private $product;
    private $telegraphChat;
    private $language;

    public function __construct($product, $telegraphChat)
    {
        $this->product = $product;
        $this->telegraphChat = $telegraphChat;
        $this->language = $this->telegraphChat->language->abbr;
    }

    public function toArray($request)
    {
        $response = [];
        $response['product'] = json_decode(json_encode(new ProductProductDetailResource(
            $this->product,
            $this->telegraphChat,
            $this->language,
        )));
        $response['flavors'] = json_decode(json_encode(new FlavorsProductDetailResource($this->product)));
        $response['valorations'] = json_decode(json_encode(new ValorationsProductDetailResource(
            $this->product,
            $this->telegraphChat
        )));
        return $response;
    }
}
