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
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\Affiliate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/affiliate');
        CRUD::setEntityNameStrings('afiliado', 'afiliados');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans('back-office.backpack_menu.affiliates.list.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'surnames',
            'label' => trans('back-office.backpack_menu.affiliates.list.surname'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'nif',
            'label' => trans('back-office.backpack_menu.affiliates.list.identification'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'bot',
            'label' => trans('back-office.backpack_menu.affiliates.list.bot'),
            'type'      => 'select',
            'name'      => 'telegraph_bot_id',
            'entity'    => 'telegraphBot',
            'attribute' => 'name',
            'model'     => "App\Models\TelegraphBot",
        ]);
        $this->crud->addColumn([
            'name' => 'count_clients',
            'label' => trans('back-office.backpack_menu.affiliates.list.clients'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'active',
            'type' => 'btnToggleV2',
            'label' => trans('back-office.backpack_menu.affiliates.list.active'),
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
                'label'     => trans('back-office.backpack_menu.affiliates.update.bot'),
                'type'      => 'select',
                'name'      => 'telegraph_bot_id',
                'entity'    => 'telegraphBot',
                'model'     => "App\Models\TelegraphBot",
                'attribute' => 'name',
            ],
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.affiliates.update.name'),
                'type' => 'text',
            ],
            [
                'name' => 'surnames',
                'label' => trans('back-office.backpack_menu.affiliates.update.surname'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => trans('back-office.backpack_menu.affiliates.update.email'),
                'type' => 'text',
            ],
            [
                'name' => 'phone',
                'label' => trans('back-office.backpack_menu.affiliates.update.phone'),
                'type' => 'text',
            ],
            [
                'name' => 'nif',
                'label' => trans('back-office.backpack_menu.affiliates.update.identification'),
                'type' => 'text',
            ],
            [
                'name' => 'iban',
                'label' => trans('back-office.backpack_menu.affiliates.update.iban'),
                'type' => 'text',
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.affiliates.update.active'),
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(AffiliateRequest::class);
        $this->crud->addFields([
            [
                'label'     => trans('back-office.backpack_menu.affiliates.update.bot'),
                'type'      => 'select',
                'name'      => 'telegraph_bot_id',
                'entity'    => 'telegraphBot',
                'model'     => "App\Models\TelegraphBot",
                'attribute' => 'name',
            ],
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.affiliates.update.name'),
                'type' => 'text',
            ],
            [
                'name' => 'surnames',
                'label' => trans('back-office.backpack_menu.affiliates.update.surname'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => trans('back-office.backpack_menu.affiliates.update.email'),
                'type' => 'text',
            ],
            [
                'name' => 'phone',
                'label' => trans('back-office.backpack_menu.affiliates.update.phone'),
                'type' => 'text',
            ],
            [
                'name' => 'nif',
                'label' => trans('back-office.backpack_menu.affiliates.update.identification'),
                'type' => 'text',
            ],
            [
                'name' => 'iban',
                'label' => trans('back-office.backpack_menu.affiliates.update.iban'),
                'type' => 'text',
            ],
            [
                'name' => 'reference_url',
                'label' => trans('back-office.backpack_menu.affiliates.update.invitation_url'),
                'type' => 'text',
                'attributes' => [
                    'readonly'    => 'readonly',
                ],
            ],
            [
                'name' => 'active',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.affiliates.update.active'),
                'default' => true,
            ],
        ]);
    }
}
