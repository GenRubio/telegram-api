<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingsTableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

class SettingsTableCrudController extends ParametricTableValueCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation{
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ParametricTableValues\SettingsTable::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/settings-table');
        CRUD::setEntityNameStrings('configuración', 'configuraciónes');
    }

    public function store()
    {
        request()->request->set('key', $this->crud->model->parametricTableName . '-' .Str::snake(request()->input('name')));
        return $this->traitStore();
    }
}
