<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TranslationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TranslationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Translation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/translation');
        CRUD::setEntityNameStrings('texto', 'traducciones');
    }

    protected function setupListOperation()
    {
        CRUD::column('uuid');
        CRUD::column('text');
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);

        CRUD::field('uuid');
        CRUD::field('text');
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
