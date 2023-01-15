<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Database\Eloquent\Model;

class TelegramBotCommand extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'telegram_bot_commands';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'telegraph_bot_id',
        'command',
        'description'
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

    public function bot()
    {
        return $this->hasOne(Bot::class, 'id', 'telegraph_bot_id');
    }

    public function telegraphBot()
    {
        return $this->hasOne(TelegraphBot::class, 'id', 'telegraph_bot_id');
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
