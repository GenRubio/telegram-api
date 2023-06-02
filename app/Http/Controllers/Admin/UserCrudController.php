<?php

namespace App\Http\Controllers\Admin;

use App\Models\OfficePermission;
use App\Http\Requests\UserRequest;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class UserCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('usuario', 'usuarios');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        CRUD::column('name');
        CRUD::column('email');
    }

    public function setupCreateOperation()
    {
        $this->addUserCreateFields();
        $this->crud->setValidation(UserStoreRequest::class);
    }

    public function setupUpdateOperation()
    {
        $this->addUserUpadateFields();
        $this->crud->setValidation(UserUpdateRequest::class);
    }

    private function addUserCreateFields()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'tab' => 'General'
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'email',
                'tab' => 'General'
            ],
            [
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'tab' => 'General'
            ],
            [
                'name' => 'password_confirmation',
                'label' => 'Confirmar Password',
                'type' => 'password',
                'tab' => 'General'
            ],
            [
                'name' => 'custom_permissions',
                'type' => 'custom_html',
                'value' => view('backpack.inputs.office-permissions-create'),
                'tab' => 'Permisos'
            ],
        ]);
    }

    private function addUserUpadateFields()
    {
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'tab' => 'General'
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'email',
                'tab' => 'General'
            ],
            [
                'name' => 'password',
                'label' => 'Password',
                'type' => 'password',
                'tab' => 'General'
            ],
            [
                'name' => 'password_confirmation',
                'label' => 'Confirmar Password',
                'type' => 'password',
                'tab' => 'General'
            ],
            [
                'name' => 'custom_permissions',
                'type' => 'custom_html',
                'value' => view('backpack.inputs.office-permissions-update', ['user' => $this->crud->getCurrentEntry()]),
                'tab' => 'Permisos'
            ],
        ]);
    }

    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput(request()));
        $this->crud->unsetValidation();
        $user = $this->crud->create($this->crud->getRequest()->except(['save_action', '_token', '_method']));
        $user->officePermissions()->sync($this->getPermissionIds(request()->all()));
        Alert::success(trans('backpack::crud.insert_success'))->flash();
        return redirect('admin/user');
    }

    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->setRequest($this->handlePasswordInput(request()));
        $this->crud->unsetValidation();
        $user = $this->crud->update($this->crud->getRequest()->id, $this->crud->getRequest()->except(['save_action', '_token', '_method', 'features']));
        $user->officePermissions()->sync($this->getPermissionIds(request()->all()));
        Alert::success(trans('backpack::crud.insert_success'))->flash();
        return redirect('admin/user');
    }

    private function getPermissionIds($request)
    {
        $permissionsIds = [];
        $allRequest = collect($request);
        $permissions = $allRequest->filter(function ($value, $key) {
            return str_contains($key, 'perm_');
        });
        foreach ($permissions as $key => $value) {
            $params = explode("_", (string)$key);
            $crudName = $params[1];
            $name = $params[2];
            $permissionsIds[] = OfficePermission::where('crud_controller', $crudName)
                ->where('name', $name)
                ->first()
                ->id;
        }
        return $permissionsIds;
    }

    protected function handlePasswordInput($request)
    {
        $request->request->remove('password_confirmation');
        $request->request->remove('roles_show');
        $request->request->remove('permissions_show');

        if ($request->input('password')) {
            $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $request->request->remove('password');
        }

        return $request;
    }
}
