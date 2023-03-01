<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ConfigResource;
use Illuminate\Support\Facades\Log;

class GetConfigController extends Controller
{
    public function index(Request $request)
    {
        Log::info(getAgentIp());
        try {
            return response()->json(new ConfigResource(requestAttrEncrypt($request->token)));
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
