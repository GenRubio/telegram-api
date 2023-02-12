<?php

namespace App\Http\Resources\Api;

use App\Services\BrandService;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
{
    private $brandService;
    private $brands;

    public function __construct()
    {
        $this->brandService = new BrandService();
        $this->brands = $this->setBrands();
    }

    public function toArray($request)
    {
        $response = [];
        foreach ($this->brands as $brand) {
            $response[] = [
                'id' => $brand->id,
                'name' => $brand->name
            ];
        }
        return $response;
    }

    private function setBrands()
    {
        return $this->brandService->getAllActive();
    }
}
