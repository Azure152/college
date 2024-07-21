<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div id="app--wrapper">
            <div id="app__content">
                {{ $slot }}
            </div>
            <div id="app__navegation">
                <x-navegation />
            </div>
        </div>
    </body>
</html>