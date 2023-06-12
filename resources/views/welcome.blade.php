<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome to Deki Insurance</title>
    </head>
    <body class="antialiased">
    <div id="app" >
        <header-component></header-component>
        <welcome-component></welcome-component>
    </div>
    </body>
<script src="{{ asset('js/app.js') }}"></script>
</html>
