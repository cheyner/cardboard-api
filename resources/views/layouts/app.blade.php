<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="{{config('app.url')}}" />

    <title>{{config('app.name')}}</title>

    @vite('resources/css/app.css')

</head>
    <body class="bg-white text-slate-900 min-h-screen w-screen antialiased flex">
        <main>
            @yield('content')
        </main>
    </body>
</html>
