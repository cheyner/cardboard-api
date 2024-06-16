<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="{{config('app.subslogan')}}"/>
    <meta name="keywords" content="magic,api,price" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{config('app.url')}}" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <title>{{config('app.name')}} | Magic Prices API</title>

    @vite('resources/css/app.css')

</head>
    <body class="bg-white text-slate-900 min-h-screen w-screen antialiased flex">
        <main>
            @yield('content')
        </main>
    </body>
</html>
