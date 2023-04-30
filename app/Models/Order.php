<?php

namespace App\Models;

use App\Models\TelegraphChat;
use App\Exceptions\GenericException;
use Illuminate\Database\Eloquent\Model;
use App\Prepares\Payment\PayPalAccountPrepare;
use App\Prepares\Payment\StripeAccountPrepare;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Order extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'orders';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'payment_platform_key_id',
        'chat_id',
        'reference',
        'name',
        'surnames',
        'address',
        'postal_code',
        'city',
        'province',
        'country',
        'payment_method',
        'status',
        'price',
        'total_price',
        'shipping_price',
        'stripe_id',
        'paypal_id',
        'provider_url',
        'order_cancel_detail',
        'payment_id'
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function telegraphBot()
    {
        return $this->telegraphChat->bot;
    }

    public function paymentAPICredentials()
    {
        switch ($this->payment_method) {
            case 'paypal':
                return (new PayPalAccountPrepare($this->payment_platform_key_id))->run();
            case 'stripe':
                return (new StripeAccountPrepare($this->payment_platform_key_id))->run();
            default:
                throw new GenericException('Método de pago no soportado');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function telegraphChat()
    {
        return $this->hasOne(TelegraphChat::class, 'chat_id', 'chat_id');
    }

    public function orderHistoryStates()
    {
        return $this->hasMany(OrderHistoryState::class, 'order_id', 'id')
            ->orderBy('id', 'desc');
    }

    public function paymentPlatformKey()
    {
        return $this->belongsTo(PaymentPlatformKey::class, 'payment_platform_key_id', 'id');
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

    public function getCountProductsAttribute()
    {
        return count($this->orderProducts);
    }

    public function getPriceBackpackAttribute()
    {
        return !empty($this->price) ? $this->price . '€' : $this->price;
    }

    public function getTotalPriceBackpackAttribute()
    {
        return !empty($this->total_price) ? $this->total_price . '€' : $this->total_price;
    }

    public function getShippingPriceBackpackAttribute()
    {
        return !empty($this->shipping_price) ? $this->shipping_price . '€' : $this->shipping_price;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
