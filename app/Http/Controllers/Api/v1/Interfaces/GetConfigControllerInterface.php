<?php

namespace App\Http\Controllers\Api\v1\Interfaces;

use Illuminate\Http\Request;

interface GetConfigControllerInterface
{
    /**
     * @OA\Get(
     * path="/config",
     * summary="Config",
     * description="Config",
     * operationId="getConfig",
     * tags={"Config"},
     * security={
     *   {"passport": {}},
     * },
     * @OA\Response(
     *    response=200,
     *    description="Results limit exceeded",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="")
     *        )
     *     )
     * )
     * 
     */
    public function index(Request $request);
}
