<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\TelegraphBotRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use App\Models\TelegraphBot;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegraphBotCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TelegraphBot::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bot');
        CRUD::setEntityNameStrings('bot', 'bots');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'bot-actions', 'bot-actions', 'beginning');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => trans('back-office.backpack_menu.bots.list.name'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'webhook',
            'label' => trans('back-office.backpack_menu.bots.list.webhook'),
            'type'  => 'webHookToggle',
        ]);
        $this->crud->addColumn([
            'name' => 'language_name',
            'label' => trans('back-office.backpack_menu.bots.list.language'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'bot_url',
            'label' => trans('back-office.backpack_menu.bots.list.bot_url'),
            'type'  => 'link',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegraphBotRequest::class);
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => trans('back-office.backpack_menu.bots.update.name'),
                'type' => 'text',
            ],
            [
                'name' => 'token',
                'label' => trans('back-office.backpack_menu.bots.update.token'),
                'type' => 'text',
            ],
            [
                'label'     => trans('back-office.backpack_menu.bots.update.default_language'),
                'type'      => 'select',
                'name'      => 'language_id',
                'entity'    => 'language',
                'model'     => "App\Models\Language",
                'attribute' => 'name',
            ],
            [
                'name' => 'bot_url',
                'label' => trans('back-office.backpack_menu.bots.update.bot_url'),
                'type' => 'text',
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function updateWebhook(Request $request)
    {
        $telegraphBot = TelegraphBot::where('id', $request->botId)->first();
        $message = trans('back-office.backpack_menu.bots.success.update_webhook');
        try {
            $telegraphBot->registerWebhook()->send();
            $telegraphBot->update([
                'webhook' => true
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return [
            'message' => $message
        ];
    }

    public function removeWebhook(Request $request)
    {
        $telegraphBot = TelegraphBot::where('id', $request->botId)->first();
        $message = trans('back-office.backpack_menu.bots.success.deleted_webhook');
        try {
            $telegraphBot->unregisterWebhook()->send();
            $telegraphBot->update([
                'webhook' => false
            ]);
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return [
            'message' => $message
        ];
    }
}
