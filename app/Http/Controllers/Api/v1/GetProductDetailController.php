<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
            $telegraphChat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            $product = (new ProductModelService())->getByReference($request->reference);
            if (is_null($product)) {
                throw new GenericException("Product not found");
            }
            return response()->json(new ProductDetailResource($product, $telegraphChat));
        } catch (GenericException | Exception $e) {
            Log::channel('api-controllers')->error($e);
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
