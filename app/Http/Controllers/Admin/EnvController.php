<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\GenericException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class EnvController extends Controller
{
    public function index()
    {
        $path = storage_path() . "/env-keys/env-keys.json";
        $json = json_decode(file_get_contents($path), true);
        foreach ($json as $key => $value) {
            foreach ($value['parameters'] as $keyParameter => $valueParameter) {
                if (!$valueParameter['show_value']) {
                    $json[$key]['parameters'][$keyParameter]['value'] = "-";
                }
            }
        }
        return view('backpack.pages.env-manager', [
            'data' => $json,
        ]);
    }

    public function uploadLayout(Request $request)
    {
        try{
            $data = json_decode($request->file('env_file')->get());
        }
        catch(GenericException | Exception $e){
            return response()->json([
                'success' => false,
                'title' => 'Error',
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'success' => true,
            'title' => 'Success',
            'message' => 'File uploaded successfully',
        ]);
    }

    public function downloadLayout()
    {
        return response()->download(storage_path('env-keys/env-keys.example.json'));
    }
}
