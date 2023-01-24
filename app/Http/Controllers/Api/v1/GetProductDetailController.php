<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\WebApp\GetBotChatTask;
use App\Services\ProductModelService;
use App\Http\Resources\Api\ProductDetailResource;

class GetProductDetailController extends Controller
{
    public function index(Request $request)
    {
        try {
            (new GetBotChatTask($request->token))->run();
            $product = (new ProductModelService())->getByReference($request->reference);
            if (is_null($product)) {
                throw new GenericException("Product not found");
            }
            return response()->json(new ProductDetailResource($product));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
