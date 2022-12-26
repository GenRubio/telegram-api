<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatusEnum;
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
        $this->crud->addButtonFromView('line', 'order-products', 'order-products', 'beginning');
        $this->crud->addColumn([
            'name' => 'created_at',
            'label' => 'Fecha',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Estado',
            'type'  => 'status',
        ]);
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
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
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderRequest::class);
        $this->crud->addFields([
            [
                'name' => 'reference',
                'label' => 'Numero referencia',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'tab' => 'General'
            ],
            [
                'name'        => 'status',
                'label'       => "Estado",
                'type'        => 'select_from_array',
                'options'     => $this->getListStatuses(),
                'allows_null' => false,
                'tab' => 'General'
            ],
            [
                'name' => 'price',
                'label' => 'Precio',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'tab' => 'General'
            ],
            [
                'name' => 'shipping_price',
                'label' => 'Precio envio',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'tab' => 'General'
            ],
            [
                'name' => 'total_price',
                'label' => 'Precio total',
                'type' => 'text',
                'prefix' => '€',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'tab' => 'General'
            ],
            [
                'name' => 'payment_method',
                'label' => 'Metodo de pago',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                  ],
                'tab' => 'General'
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'surnames',
                'label' => 'Apellidos',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'address',
                'label' => 'Direccion',
                'type' => 'textarea',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'postal_code',
                'label' => 'Codigo postal',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'city',
                'label' => 'Ciudad',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
            [
                'name' => 'country',
                'label' => 'Pais',
                'type' => 'text',
                'tab' => 'Cliente'
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    private function getListStatuses(){
        $actualStatus = $this->crud->getCurrentEntry()->status;
        return [
            $actualStatus => OrderStatusEnum::STATUS[$actualStatus],
            'cancel' => 'Cancelado',
            'sent' => 'Enviado',
            'delivered' => 'Entregado'
        ];
    }
}
