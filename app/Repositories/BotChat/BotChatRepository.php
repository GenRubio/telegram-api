<?php

namespace App\Repositories\BotChat;

use App\Models\BotChat;
use App\Repositories\Repository;

/**
 * Class BotChatRepository
 * @package App\Repositories\BotChat
 */
class BotChatRepository extends Repository implements BotChatRepositoryInterface
{
    /**
     * @var int Limit for retrieve data
     */
    protected $limit;

    /**
     * @var int defaultTtl for cache
     */
    protected $defaultTtl;

    /**
     * @var botChat
     */
    protected $model;

    /**
     * BotChatRepository constructor.
     */
    public function __construct()
    {
        $this->model = new BotChat();
        parent::__construct($this->model);
        $this->defaultTtl = env('CACHE_DEFAULT_TTL', 7200);
        $this->limit = 10;
    }

    public function getByChatId($id)
    {
        return $this->model->where('chat_id', $id)->first();
    }

    public function update($chatId, $data)
    {
        $this->model->where('chat_id', $chatId)
            ->update($data);
    }
}
