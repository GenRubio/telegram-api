<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ApiClientRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ApiClientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ApiClient::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/api-client');
        CRUD::setEntityNameStrings('cliente', 'api clientes');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'url',
            'label' => 'Url',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'online',
            'label' => 'Online',
            'type'  => 'check',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggle',
            'label' => 'Activo',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ApiClientRequest::class);
        $this->crud->addFields([
            [
                'name' => 'url',
                'label' => 'Url',
                'type' => 'text',
            ],
            [
                'name' => 'ip',
                'label' => 'IP',
                'type' => 'text',
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Activo',
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
