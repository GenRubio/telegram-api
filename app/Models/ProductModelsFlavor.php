<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class ProductModelsFlavor extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_models_flavors';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'product_model_id',
        'name',
        'image',
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

    public function productModel()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_model_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where($this->table . '.active', true);
    }

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
        $destination_path = 'images/product/models/flavors/';
        $destination_path_db = 'images/product/models/flavors/';
        if (!$this->preventAttrSet) {
            if ($value == null) {
                Storage::disk($disk)->delete('public/' . $this->{$attribute_name});
                $this->attributes[$attribute_name] = null;
            }
            if ($this->{$attribute_name}) {
                Storage::disk($disk)->delete('public/' . $this->{$attribute_name});
            }
            $image = Image::make($value)->encode('jpg', 90);
            $filename = md5($value . time()) . '-' . $attribute_name . '.jpg';
            Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path_db . $filename;
        } else {
            $this->attributes[$attribute_name] = $value;
        }
    }
}
