<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('livewire.components.header')

<body>

    @yield('body')

</body>

    @include('layouts._partials.footer')

</html>