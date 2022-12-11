<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsDataResource;

class GetProductsController extends Controller
{
    public function index()
    {
        $products = ProductModel::active()->get();
        return response()->json(new ProductsDataResource($products));
    }
}
