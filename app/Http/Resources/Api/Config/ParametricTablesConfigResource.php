<?php

namespace App\Http\Resources\Api\Config;

use App\Services\ParametricTableService;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ParametricTable\ParametricTableCollection;

class ParametricTablesConfigResource extends JsonResource
{
    private $parametricTables;
    
    public function __construct()
    {
        $this->parametricTables = (new ParametricTableService())->getForResource();
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->parametricTables as $table) {
            $response[$table->name] = (new ParametricTableCollection([$table]))[0];
        }
        return $response;
    }
}
