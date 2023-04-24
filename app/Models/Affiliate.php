<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Affiliate extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'affiliates';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'telegraph_bot_id',
        'name',
        'surnames',
        'email',
        'password',
        'phone',
        'nif',
        'iban',
        'reference',
        'active',
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

    public function telegraphBot()
    {
        return $this->belongsTo(TelegraphBot::class, 'telegraph_bot_id');
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

    public function getCountClientsAttribute()
    {
        return count($this->telegraphBot->telegraphChats
            ->where('reference', $this->attributes['reference']));
    }

    public function getReferenceUrlAttribute()
    {
        return $this->telegraphBot->bot_url . '?start=' . $this->attributes['reference'];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setReferenceAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['reference'] = str_replace(".", "", microtime(true));
        }
    }
}
