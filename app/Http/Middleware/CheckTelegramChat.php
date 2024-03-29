<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\GenericException;
use App\Services\TelegraphChatService;

class CheckTelegramChat
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
            $token = requestAttrEncrypt($request->token);
            $telegraphChatService = new TelegraphChatService();
            $chat = $telegraphChatService->getByChatId($token);
            if (is_null($chat)) {
                throw new GenericException("Chat {$this->chatId} undefined");
            }
        } catch (GenericException | Exception $e) {
            return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
