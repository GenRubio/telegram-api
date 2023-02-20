<?php

namespace App\Http\Controllers\Admin;

use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\TelegramBotMessageRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotMessageCrudController extends CrudController
{
    use AdminCrudTrait;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation{
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation{
        update as traitUpdate;
    }
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
                'type' => 'image-v2',
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
                'type' => 'image-v2',
            ]
        ]);
    }

    public function store()
    {
        $message = strip_tags(request()->input('message'));
        dd($message, strlen($message));
        if (strlen($message) >= 400){
            Alert::error('El mesaje no puede superar 400 caracteres.')->flash();
            return back();
        }
        return $this->traitStore();
    }

    public function update()
    {
        $message = strip_tags(request()->input('message'));
        dd($message, strlen($message));
        if (strlen($message) >= 400){
            Alert::error('El mesaje no puede superar 400 caracteres.')->flash();
            return back();
        }
        return $this->traitUpdate();
    }
}
