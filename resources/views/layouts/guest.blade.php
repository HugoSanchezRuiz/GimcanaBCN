<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
        <!-- Enlace Iconos FontAwesome-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">    
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <!-- Scripts -->
        <script src="{{asset('js/script.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        @vite(['resources/css/style.css'])
    </head>
    <body>
            <div>
                {{ $slot }}
            </div>
    </body>
</html>
