<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth" style="scroll-padding-top: 4rem;">
    <head>
        @include('partials.head')
    </head>
    <body class="bg-amber-50">

        <x-navbar :active="$active ?? null" />

        {{ $slot }}

        <x-footer />

        <x-whatsapp-floating :phone="$whatsappPhone ?? '6281353652777'" :label="$whatsappLabel ?? 'Call Center Masjid'" />

        @fluxScripts
    </body>
</html>
