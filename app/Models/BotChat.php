<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DefStudio\Telegraph\Models\TelegraphChat;

class BotChat extends Model
{
    use CrudTrait;
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'telegraph_chats';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'chat_id',
        'name',
        'telegraph_bot_id',
        'reference',
        'language_id',
        'pin_message'
    ];
    // protected $hidden = [];
    // protected $dates = [];
    // protected $translatable = [];
    // protected $casts = [];


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
        return $this->hasOne(Language::class, 'id', 'language_id');
    }

    public function telegraphChat()
    {
        return $this->hasOne(TelegraphChat::class, 'chat_id', 'chat_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    public function getLanguageNameAttribute()
    {
        return $this->language?->name;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
