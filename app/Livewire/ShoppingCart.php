<?php

namespace App\Livewire;

use \Livewire\Component;
use \App\Models\Product;
use App\Models\Cart;

class ShoppingCart extends Component
{
    public $cartCount = 0;

    public $quantity = 0;

    protected $listeners = [
        'refresh' => '$refresh',
    ];
    
    public function mount()
    {
        $this->cartCount = $this->cart->items->reduce(function ($carry, $item) {
            return $carry + $item->quantity;
        }, 0);
    }
    
    public function refresh()
    {
        $this->cartCount = $this->cart->items->reduce(function ($carry, $item) {
            return $carry + $item->quantity;
        }, 0);
    }

    public function updateCartItemQuantity($cartItemId, $quantity)
    {
        if ($quantity < 1) {
            return $this->addError('cartItems.' . $cartItemId . '.quantity', __('Quantity must be at least 1'));
        }

        $this->cartItems->find($cartItemId)->update(['quantity' => $quantity]);

        $this->dispatch('refresh')->self();
    }

    public function removeFromCart($cartItemId)
    {
        $this->cartItems->find($cartItemId)->delete();

        $this->dispatch('refresh')->self();
    }

    public function getCustomerProperty()
    {
        return \Auth::user();
    }

    public function getCartProperty()
    {
        $cart = $this->customer
            ? Cart::query()->firstOrCreate(['user_id' => $this->customer->id])
            : Cart::query()->firstOrCreate(['session_id' => session()->getId()]);

        $cart->load([
            'items.product.media',
            'items.variant.media',
            'items.variant.variantAttributes.option',
            'items.variant.variantAttributes.optionValue',
        ]);

        return $cart;
    }

    public function getCartItemsProperty()
    {
        return $this->cart->items;
    }

    public function render()
    {
        return view('livewire.shopping-cart', [
            'cart' => $this->cart,
            'cartItems' => $this->cartItems,
        ]);
    }
 
}


