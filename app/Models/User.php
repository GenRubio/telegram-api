<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Services\OfficePermissionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function officePermission($crud, $method)
    {
        $crud = str_replace("App\Http\Controllers\Admin\\", "", $crud);
        $officePermissionService = new OfficePermissionService();
        $permission = $officePermissionService->getByCrudAndMethod($crud, $method);
        if (is_null($permission)) {
            return false;
        }
        $hasPermission = $this->officePermissions
            ->where('id', $permission->id)
            ->first();
        return $hasPermission ? true : false;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function officePermissions()
    {
        return $this->belongsToMany(OfficePermission::class, 'user_office_permissions', 'user_id', 'office_permission_id');
    }
}
