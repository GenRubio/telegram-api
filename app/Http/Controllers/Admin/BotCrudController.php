<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\BotRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Exception;
use Illuminate\Support\Facades\Artisan;

class BotCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Bot::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bot');
        CRUD::setEntityNameStrings('bot', 'bots');
    }

    protected function setupListOperation()
    {
        $this->crud->addButtonFromView('line', 'set-webhook', 'set-webhook', 'beginning');
        $this->crud->addColumn([
            'name' => 'name',
            'label' => 'Nombre',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'language_name',
            'label' => 'Idioma',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'token',
            'label' => 'Token',
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

    public function setWebhook(Request $request)
    {
        $message = 'WebHook actualizado correctamente';
        try {
            Artisan::call("telegraph:set-webhook {$request->botId}");
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
        return [
            'message' => $message
        ];
    }
}
