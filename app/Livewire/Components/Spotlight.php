<?php

namespace App\Livewire\Components;

use \Livewire\Component;
use \App\Models\Product;

class Spotlight extends Component
{
    public bool $searchFromAdmin = false;

    public string $query = '';

    public function mount()
    {
        // $this->searchFromAdmin = request()->routeIs('employee.*');
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getProductsProperty()
    {
        $products = [];

        if ($this->query) {
            $products = Product::query()
                ->select('id', 'name', 'slug', 'price')
                ->with('media')
                ->where('name', 'like', "%{$this->query}%");

            $products = $products->get();
        }

        return $products;
    }

    public function render()
    {
        return view('livewire.components.spotlight', [
            'products' => $this->products,
        ]);
    }
}

