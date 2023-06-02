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
        CRUD::setModel(\App\Models\TelegraphBot::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bot');
        CRUD::setEntityNameStrings('bot', 'bots');
    }

    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'bot-actions', 'bot-actions', 'beginning');
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
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegraphBotRequest::class);
        $this->crud->addFields([
            [
                'name' => 'name',
                'label' => 'Nombre',
                'type' => 'text',
                'tab' => 'Configuración'
            ],
            [
                'name' => 'token',
                'label' => 'Token',
                'type' => 'text',
                'tab' => 'Configuración'
            ],
            [
                'label'     => "Idioma por defecto",
                'type'      => 'select',
                'name'      => 'language_id',
                'entity'    => 'language',
                'model'     => "App\Models\Language",
                'attribute' => 'name',
                'tab' => 'Configuración'
            ],
            [
                'name' => 'bot_url',
                'label' => 'Bot Url',
                'type' => 'text',
                'tab' => 'Configuración'
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
        $message = 'WebHook actualizado correctamente';
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
        $message = 'WebHook eliminado correctamente';
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
