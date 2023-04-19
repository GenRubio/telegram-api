<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\TelegraphChatService;
use App\Http\Resources\Api\ConfigResource;
use App\Http\Controllers\Api\v1\Interfaces\GetConfigControllerInterface;

class GetConfigController extends Controller implements GetConfigControllerInterface
{

    public function index(Request $request)
    {
        try {
            $telegraphChat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            return response()->json(new ConfigResource($telegraphChat));
        } catch (GenericException | Exception $e) {
            Log::channel('api-controllers')->error($e);
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
