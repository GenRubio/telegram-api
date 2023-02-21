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
        'brand_id',
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

    public function productBrand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function productModelsFlavors()
    {
        return $this->hasMany(ProductModelsFlavor::class, 'product_model_id', 'id')
            ->where('active', true);
    }

    public function valorations()
    {
        return $this->hasMany(ProductModelValoration::class, 'product_model_id', 'id')
            ->where('visible', true);
    }

    public function galleryImages()
    {
        return $this->hasMany(GalleryProduct::class, 'product_model_id', 'id')
            ->where('active', true)
            ->orderBy('order', 'asc');
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

    public function scopeOrderBy($query, $order)
    {
        return $query->when(!empty($order) && $order == 'price_asc', function ($when) {
            return $when->orderBy('price', 'asc');
        })->when(!empty($order) && $order == 'price_desc', function ($when) {
            return $when->orderBy('price', 'desc');
        });
    }

    public function scopeNicotine($query, $nicotine)
    {
        return $query->when(!empty($nicotine) && $nicotine == '2', function ($when) {
            return $when->where('concentration', '2')
                ->orWhere('concentration', '20');
        })->when(!empty($nicotine) && $nicotine == '5', function ($when) {
            return $when->where('concentration', '5')
                ->orWhere('concentration', '50');
        });
    }

    public function scopeBrands($query, $brands)
    {
        return $query->when(!empty($brands), function ($when) use ($brands) {
            return $when->whereIn('brand_id', $brands);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getPriceWithDiscountAttribute()
    {
        if ($this->discount && $this->discount > 0) {
            $productDiscount = ($this->price * $this->discount / 100);
            return $this->price - $productDiscount;
        }
        return $this->price;
    }

    public function getDiscountBackpackAttribute()
    {
        return $this->discount . ' %';
    }

    public function getTotalPriceBackpackAttribute()
    {
        return $this->price_with_discount . ' €';
    }

    public function getProductBrandNameAttribute()
    {
        return $this->productBrand->name;
    }

    public function getProductModelsFlavorsCountAttribute()
    {
        return count($this->productModelsFlavors);
    }

    public function getPriceGetterAttribute()
    {
        return $this->price ? $this->price . ' €' : null;
    }

    public function getPriceBackpackAttribute()
    {
        return !empty($this->price) ? $this->price . '€' : $this->price;
    }

    public function getSizeGetterAttribute()
    {
        return $this->size ? $this->size . ' mm' : null;
    }

    public function getPowerRangeGetterAttribute()
    {
        return $this->power_range ? $this->power_range . ' W' : null;
    }

    public function getInputVoltageGetterAttribute()
    {
        return $this->input_voltage ? $this->input_voltage . ' V' : null;
    }

    public function getBatteryCapacityGetterAttribute()
    {
        return $this->battery_capacity ? $this->battery_capacity . ' mAh' : null;
    }

    public function getELiquidCapacityGetterAttribute()
    {
        return $this->e_liquid_capacity ? $this->e_liquid_capacity . ' ml' : null;
    }

    public function getConcentrationGetterAttribute()
    {
        return $this->concentration ? $this->concentration . ' mg/ml' : null;
    }

    public function getResistanceGetterAttribute()
    {
        return $this->resistance ? $this->resistance . ' Ω' : null;
    }

    public function getAbsorbableQuantityGetterAttribute()
    {
        return $this->absorbable_quantity ? $this->absorbable_quantity . ' Puffs' : null;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setReferenceAttribute($value)
    {
        if (is_null($value)) {
            $products = ProductModel::get();
            $product = $products->orderBy('reference', 'desc')->first();
            if (is_null($product)) {
                $this->attributes['reference'] = Carbon::now()->format('Y') . '10000';
            } else {
                $this->attributes['reference'] = $product->reference++;
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
            $image = Image::make($value)->encode('png', 90);
            $filename = md5($value . time()) . '-' . $attribute_name . '.png';
            Storage::disk($disk)->put($destination_path . $filename, $image->stream());
            $this->attributes[$attribute_name] = $destination_path_db . $filename;
        } else {
            $this->attributes[$attribute_name] = $value;
        }
    }
}
