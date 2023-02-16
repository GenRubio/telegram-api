<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Translation extends Model
{
    use CrudTrait;
    use HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'translations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'uuid',
        'text'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    protected $translatable = [
        'text',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTextValueForInput($abbr)
    {
        $text = json_decode($this->attributes['text']);
        return $text->{$abbr} ?? '';
    }

    public function langText($abbr)
    {
        $text = json_decode($this->attributes['text']);
        return $text->{$abbr};
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

    public function getDefaultLangTextAttribute()
    {
        $language = Language::active()->where('default', true)->first();
        $text = json_decode($this->attributes['text']);
        return $text->{$language->abbr} ?? '';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setUuidAttribute($value)
    {
        $this->attributes['uuid'] = uniqid(microtime(true));
    }
}
