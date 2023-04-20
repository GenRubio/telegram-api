<?php

namespace App\Http\Controllers\Api\v1\Interfaces;

use Illuminate\Http\Request;

interface GetConfigControllerInterface
{
    /**
     * @OA\Get(
     * path="/{token}/config",
     * summary="Config",
     * tags={"Proyect"},
     * @OA\Parameter(
     *     description="Encrypted Chat ID",
     *     in="path",
     *     name="token",
     *     required=true,
     *     @OA\Schema(type="string")
     * ),
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
