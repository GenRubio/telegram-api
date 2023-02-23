<?php

namespace App\Models\ParametricTableValues;

use App\Models\ParametricTable;
use App\Models\ParametricTableValue;
use Illuminate\Support\Str;

class SettingsTable extends ParametricTableValue
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    public $translatable = [
        'parameter',
    ];
    
    public $parametricTableName = 'settings';

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getParamatricTableId()
    {
        return ParametricTable::where('name', $this->parametricTableName)
            ->first()
            ->id;
    }

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
