<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OfficePermissionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

class OfficePermissionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\OfficePermission::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/office-permission');
        CRUD::setEntityNameStrings('permiso', 'permisos');
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        $this->crud->removeButton('update');
        $this->crud->removeButton('delete');
        $this->crud->addColumn([
            'name' => 'crud_controller',
            'label' => 'CRUD',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OfficePermissionRequest::class);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
