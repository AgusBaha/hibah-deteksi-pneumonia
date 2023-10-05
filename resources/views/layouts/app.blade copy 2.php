<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>
    @stack('styles')
</head>

<body>

    {{-- @include('components.navbar') --}}

    <x-navbar/>
    {{ $slot }}

    @stack('scripts')
</body>

</html>
