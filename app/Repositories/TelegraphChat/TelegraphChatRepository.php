<?php

namespace App\Repositories\TelegraphChat;

use App\Models\TelegraphChat;
use App\Repositories\Repository;

/**
 * Class TelegraphChatRepository
 * @package App\Repositories\TelegraphChat
 */
class TelegraphChatRepository extends Repository implements TelegraphChatRepositoryInterface
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
     * @var TelegraphChat
     */
    protected $model;

    /**
     * TelegraphChatRepository constructor.
     */
    public function __construct()
    {
        $this->model = new TelegraphChat();
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
