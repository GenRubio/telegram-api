<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use App\Http\Requests\TelegramBotGlobalMessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotGlobalMessageCrudController extends CrudController
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
        $this->crud->addFields($this->setCreateFields());
    }

    private function setCreateFields()
    {
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        $data = [];
        $data[] = [
            'name' => 'message',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'status',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'text',
        ];
        $data[] = [
            'name' => 'execution_date',
            'label' => 'Fecha lanzamiento',
            'type' => 'datetime',
        ];
        $data[] = [
            'label'     => "Grupo Bots",
            'type'      => 'select',
            'name'      => 'telegram_bot_group_id',
            'entity'    => 'telegramBotGroup',
            'model'     => "App\Models\TelegramBotGroup",
            'attribute' => 'name',
        ];
        $data[] = [
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
        ];
        $data[] = [
            'name' => 'emojis_url',
            'type' => 'custom_html',
            'value' => '<label>Emojis</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Mensaje ({$lang->abbr})",
                'type'  => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['font', ['bold', 'underline', 'italic']]
                    ],
                    'minheight' => 200,
                    'height' => 200
                ],
            ];
        }
        return $data;
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TelegramBotGlobalMessageRequest::class);
        $this->crud->addFields($this->setUpdateFields());
    }

    private function setUpdateFields()
    {
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        $data = [];
        $data[] = [
            'name' => 'message',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'status',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'text',
        ];
        $data[] = [
            'name' => 'execution_date',
            'label' => 'Fecha lanzamiento',
            'type' => 'datetime',
        ];
        $data[] = [
            'label'     => "Grupo Bots",
            'type'      => 'select',
            'name'      => 'telegram_bot_group_id',
            'entity'    => 'telegramBotGroup',
            'model'     => "App\Models\TelegramBotGroup",
            'attribute' => 'name',
        ];
        $data[] = [
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
        ];
        $data[] = [
            'name' => 'emojis_url',
            'type' => 'custom_html',
            'value' => '<label>Emojis</label><br><a href="https://emojiterra.com/es/x/" target="_blank">https://emojiterra.com/es/x/</a>'
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Mensaje ({$lang->abbr})",
                'type'  => 'summernote',
                'options' => [
                    'toolbar' => [
                        ['font', ['bold', 'underline', 'italic']]
                    ],
                    'minheight' => 200,
                    'height' => 200
                ],
                'value' => $this->crud->getCurrentEntry()->getTextValueForInput($lang->abbr)
            ];
        }
        return $data;
    }

    public function store()
    {
        $textData = [];
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        foreach ($laguages as $lang) {
            $textValue = request()->input("lang_{$lang->abbr}");
            $textData[$lang->abbr] = $textValue;
        }
        request()->request->set('message', json_encode($textData));
        return $this->traitStore();
    }

    public function update()
    {
        $textData = [];
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        foreach ($laguages as $lang) {
            $textValue = request()->input("lang_{$lang->abbr}");
            $textData[$lang->abbr] = $textValue;
        }
        request()->request->set('message', json_encode($textData));
        return $this->traitUpdate();
    }
}
