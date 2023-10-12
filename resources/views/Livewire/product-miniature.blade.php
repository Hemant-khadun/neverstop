<article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-lg hover:shadow-sky-700 hover:transform hover:scale-105 duration-300">
    <a href="#">
        <div class="relative flex items-end overflow-hidden rounded-xl max-h-96 min-h-96">
            <img id="productImage" src="{{ asset('images/products/' . $product->image) }}" alt="Product Image" class="transition-opacity duration-300 ease-in-out">
        </div>

        <div class="mt-1 p-2">
            <h2 class="text-slate-700 truncate">{{ $product->name }}</h2>
            <p class="mt-1 text-sm text-slate-400">{{ $product->brand }}</p>

            @if ($product->metadata->count() > 0)
                <div class="mt-3">
                    <label class="text-gray-700 text-sm font-medium" for="count">Color:</label>
                    <div class="colorButtonsWrapper flex items-center rounded-lg px-4 py-1.5 text-white duration-100">
                        <ul class="flex flex-row justify-center items-center max-w-full">
                    
                            @foreach ($product->metadata as $color)
                                @if (is_array($color) || is_object($color))
                                    <li class="mr-4 last:mr-0">
                                        <span class="block p-1 border-2 border-white hover:border-gray-500 rounded-full transition ease-in duration-300" data-image-url="{{ $color->image }}">
                                            <div href="#{{ $color->image }}" class="block w-6 h-6 bg-{{ $color->bgColor }}-500 rounded-full" ></div>
                                        </span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="mt-3 flex items-end justify-between" >
                <p class="text-lg font-bold text-blue-500">${{ $product->price }}</p>
                <div class="flex items-center space-x-1.5 rounded-lg bg-blue-500 px-4 py-1.5 text-white duration-100 hover:bg-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                    </svg>
                   
                    <button wire:click="addToCart({{ $product->id }})" wire:loading.class="disabled" class="text-sm" @disabled($product->stock < 1)> {{ $product->stock >= 1 ? 'Add to cart' : 'Sold out' }}</button>
                </div>
            </div>
        </div>
    </a>
</article>
