<?php

namespace App\Repositories\Order;

/**
 * Interface OrderRepositoryInterface
 * @package App\Repositories\Order
 */
interface OrderRepositoryInterface
{
    public function getById($id);
    public function getByReference($reference);
    public function createOrder($data);
    public function updateStatus($id, $status);
    public function getByReferenceAndStatus($reference, $status);
    public function getPaymentOrder($reference, $status, $time);
    public function getForAutomaticCancel($status, $time);
    public function updateStripeId($id, $stripeId);
    public function updatePaypalId($id, $paypalId);
}
