<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Bookmarks')</title>
    <meta name="keywords" content="@yield('title', 'Bookmarks')" />
    <meta name="description" content="@yield('title', 'Bookmarks')" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  </head>
  <body>

    <div class="container">
        <div class="row">
            <div class="col-12 py-4">

                @yield('content')

            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
  </body>
