<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductMetadata;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $attributes = [
            'name' => $this->faker->unique()->sentence(2),
            'brand' => $this->faker->word,
            'price' => $this->faker->numberBetween(500, 2500),
            'image' => $this->faker->imageUrl(800, 600),
            'rating' => $this->faker->randomFloat(1, 1, 5),
        ];
    
        $product = Product::create($attributes);
    
        $hasColors = $this->faker->boolean(40);
    
        if ($hasColors) {
            $colorCount = $this->faker->numberBetween(1, 5);
    
            for ($i = 0; $i < $colorCount; $i++) {
                $colorAttributes = [
                    'name' => $this->faker->colorName,
                    'image' => $this->faker->imageUrl(),
                    'bgColor' => $this->faker->hexcolor,
                ];
    
                // Create and associate color with the product in the product_metadata table
                $productMetadata = new ProductMetadata($colorAttributes);
                $product->metadata()->save($productMetadata);
            }
        }
    
        return $attributes;
    }

}
