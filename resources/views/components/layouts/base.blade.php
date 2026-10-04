{{-- Documento HTML comum ao site e ao painel: head, assets e região de toasts (session('status')). --}}
@props(['title' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title ? "{$title} · PHP Piauí" : 'PHP Piauí' }}</title>
        <link rel="icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/svg+xml">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body {{ $attributes }}>
        {{ $slot }}
        <x-toast.region>
            @if (session('status'))
                <x-toast :title="session('status')" />
            @endif
        </x-toast.region>
    </body>
</html>
