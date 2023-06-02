<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Str;
use Prologue\Alerts\Facades\Alert;
use App\Exceptions\GenericException;
use App\Http\Requests\ParametricTableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Tasks\ParametricTables\CreateParamTableValueTask;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ParametricTableCrudController extends CrudController
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
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\ParametricTable::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/parametric-table');
        CRUD::setEntityNameStrings('tabla', 'tablas parametricas');
    }

    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'parametric-table-values', 'parametric-table-values', 'beginning');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'comment',
            'label' => 'Comentario',
            'type'  => 'textarea',
        ]);
        $this->crud->addColumn([
            'name' => 'count_values',
            'label' => 'Valores',
            'type'  => 'number',
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
                'type' => 'textarea',
                'tab' => 'Tabla'
            ],
            [
                'name' => 'resource',
                'type' => 'checkbox',
                'label' => 'Resource',
                'default' => true,
                'tab' => 'Tabla'
            ],
        ]);
        if (config('app.locale') === 'local') {
            $this->crud->addFields([
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
                    'default' => false,
                    'tab' => 'Configuración (Valores)'
                ],
                [
                    'name' => 'create_hexagonal_table_values',
                    'label' => 'Crear estructura hexagonal',
                    'type' => 'checkbox',
                    'default' => true,
                    'tab' => 'Configuración (Valores)'
                ],
            ]);
        } else {
            $this->crud->addFields([
                [
                    'name' => 'create_model_table_values',
                    'type' => 'hidden',
                    'value' => false,
                ],
                [
                    'name' => 'create_backpack_table_values',
                    'type' => 'hidden',
                    'value' => false,
                ],
                [
                    'name' => 'create_hexagonal_table_values',
                    'type' => 'hidden',
                    'value' => false,
                ],
            ]);
        }
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(ParametricTableRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nomber',
                'type' => 'text',
            ],
            [
                'name' => 'comment',
                'label' => 'Comentario',
                'type' => 'text',
            ],
            [
                'name' => 'resource',
                'type' => 'checkbox',
                'label' => 'Resource',
                'default' => true,
            ],
        ]);
    }

    public function store()
    {
        request()->request->set('name', Str::snake(request()->input('name')));
        $tableName = request()->input('name');
        $createModel = request()->input('create_model_table_values');
        $createBackpackCrud  = request()->input('create_backpack_table_values');
        $createHexagonalStructure  = request()->input('create_hexagonal_table_values');
        try {
            (new CreateParamTableValueTask($tableName, $createModel, $createBackpackCrud, $createHexagonalStructure))->run();
            return $this->traitStore();
        } catch (GenericException | Exception $e) {
            dd($e);
            Alert::add('error', $e->getMessage())->flash();
            return back();
        }
    }
}
