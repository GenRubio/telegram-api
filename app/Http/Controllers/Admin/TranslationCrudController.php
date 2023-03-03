<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TranslationTypesEnum;
use App\Http\Requests\TranslationRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TranslationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Translation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/translation');
        CRUD::setEntityNameStrings('texto', 'traducciones');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
        $this->crud->addButtonFromView('line', 'copy-uuid-trans-button', 'copy-uuid-trans-button', 'beginning');
        $this->crud->addColumn([
            'name' => 'uuid',
            'label' => 'UUID',
            'type'  => 'text',
        ]);
        $this->crud->addColumn([
            'name' => 'type',
            'label' => 'Tipo',
            'type' => 'select_from_array',
            'options' => TranslationTypesEnum::TYPES,
        ]);
        $this->crud->addColumn([
            'name' => 'default_lang_text',
            'label' => 'Texto',
            'type'  => 'text',
            'searchLogic' => function ($query, $column, $searchTerm) {
                $query->orWhere('text', 'like', '%' . $searchTerm . '%');
            }
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);
        $this->crud->addFields([
            [
                'name' => 'uuid',
                'type' => 'hidden',
            ],
            [
                'name' => "type",
                'label' => "Tipo",
                'type' => 'select_from_array',
                'options' => TranslationTypesEnum::TYPES,
            ],
            [
                'name' => "text",
                'label' => "Texto",
                'type' => 'textarea',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TranslationRequest::class);
        $this->crud->addFields([
            [
                'name' => 'uuid',
                'label' => 'Key',
                'type' => 'text',
                'attributes' => [
                    'readonly' => 'readonly',
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => "type",
                'label' => "Tipo",
                'type' => 'select_from_array',
                'options' => TranslationTypesEnum::TYPES,
            ],
            [
                'name' => "text",
                'label' => "Texto",
                'type' => 'textarea',
            ]
        ]);
    }
}
