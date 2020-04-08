<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="/css/app.css" rel="stylesheet">        
        <script src="/js/app.js" charset="UTF-8"></script>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>