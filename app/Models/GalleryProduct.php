<?php

namespace App\Models;

use App\Services\LanguageService;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class GalleryProduct extends Model
{
    use CrudTrait;
    use HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'gallery_products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'product_model_id',
        'title',
        'alt',
        'description',
        'image',
        'order',
        'visible',
        'active',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    protected $translatable = [
        'title',
        'alt',
        'description'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getLangTitle($abbr)
    {
        return $this->getLangText($abbr, $this->attributes['title']);
    }

    public function getLangAlt($abbr)
    {
        return $this->getLangText($abbr, $this->attributes['alt']);
    }

    public function getLangDescription($abbr)
    {
        return $this->getLangText($abbr, $this->attributes['description']);
    }

    public function getLangText($abbr, $attribute)
    {
        $language = (new LanguageService())->getByAbbr($abbr);
        $message = json_decode($attribute)->{$language->abbr};
        $newcontent = preg_replace("/<p[^>]*?>/", "", $message);
        $newcontent = str_replace("</p>", "\n", $newcontent);
        $newcontent = preg_replace("/<span[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</span>", "", $newcontent);
        $newcontent = preg_replace("/<br[^>]*?>/", "", $newcontent);
        $newcontent = str_replace("</br>", "", $newcontent);
        return $newcontent;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function productModel()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_model_id');
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

    public function setImageAttribute($value)
    {
        $attribute_name = 'image';
        $disk = 'images-product-models';
        $destination_path = 'images/product/models/';
        $destination_path_db = 'images/product/models/';
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
