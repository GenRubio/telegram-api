<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SocialNetworksTableRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Str;

class SocialNetworksTableCrudController extends ParametricTableValueCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $parametricTableId;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\ParametricTableValues\SocialNetworksTable::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/social-networks-table');
        CRUD::setEntityNameStrings('red', 'redes sociales');

        $this->parametricTableId = $this->crud->model->getParamatricTableId();
        $this->listFilter();
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'parametric_table_id', $this->parametricTableId)
            ->orderBy('order', 'asc');
    }

    public function store()
    {
        request()->request->set('key', $this->crud->model->parametricTableName . '-' . Str::snake(request()->input('name')));
        return $this->traitStore();
    }
}
