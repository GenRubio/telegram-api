<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PaymentMethodsEnum;
use App\Http\Requests\PaymentPlatformKeyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class PaymentPlatformKeyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\PaymentPlatformKey::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/payment-platform-key');
        CRUD::setEntityNameStrings('llave', 'P.P. Llaves');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Tipo',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Description',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => 'Activo',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(PaymentPlatformKeyRequest::class);

        $this->crud->addFields([
            [
                'name' => 'type',
                'label' => 'Tipo',
                'type' => 'select_from_array',
                'options' => PaymentMethodsEnum::ALL
            ],
            [
                'name' => 'description',
                'label' => 'Description',
                'type' => 'textarea',
            ],
            [
                'name' => 'public_key',
                'label' => 'Llave Publica',
                'type' => 'text',
            ],
            [
                'name' => 'private_key',
                'label' => 'Llave Privada',
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

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        request()->request->set('public_key', encrypt(request()->input('public_key')));
        request()->request->set('private_key', encrypt(request()->input('private_key')));
        return $this->traitStore();
    }
}
