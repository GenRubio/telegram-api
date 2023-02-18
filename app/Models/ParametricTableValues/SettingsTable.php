<?php

namespace App\Models\ParametricTableValues;

use App\Models\ParametricTable;
use App\Models\ParametricTableValue;
use Illuminate\Support\Str;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class SettingsTable extends ParametricTableValue
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    public $parametricTableName = 'settings';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setParametricTableIdAttribute()
    {
        $this->attributes['parametric_table_id'] = ParametricTable::where('name', $this->parametricTableName)->first()->id;
    }
}