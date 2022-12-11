<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('pedido', 'pedidos');
    }

    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'surnames',
            'label' => 'Apellidos',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_price',
            'label' => 'Precio total',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price',
            'label' => 'Precio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'shipping_price',
            'label' => 'Precio envio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Estado',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderRequest::class);

        CRUD::field('chat_id');
        CRUD::field('reference');
        CRUD::field('name');
        CRUD::field('surnames');
        CRUD::field('address');
        CRUD::field('postal_code');
        CRUD::field('city');
        CRUD::field('country');
        CRUD::field('payment_method');
        CRUD::field('status');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
