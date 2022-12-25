<?php

namespace App\Repositories\Order;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories\Order
 */
interface OrderRepositoryInterface
{
    public function getByReference($reference);
    public function createOrder($data);
    public function updateStatus($id, $status);
    public function getByReferenceAndStatus($reference, $status);
}
