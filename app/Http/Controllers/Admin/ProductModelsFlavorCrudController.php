<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductModel;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ProductModelsFlavorRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductModelsFlavorCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $productModelId;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        $this->productModelId = Route::current()->parameter('product_model_id');
        CRUD::setModel(\App\Models\ProductModelsFlavor::class);
        CRUD::setRoute("admin/product-model/" . $this->productModelId . '/product-models-flavor');
        CRUD::setEntityNameStrings('sabor', 'sabores');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Productos' => backpack_url('product-model'),
            'Sabores' => backpack_url("product-model/" . $this->productModelId . "/product-models-flavor"),
            trans('backpack::crud.list') => false,
        ];
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'product_model_id', $this->productModelId);
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'id',
            'label' => 'ID',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => 'Activo',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Sabor',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'productModel',
            'label' => 'Modelo',
            'type'      => 'select',
            'name'      => 'product_model_id',
            'entity'    => 'productModel',
            'attribute' => 'name',
            'model'     => "App\Models\ProductModel",
        ]);
        $this->crud->addColumn([
            'name' => 'stock',
            'label' => 'Stock',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'stock_bloqued',
            'label' => 'Stock bloqueado',
            'type'  => 'text',
        ]);
    }

    protected function setFields()
    {
        $this->crud->addFields([
            [
                'name' => 'reference',
                'type' => 'hidden',
            ],
            [
                'name' => 'product_model_id',
                'value' => $this->productModelId,
                'type' => 'hidden',
            ],
            [
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'image-v2',
            ],
            [
                'name' => 'name',
                'label' => 'Sabor',
                'type' => 'text',
            ],
            [
                'name' => 'stock',
                'label' => 'Stock',
                'type' => 'number',
                'default' => 0
            ],
            [
                'name' => 'stock_bloqued',
                'label' => 'Stock bloqueado',
                'type' => 'text',
                'default' => 0
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Activo',
                'default' => true,
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductModelsFlavorRequest::class);
        $this->setFields();
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(ProductModelsFlavorRequest::class);
        $this->setFields();
    }

    public function update()
    {
        $this->crud->setRequest($this->handleNameInput($this->crud->getRequest()));
        $this->crud->unsetValidation();
        return $this->traitUpdate();
    }

    protected function handleNameInput($request)
    {
        if ($this->crud->getCurrentEntry()->name == $request->input('name')) {
            $request->request->remove('name');
        }
        return $request;
    }
}
