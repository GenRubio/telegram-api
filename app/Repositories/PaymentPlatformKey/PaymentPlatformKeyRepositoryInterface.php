<?php

namespace App\Repositories\PaymentPlatformKey;

/**
 * Interface PaymentPlatformKeyRepositoryInterface
 * @package App\Repositories\PaymentPlatformKey
 */
interface PaymentPlatformKeyRepositoryInterface
{
    public function getAll();
    public function getAllByType($type);
    public function getById($id);
}
