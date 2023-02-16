<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use App\Http\Requests\TelegramBotGlobalMessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotGlobalMessageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TelegramBotGlobalMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-global-message');
        CRUD::setEntityNameStrings('mensaje', 'mensajes globales');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'status',
            'label' => 'Estado',
            'type'  => 'status-global-message',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Descripcion',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'telegramBotGroup',
            'label' => 'Grupo Bots',
            'type'      => 'select',
            'name'      => 'telegram_bot_group_id',
            'entity'    => 'telegramBotGroup',
            'attribute' => 'name',
            'model'     => "App\Models\TelegramBotGroup",
        ]);
        $this->crud->addColumn([
            'name' => 'execution_date',
            'label' => 'Fecha ejecucion',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegramBotGlobalMessageRequest::class);
        $this->crud->addFields([
            [
                'name' => 'status',
                'type' => 'hidden',
            ],
            [
                'name' => 'description',
                'label' => 'Descripcion',
                'type' => 'text',
            ],
            [
                'name' => 'emojis_url',
                'type' => 'custom_html',
                'value' => '<label>Emojis</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
            ],
            [
                'name' => "message",
                'label' => "Mensaje",
                'type'  => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['font', ['bold', 'underline', 'italic']]
                    ],
                    'minheight' => 300,
                    'height' => 300
                ],
            ],
            [
                'name' => 'execution_date',
                'label' => 'Fecha lanzamiento',
                'type' => 'datetime',
            ],
            [
                'label'     => "Grupo Bots",
                'type'      => 'select',
                'name'      => 'telegram_bot_group_id',
                'entity'    => 'telegramBotGroup',
                'model'     => "App\Models\TelegramBotGroup",
                'attribute' => 'name',
            ],
            [
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TelegramBotGlobalMessageRequest::class);
        $this->crud->addFields([
            [
                'name' => 'status',
                'type' => 'hidden',
            ],
            [
                'name' => 'description',
                'label' => 'Descripcion',
                'type' => 'text',
            ],
            [
                'name' => 'emojis_url',
                'type' => 'custom_html',
                'value' => '<label>Emojis</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
            ],
            [
                'name' => "message",
                'label' => "Mensaje",
                'type'  => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['font', ['bold', 'underline', 'italic']]
                    ],
                    'minheight' => 300,
                    'height' => 300
                ],
            ],
            [
                'name' => 'execution_date',
                'label' => 'Fecha lanzamiento',
                'type' => 'datetime',
            ],
            [
                'label'     => "Grupo Bots",
                'type'      => 'select',
                'name'      => 'telegram_bot_group_id',
                'entity'    => 'telegramBotGroup',
                'model'     => "App\Models\TelegramBotGroup",
                'attribute' => 'name',
            ],
            [
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload-image',
                'upload' => true,
            ]
        ]);
    }
}
