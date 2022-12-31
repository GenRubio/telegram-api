<?php

namespace App\Http\Controllers\Admin;

use App\Models\Language;
use App\Http\Requests\LanguageRequest;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class LanguageCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Language::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/language');
        CRUD::setEntityNameStrings('idioma', 'idiomas');
    }

    protected function setupListOperation()
    {
        $this->removeActionsCrud();
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

    public function store()
    {
        $abbr = request()->input('abbr');
        $this->makeLangFolder($abbr);
        $this->updateDefaultLanguage(request()->input('default'));
        return $this->traitStore();
    }

    public function update()
    {
        $this->updateDefaultLanguage(request()->input('default'));
        return $this->traitUpdate();
    }

    private function makeLangFolder($abbr)
    {
        $langPath = base_path('lang');
        if (!file_exists("{$langPath}/{$abbr}")) {
            mkdir("{$langPath}/{$abbr}", 0777, true);
        }
    }

    private function updateDefaultLanguage($default){
        if ($default == true){
            Language::query()->update([
                'default' => false
            ]);
        }
    }
}
