<?php

namespace App\Repositories\Customer;

/**
 * Interface CustomerRepositoryInterface
 * @package App\Repositories\Customer
 */
interface CustomerRepositoryInterface
{
    public function getByChat($chatId);
}
