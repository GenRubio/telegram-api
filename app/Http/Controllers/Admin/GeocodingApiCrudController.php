<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GeocodingApiRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class GeocodingApiCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\GeocodingApi::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/geocoding-api');
        CRUD::setEntityNameStrings('key', 'Geocoding API Keys');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'api_key',
            'label' => 'KEY',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'requests',
            'label' => 'Peticiones (hoy)',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_requests',
            'label' => 'Peticiones (totales)',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(GeocodingApiRequest::class);

        $this->crud->addFields([
            [
                'name' => 'api_key',
                'label' => 'API Key',
                'type' => 'text',
            ],
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
