<?php

namespace App\Repositories\Setting;

/**
 * Interface SettingRepositoryInterface
 * @package App\Repositories\Setting
 */
interface SettingRepositoryInterface
{
    public function getByKey($key);
}
