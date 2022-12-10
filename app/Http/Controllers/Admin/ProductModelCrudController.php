<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductModelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductModelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ProductModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-model');
        CRUD::setEntityNameStrings('modelo', 'modelos');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Modelo',
            'type'  => 'text',
        ]);

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductModelRequest::class);

        $this->crud->addFields([
            [
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
            ],
            [
                'name' => 'name',
                'label' => 'Modelo',
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
