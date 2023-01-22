<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductsResource;
use App\Tasks\WebApp\GetBotChatTask;
use App\Services\ProductModelService;

class GetProductsV1Controller extends Controller
{
    public function index(Request $request)
    {
        try {
            (new GetBotChatTask($request->token))->run();
            $products = (new ProductModelService())->getAllActive();
            return response()->json(new ProductsResource($products));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
