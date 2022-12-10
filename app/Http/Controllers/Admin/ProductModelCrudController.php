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
        CRUD::setEntityNameStrings('modelo', 'modelos');
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
            'label' => 'Modelo',
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
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
            ],
            [
                'name' => 'name',
                'label' => 'Modelo',
                'type' => 'text',
            ],
            [
                'name' => 'size',
                'label' => 'Medida',
                'type' => 'text',
                'suffix' => 'mm',
            ],
            [
                'name' => 'power_range',
                'label' => 'Rango de poder',
                'type' => 'text',
                'suffix' => 'W',
            ],
            [
                'name' => 'input_voltage',
                'label' => 'Voltaje de entrada',
                'type' => 'text',
                'suffix' => 'V',
            ],
            [
                'name' => 'battery_capacity',
                'label' => 'Capacidad de la batería',
                'type' => 'text',
                'suffix' => 'mAh',
            ],
            [
                'name' => 'e_liquid_capacity',
                'label' => 'Capacidad E Liquid',
                'type' => 'text',
                'suffix' => 'ml',
            ],
            [
                'name' => 'concentration',
                'label' => 'Concentración nicotina',
                'type' => 'text',
                'suffix' => 'mg/ml',
            ],
            [
                'name' => 'resistance',
                'label' => 'Resistencia',
                'type' => 'text',
                'suffix' => 'Ω',
            ],
            [
                'name' => 'absorbable_quantity',
                'label' => 'Cantidad de caladas',
                'type' => 'text',
                'suffix' => 'Puffs',
            ],
            [
                'name' => 'charging_port',
                'label' => 'Tipo de puerto de carga',
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
