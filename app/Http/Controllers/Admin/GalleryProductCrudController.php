<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Requests\GalleryProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class GalleryProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation{
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $productModelId;

    public function setup()
    {
        CRUD::setModel(\App\Models\GalleryProduct::class);
        $this->productModelId = Route::current()->parameter('product_model_id');
        CRUD::setRoute("admin/product-model/" . $this->productModelId . '/gallery-product');
        CRUD::setEntityNameStrings('imagen', 'imagenes');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Productos' => backpack_url('product-model'),
            'Imagenes' => backpack_url("product-model/" . $this->productModelId . "/gallery-product"),
            trans('backpack::crud.list') => false,
        ];
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'product_model_id', $this->productModelId)
            ->orderBy('order', 'asc');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
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
            'name' => 'order',
            'label' => 'Prioridad',
            'type'  => 'order',
        ]);
        $this->crud->addColumn([
            'name' => 'visible',
            'type' => 'btnToggleV2',
            'label' => 'Visible',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => 'Activo',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(GalleryProductRequest::class);

        $this->crud->addFields([
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
                'name' => 'title',
                'label' => 'Titulo',
                'type' => 'text',
            ],
            [
                'name' => 'alt',
                'label' => 'ALT',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Decripcion',
                'type' => 'textarea',
            ],
            [
                'name' => 'order',
                'label' => 'Prioridad',
                'type' => 'number',
                'default' => 1
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
                'label' => 'Activo',
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function update()
    {
        if (is_null($this->crud->getRequest()->image)){
            $this->crud->unsetValidation('image');
        }
        return $this->traitUpdate();
    }
}
