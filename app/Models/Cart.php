<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Casts\AsArrayObject;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'customer_email',
        'shipping_method',
        'payment_method',
        'notes',
        'meta',
    ];

    protected $casts = [
        'meta' => AsArrayObject::class,
        'subtotal' => 'float',
        'total' => 'float',
        'isDigitalOnly' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function billingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('is_billing', true);
    }

    public function shippingAddress()
    {
        return $this->morphOne(Address::class, 'addressable')->where('is_billing', false);
    }

    protected function isDigitalOnly()
    {
        return new Attribute(
            get: fn() => $this->items->where('product.is_physical', false)->count() >= 1
        );
    }

    protected function weight()
    {
        return new Attribute(
            get: fn() => $this->items->reduce(function ($value, $item) {
                $itemWeight = $item->variant->weight_unit == 'g' ? $item->variant->weight_value * 1000 : $item->variant->weight_value;

                return $value + $itemWeight;
            }, 0)
        );
    }

    protected function subtotal()
    {
        return new Attribute(
            get: fn() => $this->items->reduce(function ($value, $item) {
                return $value + $item->subtotal;
            }, 0)
        );
    }

    protected function total()
    {
        return new Attribute(
            get: fn() => $this->subtotal + $this->shippingMethod?->price ?? 0
        );
    }

    protected static function booted()
    {
        static::creating(function ($cart) {
            if ($cart->meta === null) {
                $cart->meta = [];
            }
        });
    }
}
