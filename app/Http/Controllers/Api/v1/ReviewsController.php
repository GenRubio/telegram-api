<?php

namespace App\Http\Controllers\Api\v1;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GenericException;
use App\Http\Controllers\Controller;
use App\Tasks\Review\CreateReviewTask;

class ReviewsController extends Controller
{
    public function create(Request $request)
    {
        try {
            (new CreateReviewTask($request))->run();
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
