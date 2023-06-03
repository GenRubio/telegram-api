<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductModel;
use Illuminate\Http\Request;
use App\Http\Requests\ProductModelRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

class ProductModelCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\ProductModel::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product-model');
        CRUD::setEntityNameStrings('producto', 'productos');
        $this->listFilter();
    }

    protected function listFilter()
    {
        $this->crud->orderBy('order', 'asc');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'product-actions', 'product-actions', 'beginning');
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => trans('back-office.backpack_menu.products.list.reference'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => trans('back-office.backpack_menu.products.list.active'),
        ]);
        $this->crud->addColumn([
            'name' => 'order',
            'label' => trans('back-office.backpack_menu.products.list.priority'),
            'type'  => 'order',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => trans('back-office.backpack_menu.products.list.image'),
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans('back-office.backpack_menu.products.list.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_price_backpack',
            'label' => trans('back-office.backpack_menu.products.list.total_price'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'price_backpack',
            'label' => trans('back-office.backpack_menu.products.list.price'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'discount_backpack',
            'label' => trans('back-office.backpack_menu.products.list.discount'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'label' => trans('back-office.backpack_menu.products.list.brand'),
            'type'  => 'text',
            'name'  => 'product_brand_name',
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
                'label' => trans('back-office.backpack_menu.products.update.product.image'),
                'type' => 'image-v2',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.products.update.product.name'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'label'     => trans('back-office.backpack_menu.products.update.product.brand'),
                'type'      => 'select',
                'name'      => 'brand_id',
                'entity'    => 'productBrand',
                'model'     => "App\Models\Brand",
                'attribute' => 'name',
                'options'   => (function ($query) {
                    return $query->active()->get();
                }),
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'price',
                'label' => trans('back-office.backpack_menu.products.update.product.price'),
                'type' => 'number',
                'prefix' => '€',
                'decimals' => 2,
                'default' => 10,
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'discount',
                'label' => trans('back-office.backpack_menu.products.update.product.discount'),
                'type' => 'number',
                'prefix'  => '%',
                'default' => 0,
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'description',
                'label' => trans('back-office.backpack_menu.products.update.product.description'),
                'type'  => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['font', ['bold', 'underline', 'italic']]
                    ],
                    'minheight' => 300,
                    'height' => 300
                ],
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'size',
                'label' => trans('back-office.backpack_menu.products.update.datail.size'),
                'type' => 'text',
                'suffix' => 'mm',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'power_range',
                'label' => trans('back-office.backpack_menu.products.update.datail.power_range'),
                'type' => 'text',
                'suffix' => 'W',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'input_voltage',
                'label' => trans('back-office.backpack_menu.products.update.datail.input_voltage'),
                'type' => 'text',
                'suffix' => 'V',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'battery_capacity',
                'label' => trans('back-office.backpack_menu.products.update.datail.battery_capacity'),
                'type' => 'text',
                'suffix' => 'mAh',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'e_liquid_capacity',
                'label' => trans('back-office.backpack_menu.products.update.datail.e_liquid_capacity'),
                'type' => 'text',
                'suffix' => 'ml',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'concentration',
                'label' => trans('back-office.backpack_menu.products.update.datail.concentration'),
                'type' => 'text',
                'suffix' => 'mg/ml',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'resistance',
                'label' => trans('back-office.backpack_menu.products.update.datail.resistance'),
                'type' => 'text',
                'suffix' => 'Ω',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'absorbable_quantity',
                'label' => trans('back-office.backpack_menu.products.update.datail.absorbable_quantity'),
                'type' => 'text',
                'suffix' => 'Puffs',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'charging_port',
                'label' => trans('back-office.backpack_menu.products.update.datail.charging_port'),
                'type' => 'text',
                'tab' => trans('back-office.backpack_menu.products.update.tabs.detail')
            ],
            [
                'name' => 'order',
                'label' => trans('back-office.backpack_menu.products.update.product.priority'),
                'type' => 'number',
                'default' => 1,
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'multiple_flavors',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.products.update.product.contains_multiple_flavors'),
                'default' => true,
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.products.update.product.active'),
                'default' => true,
                'tab' => trans('back-office.backpack_menu.products.update.tabs.product')
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

    public function duplicate(Request $request)
    {
        $product = ProductModel::find($request->product_model_id);
        $newProduct = $product->replicate();
        $newProduct->name = $newProduct->name . ' (' . trans('back-office.backpack_menu.products.update.extra.copy') . ')';
        $newProduct->active = false;
        $newProduct->reference = null;
        $newProduct->save();

        $flavors = $product->productModelsFlavorsAll;
        foreach ($flavors as $flavor) {
            $newFlavor = $flavor->replicate();
            $newFlavor->product_model_id = $newProduct->id;
            $newFlavor->reference = null;
            $newFlavor->save();
        }

        $images = $product->galleryImagesAll;
        foreach ($images as $image) {
            $newImage = $image->replicate();
            $newImage->product_model_id = $newProduct->id;
            $newImage->save();
        }

        Alert::add('success', trans('back-office.backpack_menu.products.update.success.duplicate'))->flash();
        return redirect()->back();
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

    public function store()
    {
        return $this->traitStore();
    }
}
