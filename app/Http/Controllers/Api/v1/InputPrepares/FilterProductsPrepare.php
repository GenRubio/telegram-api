<?php

namespace App\Http\Controllers\Api\v1\InputPrepares;

class FilterProductsPrepare
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function get()
    {
        return [
            'token' => getJsonFirstLevelAttribute($this->request, 'token'),
            'order_by' => getJsonFirstLevelAttribute($this->request, 'order_by'),
            'nicotine' => getJsonFirstLevelAttribute($this->request, 'nicotine'),
            'brands' => getJsonFirstLevelAttribute($this->request, 'brands', true),
        ];
    }
}
