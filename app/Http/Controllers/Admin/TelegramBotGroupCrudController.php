<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TelegramBotGroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotGroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\TelegramBotGroup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-group');
        CRUD::setEntityNameStrings('grupo', 'grupos');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'total_bots_assigned',
            'label' => 'Bots',
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
                'label' => 'Nombre',
                'type' => 'text',
            ],
            [
                'label'     => "Bots",
                'type'      => 'select_multiple',
                'name'      => 'bots',
                'entity'    => 'bots',
                'model'     => "App\Models\Bot",
                'attribute' => 'name',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
