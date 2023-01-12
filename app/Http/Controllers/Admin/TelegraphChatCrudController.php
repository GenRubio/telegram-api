<?php

namespace App\Http\Controllers\Admin;

use App\Models\BotChat;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\TelegraphChatRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegraphChatCrudController extends CrudController
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
        CRUD::setModel(BotChat::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegraph-chat');
        CRUD::setEntityNameStrings('telegraph chat', 'telegraph chats');

        $this->botId = Route::current()->parameter('bot_id');
        $this->crud->setRoute("admin/bot/" . $this->botId . '/telegraph-chat');
        $this->breadCrumbs();
        $this->listFilter();
    }

    protected function breadCrumbs()
    {
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin') => backpack_url('dashboard'),
            'Bots' => backpack_url('bot'),
            'Chats' => backpack_url("bot/" . $this->botId . "/telegraph-chat"),
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
            'name' => 'chat_id',
            'label' => 'Chat ID',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'reference',
            'label' => 'Referencia',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegraphChatRequest::class);

        CRUD::field('chat_id');
        CRUD::field('name');
        CRUD::field('telegraph_bot_id');

    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
