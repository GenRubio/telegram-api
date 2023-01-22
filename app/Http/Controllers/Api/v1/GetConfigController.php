<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\WebApp\GetBotChatTask;
use App\Http\Resources\Api\ConfigResource;

class GetConfigController extends Controller
{
    public function index(Request $request)
    {
        try {
            $chat = (new GetBotChatTask($request->token))->run();
            return response()->json(new ConfigResource($chat));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
