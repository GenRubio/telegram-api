<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\AuthorizedApiAgentService;

class AuthorizedAgentsApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //$authorizedApiAgents = (new AuthorizedApiAgentService())->getAllAuthorizedAgent();
        //Log::channel('api-agent')->info("Agent: IP: " . getAgentIp());
        //if (env('APP_ENV') != "local" && !in_array(getAgentIp(), $authorizedApiAgents)) {
        //    return response()->json(array(
        //        'success' => false,
        //        'message' => 'You are blocked to call API!'
        //    ));
        //}

        return $next($request);
    }
}
