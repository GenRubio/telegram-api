<?php

namespace App\Tasks\Bot\Chat;

use App\Services\BotChatService;
use App\Services\AffiliateService;

class SetReferenceChatTask
{
    private $reference;
    private $botChatService;
    private $botChat;
    private $affiliateService;

    public function __construct($botChat, $reference)
    {
        $this->botChat = $botChat;
        $this->reference = $reference;
        $this->botChatService = new BotChatService();
        $this->affiliateService = new AffiliateService();
    }

    public function run()
    {
        if (!is_null($this->reference) && is_null($this->botChat->reference)) {
            $affiliate = $this->affiliateService->getByReference($this->reference);
            if (!is_null($affiliate)) {
                $this->botChatService->update($this->botChat->id, [
                    'reference' => $this->reference
                ]);
            }
        }
    }
}
