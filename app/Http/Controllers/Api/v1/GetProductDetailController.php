<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\ProductModelService;
use App\Services\TelegraphChatService;
use App\Http\Resources\Api\ProductDetailResource;

class GetProductDetailController extends Controller
{
    public function index(Request $request)
    {
        try {
            $chat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            $product = (new ProductModelService())->getByReference($request->reference);
            if (is_null($product)) {
                throw new GenericException("Product not found");
            }
            return response()->json(new ProductDetailResource($product, $chat));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
