<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BotTranslationRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class BotTranslationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\BotTranslation::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/bot-translation');
        CRUD::setEntityNameStrings('texto', 'traducciones');
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
            'name' => 'default_lang_text',
            'label' => 'Texto',
            'type'  => 'text',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BotTranslationRequest::class);
        $this->crud->addFields([
            [
                'name' => 'key',
                'type' => 'hidden',
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
        CRUD::setValidation(BotTranslationRequest::class);
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
                'name' => "text",
                'label' => "Texto",
                'type' => 'textarea',
            ]
        ]);
    }
}
