<!doctype html>
<html lang="en">

    <head>
        <title>RPI Inventory</title>

        <meta charset="utf-8" />
        <meta name="google" value="notranslate">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/png" href="img/favicon.ico" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}"/>
    </head>

    <body>
        <div id="app">
            <app>
                <div class="loading-placeholder-wrapper">
                    <div class="loading-placeholder-inner-wrapper">
                        <span class="loading-placeholder">Loading...</span>
                    </div>
                </div>
            </app>
        </div>

        <script src="{{ mix('main.js') }}"></script>

    </body>

</html>
