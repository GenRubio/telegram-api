<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsDataResource;
use DefStudio\Telegraph\Models\TelegraphChat;

class GetProductsController extends Controller
{
    public function index(Request $request)
    {
        $chat = TelegraphChat::where('chat_id', $request->token)->first();
        if ($chat) {
            $products = ProductModel::active()->get();
            return response()->json(new ProductsDataResource($products));
        }
        return response()->json([
            'error' => 'Undefined'
        ]);
    }
}
