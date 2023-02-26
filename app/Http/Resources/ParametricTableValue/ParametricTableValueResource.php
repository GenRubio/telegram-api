<?php

namespace App\Http\Resources\ParametricTableValue;

use Illuminate\Http\Resources\Json\JsonResource;

class ParametricTableValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'name' => $this->name,
            'parameter' => $this->parameter,
            'description' => $this->description,
            'order' => $this->order,
            'filter' => $this->filter,
            'visible' => $this->visible,
        ];
    }
}
