<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TelegramBotMessageRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotMessageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\TelegramBotMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-message');
        CRUD::setEntityNameStrings('mensaje', 'mensajes');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
            'type'  => 'text',
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
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegramBotMessageRequest::class);
        $this->crud->addFields([
            [
                'name' => 'key',
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
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload',
                'upload' => true,
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TelegramBotMessageRequest::class);
        $this->crud->addFields([
            [
                'name' => 'key',
                'label' => 'Key',
                'type' => 'text',
                'attributes' => [
                    'readonly' => 'readonly',
                    'disabled' => 'disabled'
                ],
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
                'name' => 'image',
                'label' => 'Imagen',
                'type' => 'upload-image',
                'upload' => true,
            ]
        ]);
    }
}
