<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Services\TelegraphChatService;
use App\Tasks\Valoration\CreateValorationTask;

class ValorationsController extends Controller
{
    public function create(Request $request)
    {
        try {
            $telegraphChat = (new TelegraphChatService())->getByChatId(requestAttrEncrypt($request->token));
            (new CreateValorationTask($telegraphChat, $request))->run();
            return response()->json([
                'success' => true,
            ]);
        } catch (GenericException | Exception $e) {
            Log::channel('api-controllers')->error($e);
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
