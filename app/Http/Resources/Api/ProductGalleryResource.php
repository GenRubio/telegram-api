<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductGalleryResource extends JsonResource
{
    private $images;

    public function __construct($images)
    {
        $this->images = $images;
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->images as $image) {
            $response[] = [
                'title' => $image->title,
                'alt' => $image->alt,
                'description' => $image->description,
                'image' => url($image->image),
                'order' => $image->order,
                'visible' => $image->visible,
            ];
        }
        return $response;
    }
}
