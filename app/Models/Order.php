<?php

namespace App\Models;

use App\Services\BotService;
use Illuminate\Database\Eloquent\Model;
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
        'chat_id',
        'reference',
        'name',
        'surnames',
        'address',
        'postal_code',
        'city',
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

    public function bot()
    {
        $botService = new BotService();
        return $botService->getById($this->telegraphChat->bot->id);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function customer()
    {
        return $this->hasOne(Customer::class, 'chat_id', 'chat_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function telegraphChat()
    {
        return $this->hasOne(BotChat::class, 'chat_id', 'chat_id');
    }

    public function orderHistoryStates()
    {
        return $this->hasMany(OrderHistoryState::class, 'order_id', 'id')
            ->orderBy('id', 'desc');
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
