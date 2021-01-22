<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.79.0">
        <title>Backend</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{url('backend/css/admin.css')}}">

    </head>

    <body>
        <div id="admin"></div>
    </body>
    <script src="{{url('backend/js/admin.js')}}"></script>
    <script src="{{url('backend/js/admin-chunk-vendors.js')}}"></script>

</html>