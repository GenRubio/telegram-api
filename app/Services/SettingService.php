<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryInterface;

/**
 * Class SettingService
 * @package App\Services\Setting
 */
class SettingService extends Controller
{
    private $settingRepository;

    /**
     * SettingService constructor.
     * @param Setting $setting
     * @param SettingRepositoryInterface $settingRepository
     */
    public function __construct()
    {
        $this->settingRepository = new SettingRepository();
    }

    public function getAll()
    {
        return $this->settingRepository->getAll();
    }

    public function getByKey($key)
    {
        return $this->settingRepository->getByKey($key);
    }
}
