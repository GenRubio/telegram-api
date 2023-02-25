<?php

namespace App\Models;

use Exception;
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
        return translateText($abbr, $this->attributes['title']);
    }

    public function getLangAlt($abbr)
    {
        return translateText($abbr, $this->attributes['alt']);
    }

    public function getLangDescription($abbr)
    {
        return translateText($abbr, $this->attributes['description']);
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
            $filename = md5($value . time()) . '-' . $attribute_name . '.' . $value->getClientOriginalExtension();
            if ($value->getClientOriginalExtension() == "gif") {
                //copy($value->getRealPath(), $destination);
                Storage::disk($disk)->put($destination_path . $filename, $value);
            } else {
                $image = Image::make($value)->encode($value->getClientOriginalExtension(), 90);
                Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            }
            $this->attributes[$attribute_name] = $destination_path_db . $filename;
        } else {
            $this->attributes[$attribute_name] = $value;
        }
    }
}
