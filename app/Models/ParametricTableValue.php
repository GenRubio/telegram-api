<?php

namespace App\Models;

use App\Scopes\ParametricTableScope;
use Illuminate\Database\Eloquent\Model;

class ParametricTableValue extends Model
{
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ParametricTableScope);
    }

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'parametric_table_values';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'parametric_table_id',
        'name',
        'parameter',
        'resource',
        'filter',
        'visible',
        'active',
    ];
    public $parametricTableName = null;
    // protected $hidden = [];
    // protected $dates = [];

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

    public function parametricTable()
    {
        return $this->belongsTo(ParametricTable::class, 'parametric_table_id')
            ->name($this->parametricTableName);
    }

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
}
