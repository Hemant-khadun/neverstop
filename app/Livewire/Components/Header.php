<?php

namespace App\Http\Livewire\Guest\Components;

use App\Models\Cart;
use Livewire\Component;

class Header extends Component
{
    public $itemsCount = 0;

    protected $listeners = ['refresh'];

    public function mount()
    {
        $this->itemsCount = $this->cart->items_sum_quantity ?? 0;
    }

    public function refresh()
    {
        $this->itemsCount = $this->cart->items_sum_quantity ?? 0;
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

        $cart->loadSum('items', 'quantity');

        return $cart;
    }

    public function render()
    {
        return view('livewire.components.header');
    }
}
