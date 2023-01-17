<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AffiliateRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class AffiliateCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        if (!backpack_user()->officePermission(get_class($this), 'show')) {
            abort(403);
        }
        CRUD::setModel(\App\Models\Affiliate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/affiliate');
        CRUD::setEntityNameStrings('afiliado', 'afiliados');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
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
            'name' => 'nif',
            'label' => 'NIF',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'bot',
            'label' => 'Bot',
            'type'      => 'select',
            'name'      => 'telegraph_bot_id',
            'entity'    => 'bot',
            'attribute' => 'name',
            'model'     => "App\Models\Bot",
        ]);
        $this->crud->addColumn([
            'name' => 'count_clients',
            'label' => 'Clientes',
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
        CRUD::setValidation(AffiliateRequest::class);
        $this->crud->addFields([
            [
                'name' => 'reference',
                'type' => 'hidden',
            ],
            [
                'label'     => "Bot",
                'type'      => 'select',
                'name'      => 'telegraph_bot_id',
                'entity'    => 'bot',
                'model'     => "App\Models\Bot",
                'attribute' => 'name',
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
            ],
            [
                'name' => 'surnames',
                'label' => 'Apellidos',
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text',
            ],
            [
                'name' => 'phone',
                'label' => 'Telefono',
                'type' => 'text',
            ],
            [
                'name' => 'nif',
                'label' => 'NIF',
                'type' => 'text',
            ],
            [
                'name' => 'iban',
                'label' => 'IBAN',
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
        CRUD::setValidation(AffiliateRequest::class);
        $this->crud->addFields([
            [
                'label'     => "Bot",
                'type'      => 'select',
                'name'      => 'telegraph_bot_id',
                'entity'    => 'bot',
                'model'     => "App\Models\Bot",
                'attribute' => 'name',
            ],
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
            ],
            [
                'name' => 'surnames',
                'label' => 'Apellidos',
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text',
            ],
            [
                'name' => 'phone',
                'label' => 'Telefono',
                'type' => 'text',
            ],
            [
                'name' => 'nif',
                'label' => 'NIF',
                'type' => 'text',
            ],
            [
                'name' => 'iban',
                'label' => 'IBAN',
                'type' => 'text',
            ],
            [
                'name' => 'reference_url',
                'label' => 'Link Invitacion',
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                    'disabled'    => 'disabled',
                ],
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => 'Activo',
                'default' => true,
            ],
        ]);
    }
}
