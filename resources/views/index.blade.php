<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" type="text/css" href="css/app.css">
        <script type="text/javascript" src="js/pace.min.js"></script>
    </head>
    <body>
        <div id="app" class="container">
            <div class="row">
                <tasks class="mt-5"></tasks>
            </div>
        </div>
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>