<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class ParametricTable extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'parametric_tables';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'comment',
        'resource',
    ];
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

    public function parametricTableValues()
    {
        return $this->hasMany(ParametricTableValue::class, 'parametric_table_id', 'id')
            ->orderBy('order', 'asc');
    }

    public function parametricTableValuesResource()
    {
        return $this->hasMany(ParametricTableValue::class, 'parametric_table_id', 'id')
            ->where('resource', true)
            ->where('active', true)
            ->orderBy('order', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeName($query, $name)
    {
        return $query->when(!is_null($name), function ($query) use ($name) {
            return $query->where('name', $name);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getCountValuesAttribute()
    {
        return count($this->parametricTableValues);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
