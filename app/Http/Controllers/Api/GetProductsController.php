<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WebAppDataResource;
use DefStudio\Telegraph\Models\TelegraphChat;

class GetProductsController extends Controller
{
    public function index(Request $request)
    {
        $chat = TelegraphChat::where('chat_id', $request->token)->first();
        if ($chat) {
            $products = ProductModel::active()->get();
            return response()->json(new WebAppDataResource($products, $chat->bot->id));
        }
        return response()->json([
            'error' => 'Undefined'
        ]);
    }
}
