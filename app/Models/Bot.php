<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DefStudio\Telegraph\Models\TelegraphBot;

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
        return $this->hasMany(BotChat::class, 'telegraph_bot_id', 'id');
    }

    public function telegraphBot()
    {
        return $this->hasOne(TelegraphBot::class, 'id', 'id');
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
