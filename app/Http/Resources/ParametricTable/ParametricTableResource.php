<?php

namespace App\Http\Resources\ParametricTable;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ParametricTableValue\ParametricTableValueCollection;

class ParametricTableResource extends JsonResource
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
            'name' => $this->name,
            'comment' => $this->comment,
            'parametric_table_values' => new ParametricTableValueCollection($this->parametricTableValuesResource),
        ];
    }
}
