<?php

namespace App\Models;

use App\Services\BotService;
use App\Services\LanguageService;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class TelegramBotMessage extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'telegram_bot_messages';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'key',
        'description',
        'image',
        'message'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getLangMessage($abbr)
    {
        $language = (new LanguageService())->getByAbbr($abbr);
        $message = json_decode($this->attributes['message'])->{$language->abbr};
        $newcontent = preg_replace("/<p[^>]*?>/", "", $message);
        $newcontent = str_replace("</p>", "\n", $newcontent);
        $newcontent = preg_replace("/<span[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</span>", "", $newcontent);
        $newcontent = preg_replace("/<br[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</br>", "", $newcontent);
        $newcontent = str_replace("&nbsp;", "", $newcontent);
        return $newcontent;
    }

    public function getTextValueForInput($abbr)
    {
        $text = json_decode($this->attributes['message']);
        return $text->{$abbr} ?? '';
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

    public function setKeyAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['key'] = microtime(true);
        }
    }

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'images-product-models';
        $destination_path = 'images/bot/';
        $destination_path_db = 'images/bot/';
        if (!$this->preventAttrSet) {
            if ($value == null) {
                Storage::disk($disk)->delete('public/' . $this->{$attribute_name});
                $this->attributes[$attribute_name] = null;
            }
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete('public/' . $this->{$attribute_name});
            }
            $image = Image::make($value)->encode('png', 90);
            $filename = md5($value . time()) . '-' . $attribute_name . '.png';
            Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path_db . $filename;
        } else {
            $this->attributes[$attribute_name] = $value;
        }
    }
}
