<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Exceptions\GenericException;
use Illuminate\Support\Facades\File;
use App\Models\Language;
use Prologue\Alerts\Facades\Alert;
use App\Http\Requests\LanguageRequest;
use Backpack\LangFileManager\app\Services\LangFiles;
use App\Http\Controllers\Admin\Traits\AdminCrudTrait;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Illuminate\Http\Request;
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
                'label' => 'Name',
            ],
            [
                'name' => 'active',
                'label' => 'Active',
                'type' => 'boolean',
            ],
            [
                'name' => 'default',
                'label' => 'Default',
                'type' => 'boolean',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(LanguageRequest::class);

        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'native',
            'label' => 'Native name',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'abbr',
            'label' => 'Abbr',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'active',
            'label' => 'Active',
            'type' => 'checkbox',
        ]);
        $this->crud->addField([
            'name' => 'default',
            'label' => 'Default',
            'type' => 'checkbox',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store()
    {
        $defaultLang = Language::where('default', 1)->first();

        // Copy the default language folder to the new language folder
        \File::copyDirectory(resource_path('lang/' . $defaultLang->abbr), resource_path('lang/' . request()->input('abbr')));

        return $this->traitStore();
    }

    public function createFile(Request $request)
    {
        $allLangs = Language::all();
        $defaultLang = Language::where('default', 1)->first();
        $request->file_name = Str::slug(strtolower($request->file_name)) . '.php';
        $path = resource_path('lang/' . $defaultLang->abbr) . '/' . $request->file_name;
        if (!file_exists($path)) {
            foreach ($allLangs as $lang) {
                $pathLang = resource_path('lang/' . $lang->abbr) . '/' . $request->file_name;
                file_put_contents($pathLang, file_get_contents(base_path('stubs/lang.stub')));
            }
            Alert::success(trans('backpack::langfilemanager.saved'))->flash();
            return response()->json([
                'success' => ''
            ]);
        } else {
            return response()->json([
                'error' => 'Ya existe un archivo con el mismo nombre'
            ]);
        }
    }

    public function createTranslation(Request $request)
    {
        try {
            $request->translation_key = Str::slug(strtolower($request->translation_key), '_');
            $key = "{$request->translation_file_name}.{$request->translation_key}";
            $defaultLang = Language::where('default', 1)->first();
            $langFile = resource_path("lang/{$defaultLang->abbr}/{$request->translation_file_name}.php");
            $translations = require $langFile;
            if (Arr::has($translations, $request->translation_key)) {
                throw new GenericException("La llave {$key} existe en el archivo de traducción para el idioma {$defaultLang->abbr}");
            } else {
                $allLangs = Language::all();
                foreach ($allLangs as $lang) {
                    $langFile = resource_path("lang/{$lang->abbr}/{$request->translation_file_name}.php");
                    if ($lang->abbr == $defaultLang->abbr) {
                        $value = $request->translation_value;
                    } else {
                        $value = $request->translation_copy_value ? $request->translation_value : '';
                    }
                    $translations = require $langFile;
                    Arr::set($translations, $request->translation_key, $value);
                    $content = '<?php return ' . var_export($translations, true) . ';';
                    File::put($langFile, $content);
                }
                Alert::success(trans('backpack::langfilemanager.saved'))->flash();
                return response()->json([
                    'success' => ''
                ]);
            }
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function squareTranslation(Request $request)
    {
        try {
            $laguages = Language::all();
            foreach ($laguages as $language) {
                $filePath = resource_path('lang/' . $language->abbr);
                foreach (scandir($filePath) as $file) {
                    $filesExcluded = config('backpack.langfilemanager.language_ignore');
                    if (!in_array(str_replace(".php", "", $file), $filesExcluded) && str_contains($file, '.php')) {
                        $content = file_get_contents($filePath . '/' . $file);
                        $parentLangFile = resource_path("lang/{$language->abbr}/{$file}");
                        $keysTranslation = array_keys(Arr::dot(require $parentLangFile));

                        foreach ($laguages as $lang) {
                            if ($lang->abbr != $language->abbr) {
                                $pathLang = resource_path('lang/' . $lang->abbr) . '/' . $file;
                                if (!file_exists($pathLang)) {
                                    File::put($pathLang, $content);
                                } else {
                                    foreach ($keysTranslation as $key) {
                                        if (!Arr::has(require $pathLang, $key)) {
                                            $translations = require $pathLang;
                                            $text = trans(str_replace(".php", ".", $file) . $key, [],  $language->abbr);
                                            $value = $request->translation_copy_value ? $text : '';
                                            Arr::set($translations, $key, $value);
                                            $content2 = '<?php return ' . var_export($translations, true) . ';';
                                            File::put($pathLang, $content2);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            Alert::success(trans('backpack::langfilemanager.saved'))->flash();
            return response()->json([
                'success' => ''
            ]);
        } catch (GenericException | Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * After delete remove also the language folder.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy($id)
    {
        $language = Language::find($id);
        $destroyResult = $this->traitDestroy($id);

        if ($destroyResult) {
            \File::deleteDirectory(resource_path('lang/' . $language->abbr));
        }

        return $destroyResult;
    }

    public function showTexts(LangFiles $langfile, Language $languages, $lang = '', $file = 'site')
    {
        // SECURITY
        // check if that file isn't forbidden in the config file
        if (in_array($file, config('backpack.langfilemanager.language_ignore'))) {
            abort('403', trans('backpack::langfilemanager.cant_edit_online'));
        }

        if ($lang) {
            $langfile->setLanguage($lang);
        }

        $langfile->setFile($file);
        $this->data['crud'] = $this->crud;
        $this->data['currentFile'] = $file;
        $this->data['currentLang'] = $lang ?: config('app.locale');
        $this->data['currentLangObj'] = Language::where('abbr', '=', $this->data['currentLang'])->first();
        $this->data['browsingLangObj'] = Language::where('abbr', '=', config('app.locale'))->first();
        $this->data['languages'] = $languages->orderBy('name')->where('active', 1)->get();
        $this->data['langFiles'] = $langfile->getlangFiles();
        $this->data['fileArray'] = $langfile->getFileContent();
        $this->data['langfile'] = $langfile;
        $this->data['title'] = trans('backpack::langfilemanager.translations');

        return view('vendor.backpack.packets.langfilemanager.translations', $this->data);
    }

    public function updateTexts(LangFiles $langfile, Request $request, $lang = '', $file = 'site')
    {
        // SECURITY
        // check if that file isn't forbidden in the config file
        if (in_array($file, config('backpack.langfilemanager.language_ignore'))) {
            abort('403', trans('backpack::langfilemanager.cant_edit_online'));
        }

        $message = trans('error.error_general');
        $status = false;

        if ($lang) {
            $langfile->setLanguage($lang);
        }

        $langfile->setFile($file);

        $fields = $langfile->testFields($request->all());
        if (empty($fields)) {
            if ($langfile->setFileContent($request->all())) {
                Alert::success(trans('backpack::langfilemanager.saved'))->flash();
                $status = true;
            }
        } else {
            $message = trans('admin.language.fields_required');
            Alert::error(trans('backpack::langfilemanager.please_fill_all_fields'))->flash();
        }

        return redirect()->back();
    }
}
