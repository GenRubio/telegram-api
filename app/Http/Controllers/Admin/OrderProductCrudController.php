<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Route;

class OrderProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $orderId;

    public function setup()
    {
        CRUD::setModel(\App\Models\OrderProduct::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order-product');
        CRUD::setEntityNameStrings('order product', 'order products');

        $this->orderId = Route::current()->parameter('order_id');
        $this->crud->setRoute("admin/order/" . $this->orderId . '/order-product');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Pedidos' => backpack_url('order'),
            'Productos' => backpack_url("order/" . $this->orderId . "/order-product"),
            trans('backpack::crud.list') => false,
        ];
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'order_id', $this->orderId);
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        $this->crud->removeButton('delete');
        $this->crud->removeButton('update');
        $this->crud->addColumn([
            'name' => 'order_reference',
            'label' => 'Referencia pedido',
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
            'name' => 'productModelsFlavor',
            'label' => 'Sabor',
            'type'      => 'select',
            'name'      => 'product_models_flavor_id',
            'entity'    => 'productModelsFlavor',
            'attribute' => 'name',
            'model'     => "App\Models\ProductModelsFlavor",
        ]);
        $this->crud->addColumn([
            'name' => 'total_price',
            'label' => 'Precio total',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'unit_price',
            'label' => 'Precio unidad',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'amount',
            'label' => 'Cantidad',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderProductRequest::class);

        CRUD::field('order_id');
        CRUD::field('product_model_id');
        CRUD::field('product_models_flavor_id');
        CRUD::field('amount');
        CRUD::field('unit_price');
        CRUD::field('total_price');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
