<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductModelsFlavorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

class ProductModelsFlavorCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $productModelId;

    public function setup()
    {
        CRUD::setModel(\App\Models\ProductModelsFlavor::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-models-flavor');
        CRUD::setEntityNameStrings('sabor', 'sabores');

        $this->productModelId = Route::current()->parameter('product_model_id');
        $this->crud->setRoute("admin/product-model/". $this->productModelId . '/product-models-flavor');
        $this->breadCrumbs();
    }

    protected function breadCrumbs(){
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Modelos' => backpack_url('product-model'),
            'Sabores' => backpack_url("product-model/" . $this->productModelId . "/product-models-flavor"),
            trans('backpack::crud.list') => false,
        ];
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
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggle',
            'label' => 'Activo',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductModelsFlavorRequest::class);

        $this->crud->addFields([
            [
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
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
