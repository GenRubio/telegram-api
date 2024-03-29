<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TelegramBotGroupRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotGroupCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TelegramBotGroup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-group');
        CRUD::setEntityNameStrings('grupo', 'grupos');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'key',
            'label' => trans('back-office.backpack_menu.grups.list.key'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans('back-office.backpack_menu.grups.list.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_bots_assigned',
            'label' => trans('back-office.backpack_menu.grups.list.bots'),
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegramBotGroupRequest::class);

        $this->crud->addFields([
            [
                'name' => 'key',
                'type' => 'hidden',
            ],
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.grups.update.name'),
                'type' => 'text',
            ],
            [
                'label'     => trans('back-office.backpack_menu.grups.update.bots'),
                'type'      => 'select_multiple',
                'name'      => 'bots',
                'entity'    => 'telegraphBots',
                'model'     => "App\Models\TelegraphBot",
                'attribute' => 'name',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
