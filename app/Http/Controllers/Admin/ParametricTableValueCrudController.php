<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ParametricTableValueRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

class ParametricTableValueCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ParametricTableValue::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/parametric-table-value');
        CRUD::setEntityNameStrings('parametric table value', 'parametric table values');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'parametricTable',
            'label' => 'Tabla',
            'type'      => 'select',
            'name'      => 'parametric_table_id',
            'entity'    => 'parametricTable',
            'attribute' => 'name',
            'model'     => "App\Models\ParametricTable",
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Descripcion',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'parameter',
            'label' => 'Parametro',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'order',
            'label' => 'Prioridad',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'resource',
            'type' => 'btnToggleV2',
            'label' => 'Resource',
        ]);
        $this->crud->addColumn([
            'name' => 'filter',
            'type' => 'btnToggleV2',
            'label' => 'Filtro',
        ]);
        $this->crud->addColumn([
            'name' => 'visible',
            'type' => 'btnToggleV2',
            'label' => 'Visible',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => 'Active',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ParametricTableValueRequest::class);

        $this->crud->addFields([
            [
                'name' => 'parametric_table_id',
                'type' => 'hidden',
            ],
            [
                'name' => 'key',
                'type' => 'hidden',
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Descripcion',
                'type' => 'textarea',
            ],
            [
                'name' => 'parameter',
                'label' => 'Parametro',
                'type' => 'text',
            ],
            [
                'name' => 'order',
                'label' => 'Prioridad',
                'type' => 'number',
                'default' => 1
            ],
            [
                'name' => 'resource',
                'type' => 'checkbox',
                'label' => 'Resource',
                'default' => true,
            ],
            [
                'name' => 'filter',
                'type' => 'checkbox',
                'label' => 'Filter',
                'default' => true,
            ],
            [
                'name' => 'visible',
                'type' => 'checkbox',
                'label' => 'Visible',
                'default' => true,
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Active',
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        request()->request->set('key', $this->crud->model->parametricTableName . '-' . Str::snake(request()->input('name')));
        return $this->traitStore();
    }
}
