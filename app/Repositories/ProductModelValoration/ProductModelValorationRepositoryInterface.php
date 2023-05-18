<?php

namespace App\Repositories\ProductModelValoration;

/**
 * Interface ProductModelValorationRepositoryInterface
 * @package App\Repositories\ProductModelValoration
 */
interface ProductModelValorationRepositoryInterface
{
    public function create($data);
    public function getChatValoration($id, $chatId);
}
