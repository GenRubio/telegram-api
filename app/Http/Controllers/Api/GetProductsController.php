<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WebAppDataResource;
use App\Models\BotChat;
use DefStudio\Telegraph\Models\TelegraphChat;

class GetProductsController extends Controller
{
    public function index(Request $request)
    {
        $chat = BotChat::where('chat_id', $request->token)->first();
        if ($chat) {
            $products = ProductModel::active()->get();
            return response()->json(new WebAppDataResource($products, $chat));
        }
        return response()->json([
            'error' => 'Undefined'
        ]);
    }
}
