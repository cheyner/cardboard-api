<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{config('app.url')}}" />

    <title>{{config('app.name')}} | Magic Prices API</title>

    @vite('resources/css/app.css')

</head>
    <body class="text-slate-900 min-h-screen w-screen antialiased bg-gradient-to-br from-slate-900 to-slate-600">
        <main class="min-h-screen w-screen flex flex-col gap-4 justify-center items-center max-w-5xl mx-auto">
            <h1 class="text-white font-bold text-7xl">Magic Prices API</h1>
            <p class="text-white">Cardboard is a REST API for fetching pricing data for Magic: The Gathering cards</p>
            <a href="{{route('docs')}}" class="bg-white px-2 py-1 rounded shadow">Show Me The Docs</a>
        </main>
    </body>
</html>
