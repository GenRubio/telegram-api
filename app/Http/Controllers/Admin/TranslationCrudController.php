<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TranslationRequest;
use App\Models\Language;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TranslationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Translation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/translation');
        CRUD::setEntityNameStrings('texto', 'traducciones');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumn([
            'name' => 'default_lang_text',
            'label' => 'Texto',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);
        $this->crud->addFields($this->setCreateFields());
    }

    private function setCreateFields()
    {
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        $data = [];
        $data[] = [
            'name' => 'uuid',
            'type' => 'hidden',
        ];
        $data[] = [
            'name' => 'text',
            'type' => 'hidden',
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Texto ({$lang->abbr})",
                'type' => 'textarea',
            ];
        }
        return $data;
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);
        $this->crud->addFields($this->setUpdateFields());
    }

    private function setUpdateFields()
    {
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        $data = [];
        $data[] = [
            'name' => 'text',
            'type' => 'hidden',
        ];
        foreach ($laguages as $lang) {
            $data[] = [
                'name' => "lang_{$lang->abbr}",
                'label' => "Texto ({$lang->abbr})",
                'type' => 'textarea',
                'value' => $this->crud->getCurrentEntry()->getTextValueForInput($lang->abbr)
            ];
        }
        return $data;
    }

    public function store()
    {
        $textData = [];
        $laguages = Language::active()->orderBy('default', 'desc')->get();
        foreach ($laguages as $lang){
            $textValue = request()->input("lang_{$lang->abbr}");
            $textData[$lang->abbr] = $textValue;
        }
        request()->request->set('text', json_encode($textData));
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
        request()->request->set('text', json_encode($textData));
        return $this->traitUpdate();
    }
}
