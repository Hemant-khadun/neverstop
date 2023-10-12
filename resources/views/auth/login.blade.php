@extends('layouts.app')

@section('content')

<!-- component -->
<div class="flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('{{ asset('images/assets/login-background-neverstop.jpg')}}')">
    <div class="rounded-xl bg-gray-800 bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
        <div class="text-white">
        <div class="mb-8 flex flex-col items-center">
            <img src="{{ asset('images/istro-header-logo.svg') }}" width="150" alt="" srcset="" />
            <h1 class="mb-2 text-2xl">Never Stop</h1>
            <span class="text-gray-300">Connect to your account</span>
        </div>
        <form action="{{ route('authenticate') }}" method="post">
            @csrf   
            <div class="mb-4 text-lg flex flex-col">
                <input class="rounded-3xl border-none bg-cyan-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md" type="text" placeholder="id@email.com" @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="mb-4 text-lg flex flex-col">
                <input class="rounded-3xl border-none bg-cyan-400 bg-opacity-50 px-6 py-2 text-center text-inherit placeholder-slate-200 shadow-lg outline-none backdrop-blur-md" type="Password"  placeholder="*********" @error('password') is-invalid @enderror" id="password" name="password" />
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mt-8 flex justify-center text-lg text-black">
            <button type="submit" class="rounded-3xl bg-cyan-400 bg-opacity-50 px-10 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-cyan-600">Login</button>
            </div>
        </form>
        </div>
    </div>
</div>


    
@endsection