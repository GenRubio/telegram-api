<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\ProductModelService;
use App\Http\Resources\Api\ProductsResource;
use App\Http\Controllers\Api\v1\InputPrepares\FilterProductsPrepare;

class GetProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filter = (new FilterProductsPrepare($request))->get();
            $products = (new ProductModelService())->get($filter);
            return response()->json(new ProductsResource($products));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
