<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ParametricTableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ParametricTableCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ParametricTable::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/parametric-table');
        CRUD::setEntityNameStrings('tabla', 'tablas parametricas');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'comment',
            'label' => 'Comentario',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'resource',
            'type' => 'btnToggleV2',
            'label' => 'Resource',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ParametricTableRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nomber',
                'type' => 'text',
                'tab' => 'Tabla'
            ],
            [
                'name' => 'comment',
                'label' => 'Comentario',
                'type' => 'text',
                'tab' => 'Tabla'
            ],
            [
                'name' => 'resource',
                'type' => 'checkbox',
                'label' => 'Resource',
                'default' => true,
                'tab' => 'Tabla'
            ],
            [
                'name' => 'create_model_table_values',
                'label' => 'Crear objeto',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
            [
                'name' => 'create_backpack_table_values',
                'label' => 'Crear Backpack (CRUD)',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
            [
                'name' => 'create_service_table_values',
                'label' => 'Crear service',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
            [
                'name' => 'create_repository_table_values',
                'label' => 'Crear repository',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
            [
                'name' => 'create_resource_table_values',
                'label' => 'Crear resource',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(ParametricTableRequest::class);

        CRUD::field('name');
        CRUD::field('comment');
        CRUD::field('resource');
    }
}
