<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        @vite('resources/css/app.css')
        @vite('resources/sass/app.scss')
    </head>
    <body>
        <div id="app"></div>
        <div id="portaler">
        </div>
        @vite('resources/js/app.js')
    </body>
</html>
