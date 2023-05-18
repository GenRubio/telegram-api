<?php

namespace App\Http\Resources\Api\ProductDetail;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ValorationsProductDetailResource extends JsonResource
{
    private $product;
    private $telegraphChat;

    public function __construct($product, $telegraphChat)
    {
        $this->product = $product;
        $this->telegraphChat = $telegraphChat;
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
                'visible' => $valoration->visible,
                'user_valoration' => $this->telegraphChat->chat_id == $valoration->chat_id ? true : false,
                'created_at' => Carbon::parse($valoration->created_at)->format('d/m/Y'),
            ];
        }
        return $response;
    }
}
