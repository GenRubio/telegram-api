<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    }

    public function downloadLayout()
    {
        return response()->download(storage_path('env-keys/env-keys.example.json'));
    }
}
