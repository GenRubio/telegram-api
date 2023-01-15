<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DefStudio\Telegraph\Models\TelegraphBot;
use App\Tasks\Bot\Settings\SetCommandsBotTask;

class CrudHelper
{
    public static function toggleField(Request $request)
    {
        $model = new $request->model;
        $field = $request->field;
        $obj = $model->find($request->id);
        $obj->$field = ($obj->$field) ? 0 : 1;
        $obj->save();

        $fa = ($obj->$field) ? 'la-check' : 'la-times';
        $text = ($obj->$field) ? trans('backpack::crud.yes') : trans('backpack::crud.no');

        return '<i class="la ' . $fa . '"></i> ' . $text;
    }

    public static function toggleFieldV2(Request $request)
    {
        $model = new $request->model;
        $field = $request->field;
        $obj = $model->find($request->id);
        $obj->$field = ($obj->$field) ? 0 : 1;
        $obj->save();
        
        return [
            'checked' => ($obj->$field)
        ];
    }

    public static function webHookToggle(Request $request)
    {
        $model = new $request->model;
        $field = $request->field;
        $obj = $model->find($request->id);
        $obj->$field = ($obj->$field) ? 0 : 1;
        $obj->save();
        $telegraphBot = TelegraphBot::where('id', $obj->id)->first();

        if (($obj->$field)) {
            $telegraphBot->unregisterWebhook()->send();
            $telegraphBot->registerWebhook()->send();
            (new SetCommandsBotTask($obj))->run();
        } else {
            $telegraphBot->unregisterWebhook()->send();
        }
        return [
            'checked' => ($obj->$field)
        ];
    }
}
