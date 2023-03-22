<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;

class GetLocalizationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $file = file_get_contents(storage_path('postal_codes/postal_codes_spain.json'));
            $data = json_decode($file, true);
            return response()->json([
                'data' => $data[$request->cp]
            ]);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
