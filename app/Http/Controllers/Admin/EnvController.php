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
        return view('backpack.pages.env-manager', [
            'data' => $json,
        ]);
    }
}
