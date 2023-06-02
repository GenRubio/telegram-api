<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Requests\ProductModelValorationRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductModelValorationCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $productModelId;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\ProductModelValoration::class);
        $this->productModelId = Route::current()->parameter('product_model_id');
        CRUD::setRoute("admin/product-model/" . $this->productModelId . '/product-model-valoration');
        CRUD::setEntityNameStrings('valoracion', 'valoraciones');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Productos' => backpack_url('product-model'),
            'Valoraciones' => backpack_url("product-model/" . $this->productModelId . "/product-model-valoration"),
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
            'name' => 'productModel',
            'label' => 'Modelo',
            'type'      => 'select',
            'name'      => 'product_model_id',
            'entity'    => 'productModel',
            'attribute' => 'name',
            'model'     => "App\Models\ProductModel",
        ]);
        $this->crud->addColumn([
            'name' => 'stars',
            'label' => 'Estrellas',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'likes',
            'label' => 'Likes',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'dislikes',
            'label' => 'DisLikes',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'visible',
            'type' => 'btnToggleV2',
            'label' => 'Visible',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductModelValorationRequest::class);

        $this->crud->addFields([
            [
                'name' => 'product_model_id',
                'value' => $this->productModelId,
                'type' => 'hidden',
            ],
            [
                'name' => 'comment',
                'label' => 'Comentario',
                'type' => 'textarea',
            ],
            [
                'name' => 'stars',
                'label' => 'Estrellas',
                'type' => 'number',
                'default' => 5
            ],
            [
                'name' => 'likes',
                'label' => 'Likes',
                'type' => 'number',
                'default' => 0
            ],
            [
                'name' => 'dislikes',
                'label' => 'DisLikes',
                'type' => 'number',
                'default' => 0
            ],
            [
                'name' => 'visible',
                'type' => 'checkbox',
                'label' => 'Visible',
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
