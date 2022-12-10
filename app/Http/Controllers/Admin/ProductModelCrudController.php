<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductModelRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductModelCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\ProductModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-model');
        CRUD::setEntityNameStrings('producto', 'productos');
    }

    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'model-flavors', 'model-flavors', 'beginning');
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Modelo',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price',
            'label' => 'Precio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'discount',
            'label' => 'Descuento',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggle',
            'label' => 'Activo',
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
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
                'tab' => 'Producto'
            ],
            [
                'name' => 'name',
                'label' => 'Modelo',
                'type' => 'text',
                'tab' => 'Producto'
            ],
            [
                'name' => 'price',
                'label' => 'Precio',
                'type' => 'number',
                'prefix' => '€',
                'decimals' => 2,
                'default' => 10,
                'tab' => 'Producto'
            ],
            [
                'name' => 'discount',
                'label' => 'Descuento',
                'type' => 'number',
                'prefix'  => '%',
                'default' => 0,
                'tab' => 'Producto'
            ],
            [
                'name' => 'size',
                'label' => 'Medida',
                'type' => 'text',
                'suffix' => 'mm',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'power_range',
                'label' => 'Rango de poder',
                'type' => 'text',
                'suffix' => 'W',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'input_voltage',
                'label' => 'Voltaje de entrada',
                'type' => 'text',
                'suffix' => 'V',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'battery_capacity',
                'label' => 'Capacidad de la batería',
                'type' => 'text',
                'suffix' => 'mAh',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'e_liquid_capacity',
                'label' => 'Capacidad E Liquid',
                'type' => 'text',
                'suffix' => 'ml',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'concentration',
                'label' => 'Concentración nicotina',
                'type' => 'text',
                'suffix' => 'mg/ml',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'resistance',
                'label' => 'Resistencia',
                'type' => 'text',
                'suffix' => 'Ω',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'absorbable_quantity',
                'label' => 'Cantidad de caladas',
                'type' => 'text',
                'suffix' => 'Puffs',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'charging_port',
                'label' => 'Tipo de puerto de carga',
                'type' => 'text',
                'tab' => 'Detalle'
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Activo',
                'default' => true,
                'tab' => 'Producto'
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductModelRequest::class);
        $this->setFields();
    }

    protected function setupUpdateOperation()
    {
        $this->crud->setRequest($this->handleNameInput(request()));
        $this->setFields();
    }

    protected function handleNameInput($request)
    {
        if ($this->crud->getCurrentEntry()->name == $request->input('name')) {
            $request->request->remove('name');
        }
        return $request;
    }
}
