<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }} - Step into Luxury</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
    @stack('scripts')

    @livewireScripts

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- component -->
    <header class="dark:dark:bg-slate-900 w-full">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global"
            x-data="{ mobileMenuOpen: false, searchOpen: false }"
            x-on:keydown.window.esc="mobileMenuOpen = false">
                
            <div class="flex lg:flex-1">
            <a href="/" class="-m-1.5 p-1.5">
                <img class="brightness-0 w-16 dark:brightness-100 hover:scale-125 hover:rotate-[-15deg] transition-transform duration-700" src="{{ asset('images/istro-header-logo.svg') }}" alt="Istro Logo" >
            </a>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <ul id="drawer" role="menu" class="sm:gap-3 transition-left ease-[cubic-bezier(0.4, 0.0, 0.2, 1)] delay-150  sm:flex  flex flex-col cursor-pointer absolute min-h-screen -left-48 sm:static w-48 top-0 bg-white sm:shadow-none shadow-xl sm:bg-transparent sm:flex-row sm:w-auto sm:min-h-0 dark:bg-slate-900  ">
                  
                    <li class="font-extrabold text-sm p-3 hover:bg-slate-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-primary">
                        <a href="#" class="dark:text-white dark:hover:border-white  hover:border-black  border-b-2 border-transparent transition duration-300">Men</a>
                    </li>
                    <li class="font-extrabold text-sm p-3 cursor-pointer dark:hover:border-white  hover:border-black border-b-2 border-transparent duration-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-gray-600 hover:text-primary transition-colors">
                        <a href="#" class="dark:text-white dark:hover:border-b">Women</a>
                    </li>
                    <li class="font-extrabold text-sm p-3 cursor-pointer dark:hover:border-white  hover:border-black border-b-2 border-transparent transition duration-300 dark:hover:bg-slate-800 sm:p-0 sm:hover:bg-transparent text-gray-600 hover:text-primary transition-colors">
                        <a href="#" class="dark:text-white dark:hover:border-b">Kids</a>
                    </li>
                </ul>
            </div>
            <div class="lg:flex lg:flex-1 lg:justify-end">
            
                <div class="flex gap-3 items-center">

                    <div class="flex lg:ml-6 ">
                        <button
                            x-on:click="$dispatch('open-search')"
                            class="p-2 text-slate-400 hover:text-slate-500 z-10"
                        >
                            <span class="sr-only">Search</span>
                            <x-heroicon-o-magnifying-glass class="h-6 w-6" />
                        </button>
                    </div>

                    @livewire('shopping-cart')

                    <div x-data="{ isAccountMenuOpen: false }">
                        <div @click="isAccountMenuOpen = !isAccountMenuOpen" class="user-icon h-8 w-8 hover:ring-4 user cursor-pointer relative ring-blue-700/30 rounded-full bg-contain bg-no-repeat bg-center " style="background-image:url('{{ asset('images/assets/account-logo-neverstop.png') }}')" >

                            <div x-cloak :class="isAccountMenuOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'" class="z-10 drop-down w-48 overflow-hidden rounded-md shadow top-20 right-0 fixed max-w-xs transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300">
                                <ul>
                                    <li @click="isAccountMenuOpen = !isAccountMenuOpen" class="px-3 py-3 text-sm font-medium flex items-center space-x-2 hover:bg-blue-400 hover:text-cyan-50">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </span>
                                        <span> Setting </span>
                                    </li>
                                    <li @click="isAccountMenuOpen = !isAccountMenuOpen" class="px-3  py-3  text-sm font-medium flex items-center space-x-2 hover:bg-blue-400 hover:text-cyan-50">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </span>
                                        <span> Wishlist </span>
                                    </li>
                                    <li @click="submitLogoutForm()" class="px-3  py-3 text-sm font-medium flex items-center space-x-2 hover:bg-blue-400 hover:text-cyan-50">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </span>
                                        <span> Logout </span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="sm:hidden cursor-pointer" id="mobile-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path class="dark:stroke-white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</head>