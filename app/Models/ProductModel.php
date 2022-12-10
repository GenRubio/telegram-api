<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Carbon\Carbon;

class ProductModel extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_models';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'reference',
        'name',
        'image',
        'price',
        'discount',
        'size',
        'power_range',
        'input_voltage',
        'battery_capacity',
        'e_liquid_capacity',
        'concentration',
        'resistance',
        'absorbable_quantity',
        'charging_port',
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

    public function productModelsFlavors()
    {
        return $this->hasMany(ProductModelsFlavor::class, 'product_model_id', 'id');
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

    public function getProductModelsFlavorsCountAttribute()
    {
        return count($this->productModelsFlavors);
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setReferenceAttribute($value)
    {
        if (is_null($value)) {
            $product = ProductModel::orderBy('reference', 'desc')->first();
            if (is_null($product)) {
                $this->attributes['reference'] = Carbon::now()->format('Y') . '10000';
            } else {
                if (empty($product->reference)) {
                    $this->attributes['reference'] = Carbon::now()->format('Y') . '10000';
                } else {
                    $this->attributes['reference'] = (int)$product->reference + 1;
                }
            }
        }
    }

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
            $image = Image::make($value)->encode('jpg', 90);
            $filename = md5($value . time()) . '-' . $attribute_name . '.jpg';
            Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path_db . $filename;
        } else {
            $this->attributes[$attribute_name] = $value;
        }
    }
}
