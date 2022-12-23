<?php

namespace App\Repositories\Order;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories\Order
 */
interface OrderRepositoryInterface
{
    public function getByReference($reference);
}
