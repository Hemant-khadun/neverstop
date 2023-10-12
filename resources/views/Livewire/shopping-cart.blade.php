<div x-data="{ isCartOpen: false }" class="cursor-pointer">
    <div @click="isCartOpen = !isCartOpen" id="cart-wrapper">
            
        <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path class="dark:fill-white" fill-rule="evenodd" clip-rule="evenodd" d="M16.9303 7C16.9621 6.92913 16.977 6.85189 16.9739 6.77432H17C16.8882 4.10591 14.6849 2 12.0049 2C9.325 2 7.12172 4.10591 7.00989 6.77432C6.9967 6.84898 6.9967 6.92535 7.00989 7H6.93171C5.65022 7 4.28034 7.84597 3.88264 10.1201L3.1049 16.3147C2.46858 20.8629 4.81062 22 7.86853 22H16.1585C19.2075 22 21.4789 20.3535 20.9133 16.3147L20.1444 10.1201C19.676 7.90964 18.3503 7 17.0865 7H16.9303ZM15.4932 7C15.4654 6.92794 15.4506 6.85153 15.4497 6.77432C15.4497 4.85682 13.8899 3.30238 11.9657 3.30238C10.0416 3.30238 8.48184 4.85682 8.48184 6.77432C8.49502 6.84898 8.49502 6.92535 8.48184 7H15.4932ZM9.097 12.1486C8.60889 12.1486 8.21321 11.7413 8.21321 11.2389C8.21321 10.7366 8.60889 10.3293 9.097 10.3293C9.5851 10.3293 9.98079 10.7366 9.98079 11.2389C9.98079 11.7413 9.5851 12.1486 9.097 12.1486ZM14.002 11.2389C14.002 11.7413 14.3977 12.1486 14.8858 12.1486C15.3739 12.1486 15.7696 11.7413 15.7696 11.2389C15.7696 10.7366 15.3739 10.3293 14.8858 10.3293C14.3977 10.3293 14.002 10.7366 14.002 11.2389Z" fill="#200E32" />
        </svg>

        <span class="flex absolute -mt-6 ml-4">
            <span class="animate-ping absolute inline-flex h-4 w-4 rounded-full bg-pink-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-pink-500 justify-center">
                <span class="text-white font-bold text-xs text-center">{{ $cartCount }}</span>
            </span>
        </span>

    </div>

    <div x-cloak :class="isCartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="z-10 drop-down w-auto overflow-hiddenrounded-md shadow fixed top-20 right-0 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">

        <div class="h-screen bg-gray-100 p-8 z-10">
            
            <div @click="isCartOpen = false"  class="flex items-center text-gray-500 hover:text-gray-600 dark:text-white cursor-pointer" onclick="checkoutHandler(false)">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left text-gray-500" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <polyline points="15 6 9 12 15 18"></polyline>
                </svg>
                <p class="text-sm pl-2 leading-none text-gray-500 dark:hover:text-gray-600">Back</p>
            </div>

            <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
            
            <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                <div class="rounded-lg md:w-2/3">
                    @unless($cartItems->count())
                    <div class="mb-6 mx-auto text-center">
                        <x-heroicon-o-shopping-cart class="mx-auto h-24 w-24 text-slate-400" />
    
                        <h3 class="mt-2 text-lg font-medium text-slate-900 dark:text-slate-600">
                            {{ __('Your shopping cart is currently empty') }}
                        </h3>
    
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Before proceed to checkout you must add some products to your shopping cart.') }}
                        </p>
    
                        <div class="mt-6">
                            <a @click="isCartOpen = false"
                                href="#"
                                class="btn btn-primary"
                            >
                                {{ __('Continue shopping') }}
                            </a>
                        </div>
                    </div>
                @else
                
                @foreach($cartItems as $index => $item)

                    <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                        @if($item->variant->hasMedia('image'))
                            {{ $item->variant->getFirstMedia('image')('thumb_large')->attributes(['alt' => $item->product->name, 'class' => 'h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32']) }}
                        @elseif($item->product->hasMedia('gallery'))
                            {{ $item->product->getFirstMedia('gallery')('thumb_large')->attributes(['alt' => $item->product->name, 'class' => 'h-24 w-24 rounded-md object-cover object-center sm:h-32 sm:w-32']) }}
                        @else
                            <div class="relative h-24 w-24 rounded-md bg-slate-100 sm:h-24 sm:w-24">
                                <x-heroicon-o-camera class="h-full w-16 absolute inset-0 mx-auto text-slate-400 sm:h-auto sm:w-auto" />
                            </div>
                        @endif
                        {{-- <img src="{{ $item['image'] }}" alt="product-image" class="w-full rounded-lg sm:w-40" /> --}}
                        <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                            <div class="mt-5 sm:mt-0">
                                <h2 class="text-lg font-bold text-gray-900">{{ $item->product->name }}</h2>
                                <p class="mt-1 text-xs text-gray-700">36EU - 4US</p>
                            </div>
                            <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                <div class="flex items-center border-gray-100">
                                    <span class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50" wire:click="updateCartItemQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"> - </span>
                                    <input
                                        wire:change="updateCartItemQuantity({{ $item->id }}, $event.target.value)"
                                        type="text"
                                        name="quantity"
                                        wire:model="$item.quantity"
                                        value="{{ $item->quantity }}"
                                        id="quantity"
                                        class="h-8 w-8 py-1.5 border bg-white text-center text-xs outline-none border-none"
                                />
                                    <span class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50" wire:click="updateCartItemQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"> + </span>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <p class="text-sm">${{ $item->price }} USD</p>
                                    <svg wire:click.prevent="removeCartItem({{ $item->id }})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                    {{-- <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        <div class="mb-2 flex justify-between">
                        <p class="text-gray-700">Subtotal</p>
                        <p class="text-gray-700">${{ $cart->subtotal }}  USD</p>
                        </div>
                        <div class="flex justify-between">
                        <p class="text-gray-700">Shipping</p>
                        <p class="text-gray-700">Free</p>
                        </div>
                        <hr class="my-4" />
                        <div class="flex justify-between">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold">
                                ${{ $cart->subtotal }}  USD</p>
                            <p class="text-sm text-gray-700">including VAT</p>
                        </div>
                        </div>
                        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button>
                    </div> --}}
                    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        <div class="mb-2 flex justify-between">
                          <p class="text-gray-700">Subtotal</p>
                          <p class="text-gray-700">$129.99</p>
                        </div>
                        <div class="flex justify-between">
                          <p class="text-gray-700">Shipping</p>
                          <p class="text-gray-700">$4.99</p>
                        </div>
                        <hr class="my-4" />
                        <div class="flex justify-between">
                          <p class="text-lg font-bold">Total</p>
                          <div class="">
                            <p class="mb-1 text-lg font-bold">$134.98 USD</p>
                            <p class="text-sm text-gray-700">including VAT</p>
                          </div>
                        </div>
                        <button class="mt-6 w-full rounded-md bg-blue-500 py-1.5 font-medium text-blue-50 hover:bg-blue-600">Check out</button>
                      </div>
                @endif

                </div>
            
            </div>
        </div>
    </div>
</div>


