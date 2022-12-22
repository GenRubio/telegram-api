<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class LanguageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Language::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/language');
        CRUD::setEntityNameStrings('idioma', 'idiomas');
    }

    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'name' => 'name',
                'label' => trans('translationsystem.form.laguage_name'),
            ],
            [
                'name' => 'active',
                'label' => trans('translationsystem.form.language_active'),
                'type' => 'boolean',
            ],
            [
                'name' => 'default',
                'label' => trans('translationsystem.form.laguage_default'),
                'type' => 'boolean',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(LanguageRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => trans('translationsystem.form.laguage_name'),
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'native',
            'label' => trans('translationsystem.form.laguage_native_name'),
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'abbr',
            'label' => trans('translationsystem.form.laguage_abbr'),
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'active',
            'label' => trans('translationsystem.form.language_active'),
            'type' => 'checkbox',
        ]);
        $this->crud->addField([
            'name' => 'default',
            'label' => trans('translationsystem.form.laguage_default'),
            'type' => 'checkbox',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
