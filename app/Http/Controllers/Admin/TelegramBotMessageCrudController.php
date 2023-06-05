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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\TelegramBotMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-message');
        CRUD::setEntityNameStrings('mensaje', 'mensajes');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'key',
            'label' => trans('back-office.backpack_menu.default_messages.list.key'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => trans('back-office.backpack_menu.default_messages.list.image'),
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => trans('back-office.backpack_menu.default_messages.list.description'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'is_text_full_translate',
            'label' => trans('back-office.backpack_menu.default_messages.list.translated'),
            'type'  => 'check',
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
                'label' => trans('back-office.backpack_menu.default_messages.update.description'),
                'type' => 'text',
            ],
            [
                'name' => 'emojis_url',
                'type' => 'custom_html',
                'value' => '<label>' . trans('back-office.backpack_menu.default_messages.update.emojis') . '</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
            ],
            [
                'name' => "message",
                'label' => trans('back-office.backpack_menu.default_messages.update.message'),
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
                'label' => trans('back-office.backpack_menu.default_messages.update.image'),
                'type' => 'image-v2',
            ],
            [
                'name' => 'image_bottom',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.default_messages.update.image_position'),
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $message = removeTextTags(request()->input('message'));
        if (mb_strlen($message) >= 4096) {
            Alert::error(trans('back-office.backpack_menu.default_messages.errors.max_description_chars'))->flash();
            return back();
        }
        return $this->traitStore();
    }

    public function update()
    {
        $message = removeTextTags(request()->input('message'));
        if (mb_strlen($message) >= 4096) {
            Alert::error(trans('back-office.backpack_menu.default_messages.errors.max_description_chars'))->flash();
            return back();
        }
        return $this->traitUpdate();
    }
}
