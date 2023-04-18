<?php

namespace App\Tasks\Bot\Chat;

use App\Services\AffiliateService;
use App\Services\TelegraphChatService;

class SetReferenceChatTask
{
    private $reference;
    private $telegraphChatService;
    private $telegraphChat;
    private $affiliateService;

    public function __construct($telegraphChat, $reference)
    {
        $this->telegraphChat = (new TelegraphChatService())->getByChatId($telegraphChat->chat_id);
        $this->reference = $reference;
        $this->telegraphChatService = new TelegraphChatService();
        $this->affiliateService = new AffiliateService();
    }

    public function run()
    {
        if (!is_null($this->reference) && empty($this->telegraphChat->reference)) {
            $affiliate = $this->affiliateService->getByReference($this->reference);
            if (!is_null($affiliate)) {
                $this->telegraphChatService->update($this->telegraphChat->chat_id, [
                    'reference' => $this->reference
                ]);
            }
        }
    }
}
