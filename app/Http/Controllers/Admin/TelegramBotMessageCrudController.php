<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Http\Requests\TelegramBotMessageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TelegramBotMessageCrudController extends CrudController
{
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
        CRUD::setModel(\App\Models\TelegramBotMessage::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/telegram-bot-message');
        CRUD::setEntityNameStrings('mensaje', 'mensajes');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'key',
            'label' => 'Key',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'description',
            'label' => 'Descripcion',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'image',
            'label' => 'Imagen',
            'type'  => 'image',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TelegramBotMessageRequest::class);
        $this->crud->addFields($this->setCreateFields());
    }

    private function setCreateFields()
    {
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        $data = [];
        $data[] = [
            'name' => 'key',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'message',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'textarea',
        ];
        $data[] = [
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Mensaje ({$lang->abbr})",
                'type' => 'textarea',
                'attributes' => [
                    'rows' => 7,
                ]
            ];
        }
        return $data;
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
            'name' => 'description',
            'label' => 'Descripcion',
            'type' => 'textarea',
        ];
        $data[] = [
            'name' => 'image',
            'label' => 'Imagen',
            'type' => 'upload',
            'upload' => true,
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Mensaje ({$lang->abbr})",
                'type' => 'textarea',
                'attributes' => [
                    'rows' => 7,
                ],
                'value' => $this->crud->getCurrentEntry()->getTextValueForInput($lang->abbr)
            ];
        }
        return $data;
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TelegramBotMessageRequest::class);
        $this->crud->addFields($this->setUpdateFields());
    }

    public function store()
    {
        $textData = [];
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        foreach ($laguages as $lang){
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
        foreach ($laguages as $lang){
            $textValue = request()->input("lang_{$lang->abbr}");
            $textData[$lang->abbr] = $textValue;
        }
        request()->request->set('message', json_encode($textData));
        return $this->traitUpdate();
    }
}
