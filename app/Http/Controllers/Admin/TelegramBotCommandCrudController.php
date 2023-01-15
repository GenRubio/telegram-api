<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Requests\TelegramBotCommandRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotCommandCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected $botId;

    public function setup()
    {
        if (!backpack_user()->officePermission(get_class($this), 'show')) {
            abort(403);
        }
        CRUD::setModel(\App\Models\TelegramBotCommand::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-command');
        CRUD::setEntityNameStrings('comando', 'comandos');

        $this->botId = Route::current()->parameter('bot_id');
        $this->crud->setRoute("admin/bot/" . $this->botId . '/telegram-bot-command');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Bots' => backpack_url('bot'),
            'Comandos' => backpack_url("bot/" . $this->botId . "/telegram-bot-command"),
            trans('backpack::crud.list') => false,
        ];
    }

    protected function listFilter()
    {
        $this->crud->addClause('where', 'telegraph_bot_id', $this->botId);
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'command',
            'label' => 'Comando',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Descripcion',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegramBotCommandRequest::class);

        $this->crud->addFields([
            [
                'name' => 'telegraph_bot_id',
                'type' => 'hidden',
                'value' => $this->botId
            ],
            [
                'name' => 'command',
                'label' => 'Comando',
                'type' => 'text',
            ],
            [
                'name' => 'description',
                'label' => 'Descripcion',
                'type' => 'text',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
