<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\ParametricTable;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ParametricTableValueRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ParametricTableValueCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $parametricTableId;
    protected $parametricTable;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\ParametricTableValue::class);
        $this->parametricTableId = Route::current()->parameter('parametric_table_id');
        CRUD::setRoute('admin/parametric-table/' . $this->parametricTableId . '/parametric-table-value');
        CRUD::setEntityNameStrings('valor', 'Valores de tabla parametrica');
        $this->parametricTable = ParametricTable::find($this->parametricTableId);
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Tablas Parametricas' => backpack_url('parametric-table'),
            'Valores' => backpack_url("parametric-table/" . $this->parametricTableId . "/parametric-table-value"),
            trans('backpack::crud.list') => false,
        ];
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'parametric_table_id', $this->parametricTableId)
            ->orderBy('order', 'asc');
    }


    protected function setupListOperation()
    {
        $this->removeActionsCrud();
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
            'name' => 'order',
            'label' => 'Prioridad',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'parameter',
            'label' => 'Parametro',
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
                'value' => $this->parametricTableId
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
                'type' => 'textarea',
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
        CRUD::setValidation(ParametricTableValueRequest::class);

        $this->crud->addFields([
            [
                'name' => 'key',
                'label' => 'Key',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
            ],
            [
                'name' => 'description',
                'label' => 'Descripcion',
                'type' => 'textarea',
            ],
            [
                'name' => 'parameter',
                'label' => 'Parametro',
                'type' => 'textarea',
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

    public function store()
    {
        request()->request->set('key', $this->parametricTable->name . '-' . Str::snake(request()->input('name')));
        return $this->traitStore();
    }
}
