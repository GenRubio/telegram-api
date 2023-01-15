<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\BotRequest;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use App\Models\Bot;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use DefStudio\Telegraph\Models\TelegraphBot;

class BotCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Bot::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bot');
        CRUD::setEntityNameStrings('bot', 'bots');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'bot-commands', 'bot-commands', 'beginning');
        $this->crud->addButtonFromView('line', 'bot-chats', 'bot-chats', 'beginning');
        //$this->crud->addButtonFromView('line', 'remove-webhook', 'remove-webhook', 'beginning');
        //$this->crud->addButtonFromView('line', 'update-webhook', 'update-webhook', 'beginning');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'webhook',
            'label' => 'WebHook',
            'type'  => 'webHookToggle',
        ]);
        $this->crud->addColumn([
            'name' => 'language_name',
            'label' => 'Idioma',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'bot_url',
            'label' => 'Bot Url',
            'type'  => 'link',
        ]);
        $this->crud->addColumn([
            'name' => 'count_telegram_chats',
            'label' => 'Chats',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BotRequest::class);
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
            ],
            [
                'name' => 'token',
                'label' => 'Token',
                'type' => 'text',
            ],
            [
                'label'     => "Idioma",
                'type'      => 'select',
                'name'      => 'language_id',
                'entity'    => 'language',
                'model'     => "App\Models\Language",
                'attribute' => 'name',
            ],
            [
                'name' => 'bot_url',
                'label' => 'Bot Url',
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
        $bot = Bot::where('id', $request->botId)->first();
        $message = 'WebHook actualizado correctamente';
        try {
            //Artisan::call("telegraph:set-webhook {$request->botId}");
            $telegraphBot->registerWebhook()->send();
            $bot->update([
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
        $bot = Bot::where('id', $request->botId)->first();
        $message = 'WebHook eliminado correctamente';
        try {
            //Artisan::call("telegraph:set-webhook {$request->botId}");
            $telegraphBot->unregisterWebhook()->send();
            $bot->update([
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
