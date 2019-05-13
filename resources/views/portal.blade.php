<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'AftermarketData.com | Automotive Parts Management, ACES PIES Mapping') }}</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('frontend/css/app.css') }}">
    </head>
    <body>
        <div id="app"></div>
        <script src="{{ asset('frontend/js/app.js') }}"></script>
    </body>
</html>
</html>
