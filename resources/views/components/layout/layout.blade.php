<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-foreground">
<x-layout.nav></x-layout.nav>
<main class="max-w-7xl mx-auto px-6 pb-10">
    {{ $slot }}
</main>

@session('success')
    <x-toast>
        {{$value}}
    </x-toast>
@endsession
</body>
</html>
