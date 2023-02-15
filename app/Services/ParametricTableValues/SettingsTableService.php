<?php

namespace App\Services\ParametricTableValues;

use App\Http\Controllers\Controller;
use App\Models\ParametricTableValues\SettingsTable;
use App\Repositories\ParametricTableValue\SettingsTable\SettingsTableRepository;
use App\Repositories\ParametricTableValue\SettingsTable\SettingsTableRepositoryInterface;
use App\Services\ParametricTableValueService;

/**
 * Class SettingsTableService
 * @package App\Services\ParametricTableValues\SettingsTableService
 */
class SettingsTableService extends ParametricTableValueService
{
    private $settingsTableRepository;

    /**
     * SettingsTableService constructor.
     * @param SettingsTable $settingsTable
     * @param SettingsTableRepositoryInterface $settingsTableRepository
     */
    public function __construct()
    {
        $this->settingsTableRepository = new SettingsTableRepository();
    }

    /**
     * Entry
     */
    public function handle()
    {
        //
    }

}
