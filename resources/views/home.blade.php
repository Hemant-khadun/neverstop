@extends('layouts.app')

@section('content')

    <div class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots dark:bg-gray-900 selection:bg-indigo-500 selection:text-white">
        
        <!-- @if (Route::has('login'))
            <div class="p-6 text-right sm:fixed sm:top-0 sm:right-0">
                @auth
                    <a href="{{ route('home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Home</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif -->

       <!-- Product List -->
    <section class="py-10">
    <div class="mx-auto grid max-w-6xl  grid-cols-1 gap-6 p-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 ">

            @foreach ($products as $product)
                @livewire('product-miniature', ['product' => $product], key($product))
            @endforeach

        </section>
    </div>

    @livewire('components.spotlight')
    </div>
@endsection
