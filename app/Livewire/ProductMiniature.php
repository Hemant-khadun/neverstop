<?php

namespace App\Livewire;

use \Livewire\Component;
use \App\Models\Cart;
use \App\Models\Product;
use App\Models\Variant;
use \App\Models\User;

class ProductMiniature extends Component
{
    public $quantity = 1;

    public Product $product;

    public Variant $variant;

    public int $minQuantity = 1;

    public int $maxQuantity = 1;

    public array $selectedOptionValues;

    public array $addToCartItems = [
        'product' => null,
        'variant' => null,
        'quantity' => 1,
    ];

    public string $variantQuery = '';

    protected $queryString = ['variantQuery' => ['except' => '', 'as' => 'variant']];

    public function mount()
    {
        $this->product
            ->load([
                'media',
                // 'reviews' => fn($query) => $query->whereNotNull('published_at'),
                // 'reviews.customer.media',
                // 'specifications',
            ])
            ->loadCount([
                'media'
            ]);

        // abort_unless(, 404);
        
        // abort_unless($this->productVariants->count(), 500);
        if($this->product->is_active){

            if ($this->productVariants->count() > 1) {
                if ($this->variantQuery != '') {
                    $variant = $this->productVariants->where('id', $this->variantQuery)->first();
                    if ($variant) {
                        $this->variant = $variant;
                    } else {
                        return redirect()->route('guest.products.show', $this->product);
                    }
                } else {
                    $this->variant = $this->productVariants->first();
                }
                $this->variantQuery = $this->variant->id;
            } else {
                $this->variant = $this->productVariants->first();
            }

            $this->addToCartItems['product'] = $this->product->id;

            $this->addToCartItems['variant'] = $this->variant->id;

            $this->maxQuantity = $this->variant->stock_value > 0 ? $this->variant->stock_value : $this->maxQuantity;

            $this->selectedOptionValues = $this->variant->variantAttributes->pluck('option_value_id')->toArray();
        }

    }

    public function getProductVariantsProperty()
    {
        $this->product->load('variants.variantAttributes');

        return $this->product->variants;
    }

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        $this->cart->items()->updateOrCreate([
            'product_id' => $this->addToCartItems['product'],
            'variant_id' => $this->addToCartItems['variant'],
        ], [
            'quantity' => 1,
        ]);

        $this->dispatch('refresh-component', 'livewire.components.header');

        $this->dispatch('show-component', 'livewire.components.shopping-cart');
    }

    public function getCustomerProperty()
    {
        return \Auth::user();
    }

    public function getCartProperty()
    {
        return $this->customer
            ? Cart::query()->firstOrCreate(['user_id' => $this->customer->id])
            : Cart::query()->firstOrCreate(['session_id' => session()->getId()]);
    }
    
    public function render()
    {
        return view('livewire.product-miniature');
    }

}
