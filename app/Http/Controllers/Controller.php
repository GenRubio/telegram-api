<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *    title="API Telegram Bot - Documentation",
 *    version="1.0.0",
 *    description="API Telegram Bot - Swagger
 *    To be able to authorize api write in Authorize: Bearer {token}",
 * )
 * @OA\Server(
 *    description="Local server",
 *    url="http://127.0.0.1:8000/api/v1/"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
