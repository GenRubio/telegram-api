<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductModelRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductModelCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (!backpack_user()->officePermission(get_class($this), 'show')) {
            abort(403);
        }
        CRUD::setModel(\App\Models\ProductModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-model');
        CRUD::setEntityNameStrings('producto', 'productos');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
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
            'name' => 'total_price_backpack',
            'label' => 'Precio total',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price_backpack',
            'label' => 'Precio',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'discount_backpack',
            'label' => 'Descuento',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'label' => 'Marca',
            'type'  => 'text',
            'name'  => 'product_brand_name',
        ]);
        $this->crud->addColumn([
            'name' => 'product_models_flavors_count',
            'label' => 'Sabores',
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
                'label'     => "Marca",
                'type'      => 'select',
                'name'      => 'brand_id',
                'entity'    => 'productBrand',
                'model'     => "App\Models\Brand",
                'attribute' => 'name',
                'options'   => (function ($query) {
                    return $query->active()->get();
                }),
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
        $this->setFields();
        CRUD::setValidation(ProductModelRequest::class);
    }

    protected function setupUpdateOperation()
    {
        $this->setFields();
        CRUD::setValidation(ProductModelRequest::class);
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
