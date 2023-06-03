<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BrandCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Brand::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/brand');
        CRUD::setEntityNameStrings('marca', 'marcas');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans('back-office.backpack_menu.brands.list.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'count_products',
            'label' => trans('back-office.backpack_menu.brands.list.products'),
            'type'  => 'number',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => trans('back-office.backpack_menu.brands.list.active'),
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BrandRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.brands.update.name'),
                'type' => 'text',
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.brands.update.active'),
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
