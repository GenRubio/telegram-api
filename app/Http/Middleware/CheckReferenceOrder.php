<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Exceptions\GenericException;

class CheckReferenceOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $order = (new OrderService())->getByReference(decrypt($request->reference));
            if (is_null($order)) {
                throw new GenericException("Error");
            }
        } catch (GenericException | Exception $e) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
