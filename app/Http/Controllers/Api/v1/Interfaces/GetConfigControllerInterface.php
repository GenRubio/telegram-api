<?php

namespace App\Http\Controllers\Api\v1\Interfaces;

use Illuminate\Http\Request;

interface GetConfigControllerInterface
{
    /**
     * @OA\Get(
     * path="{token}/config",
     * summary="Config",
     * tags={"Proyect"},
     * @OA\Parameter(
     *     description="Parameter with mutliple examples",
     *     in="path",
     *     name="token",
     *     required=true,
     *     @OA\Schema(type="string"),
     *     @OA\Examples(example="string", value="0006faf6-7a61-426c-9034-579f2cfcfa83", summary="Encrypted chat ID."),
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
