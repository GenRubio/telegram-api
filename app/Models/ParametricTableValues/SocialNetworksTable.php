<?php

namespace App\Models\ParametricTableValues;

use App\Models\ParametricTable;
use App\Models\ParametricTableValue;
use Illuminate\Support\Str;

class SocialNetworksTable extends ParametricTableValue
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    public $parametricTableName = 'social_networks';

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
