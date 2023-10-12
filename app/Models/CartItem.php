<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'variant_id', 'quantity'];

    protected $casts = [
        'quantity' => 'integer',
    ];

    // protected $with = ['discount'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function getNameAttribute()
    {
        return $this->product->name;
    }

    public function getPriceAttribute()
    {
        return $this->variant->price;
    }

    public function getSubtotalAttribute()
    {
        return $this->variant->price * $this->quantity;
    }
   
}
