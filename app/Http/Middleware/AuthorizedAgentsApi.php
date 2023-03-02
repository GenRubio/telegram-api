<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\ApiClientService;
use App\Exceptions\GenericException;

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
        if (config('app.env') != 'local') {
            try {
                $referer = $this->formatted($_SERVER['HTTP_REFERER']);
                $origin = $this->formatted($_SERVER['HTTP_ORIGIN']);
                $remotePort = $_SERVER['REMOTE_PORT'];
                if ($referer != $origin) {
                    throw new GenericException("Error");
                }
                $apiClient = (new ApiClientService())->getByDomain($origin);
                if (!$apiClient) {
                    throw new GenericException("Error");
                }
            } catch (GenericException | Exception $e) {
                return response('Unauthorized.', 401);
            }
        }
        return $next($request);
    }

    private function formatted($text)
    {
        $text = str_replace("/", "", $text);
        $text = str_replace("https:", "", $text);
        $text = str_replace("http:", "", $text);
        return $text;
    }
}
