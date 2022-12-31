<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\OfficePermission;
use App\Repositories\OfficePermission\OfficePermissionRepository;
use App\Repositories\OfficePermission\OfficePermissionRepositoryInterface;

/**
 * Class OfficePermissionService
 * @package App\Services\OfficePermission
 */
class OfficePermissionService extends Controller
{
    private $officepermissionRepository;

    /**
     * OfficePermissionService constructor.
     * @param OfficePermission $officepermission
     * @param OfficePermissionRepositoryInterface $officepermissionRepository
     */
    public function __construct()
    {
        $this->officepermissionRepository = new OfficePermissionRepository();
    }

    public function getByCrudAndMethod($crud, $name)
    {
        return $this->officepermissionRepository->getByCrudAndMethod($crud, $name);
    }
}
