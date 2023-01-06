<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'order_products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'order_id',
        'product_model_id',
        'product_models_flavor_id',
        'amount',
        'unit_price',
        'total_price',
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

    public function order()
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function productModel()
    {
        return $this->hasOne(ProductModel::class, 'id', 'product_model_id');
    }

    public function productModelsFlavor()
    {
        return $this->hasOne(ProductModelsFlavor::class, 'id', 'product_models_flavor_id');
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

    public function getOrderReferenceAttribute()
    {
        return $this->order->reference;
    }

    public function getUnitPriceBackpackAttribute()
    {
        return !empty($this->unit_price) ? $this->unit_price . '€' : $this->unit_price;
    }

    public function getTotalPriceBackpackAttribute()
    {
        return !empty($this->total_price) ? $this->total_price . '€' : $this->total_price;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
