<?php

namespace App\Models;

use App\Enums\ProductStatus;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $attributes = ['price' => 0];

    protected $casts = [
        'price' => 'float',
        'status' => ProductStatus::class,
        'is_active' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function (Product $product) {
            $variant = new Variant();
            $variant->product_id = $product->id;
            $variant->price = $product->price;
            $variant->save();
        });
    }

    public function metadata()
    {
        return $this->hasMany(ProductMetadata::class);
    }

     public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->useFallbackUrl('/img/placeholder.png')
            ->useFallbackPath(public_path('img/placeholder.png'))
            ->singleFile();

        $this->addMediaCollection('gallery')
            ->useFallbackPath(public_path('img/placeholder.png'))
            ->useFallbackUrl('/img/placeholder.png');
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->performOnCollections('gallery')->width(100)->height(100);
        $this->addMediaConversion('thumb_small')->performOnCollections('gallery')->width(50)->height(50);
        $this->addMediaConversion('thumb_large')->performOnCollections('gallery')->width(200)->height(200);
        $this->addMediaConversion('responsive')->performOnCollections('gallery')->withResponsiveImages();
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function optionValues()
    {
        return $this->hasMany(OptionValue::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function variantAttributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }

    // public function specifications()
    // {
    //     return $this->morphMany(Meta::class, 'metable')->where('key', 'specifications');
    // }
    public function collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', ProductStatus::ACTIVE->name);
    }

    protected function isActive(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['status'] === ProductStatus::ACTIVE->name,
        );
    }

    protected function price(): Attribute
    {
        $thousand_separator = config('money.' . config('app.currency') . '.thousands_separator');

        return Attribute::make(
            set: fn($value) => str_replace($thousand_separator, '', $value)
        );
    }



}

