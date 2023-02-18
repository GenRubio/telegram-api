<?php

namespace App\Models\ParametricTableValues;

use App\Models\ParametricTable;
use App\Models\ParametricTableValue;
use Illuminate\Support\Str;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class SocialNetworksTable extends ParametricTableValue
{
    use CrudTrait;

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
