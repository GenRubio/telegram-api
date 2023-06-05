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
        //if (!backpack_user()->officePermission(get_class($this), 'show')) {
        //    abort(403);
        //}
        CRUD::setModel(\App\Models\TelegramBotGlobalMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-global-message');
        CRUD::setEntityNameStrings('mensaje', 'mensajes globales');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addColumn([
            'name' => 'execution_date',
            'label' => trans('back-office.backpack_menu.glabal_messages.list.ejecution_date'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'status',
            'label' => trans('back-office.backpack_menu.glabal_messages.list.state'),
            'type'  => 'status-global-message',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => trans('back-office.backpack_menu.glabal_messages.list.image'),
            'type'  => 'image',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => trans('back-office.backpack_menu.glabal_messages.list.description'),
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'telegramBotGroup',
            'label' => trans('back-office.backpack_menu.glabal_messages.list.bot_group'),
            'type'      => 'select',
            'name'      => 'telegram_bot_group_id',
            'entity'    => 'telegramBotGroup',
            'attribute' => 'name',
            'model'     => "App\Models\TelegramBotGroup",
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
                'label' => trans('back-office.backpack_menu.glabal_messages.update.description'),
                'type' => 'text',
            ],
            [
                'name' => 'emojis_url',
                'type' => 'custom_html',
                'value' => '<label>' . trans('back-office.backpack_menu.glabal_messages.update.emojis') . '</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
            ],
            [
                'name' => "message",
                'label' => trans('back-office.backpack_menu.glabal_messages.update.message'),
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
                'label' => trans('back-office.backpack_menu.glabal_messages.update.ejectution_date'),
                'type' => 'datetime',
            ],
            [
                'label'     => trans('back-office.backpack_menu.glabal_messages.update.bot_group'),
                'type'      => 'select',
                'name'      => 'telegram_bot_group_id',
                'entity'    => 'telegramBotGroup',
                'model'     => "App\Models\TelegramBotGroup",
                'attribute' => 'name',
            ],
            [
                'name' => 'image',
                'label' => trans('back-office.backpack_menu.glabal_messages.update.image'),
                'type' => 'image-v2',
            ],
            [
                'name' => 'image_bottom',
                'type' => 'checkbox',
                'label' => trans('back-office.backpack_menu.glabal_messages.update.image_position'),
                'default' => true,
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
