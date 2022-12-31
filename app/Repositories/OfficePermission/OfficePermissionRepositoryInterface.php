<?php

namespace App\Repositories\OfficePermission;

/**
 * Interface OfficePermissionRepositoryInterface
 * @package App\Repositories\OfficePermission
 */
interface OfficePermissionRepositoryInterface
{
    public function getByCrudAndMethod($crud, $name);
}
