<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\BotChatService;
use App\Exceptions\GenericException;

class TelegramChat
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
            $token = $request->input('token');
            $botChatService = new BotChatService();
            $chat = $botChatService->getByChatId($token);
            if (is_null($chat)) {
                throw new GenericException("Chat {$this->chatId} undefined");
            }
        } catch (GenericException | Exception $e) {
            abort(404);
        }
        return $next($request);
    }
}
