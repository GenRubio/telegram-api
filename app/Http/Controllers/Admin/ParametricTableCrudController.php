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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation{
        store as traitStore;
    }
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
            'type'  => 'textarea',
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
                'name' => 'create_hexagonal_table_values',
                'label' => 'Crear estructura hexagonal',
                'type' => 'checkbox',
                'default' => true,
                'tab' => 'Configuración (Valores)'
            ],
        ]);
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
        try{
            (new CreateParamTableValueTask($tableName, $createModel, $createBackpackCrud, $createHexagonalStructure))->run();
            return $this->traitStore();
        }
        catch(GenericException | Exception $e){
            dd($e);
            Alert::add('error', $e->getMessage())->flash();
            return back();
        }
    }
}
