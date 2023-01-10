<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DefStudio\Telegraph\Models\TelegraphChat;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Bot extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    protected $table = 'telegraph_bots';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'name',
        'token',
        'bot_url',
        'language_id',
        'webhook'
    ];

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

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function telegramChats()
    {
        return $this->hasMany(TelegraphChat::class, 'telegraph_bot_id', 'id');
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

    public function getCountTelegramChatsAttribute()
    {
        return count($this->telegramChats);
    }

    public function getLanguageNameAttribute()
    {
        return $this->language->name;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
