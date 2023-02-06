<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ config('app.url') }}">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>{{ getSysInfo()->nama }} - @yield ('pagetitle')</title>

    <link rel="shortcut icon" href="{{ config('app.url') . '/storage/' . getSysInfo()->logo }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    @yield('stylesheets')
    <link class="js-stylesheet" href="{{ asset('/user/css/light.css') }}" rel="stylesheet">

</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        @include('layouts.user.sidebar')
        <div class="main">
            @include('layouts.user.header')

            <main class="content">
                <div class="container-fluid p-0">
                @yield('content')
                </div>
            </main>

            @include('layouts.user.footer')
        </div>
    </div>

    <script src="{{ asset('/user/js/app.js') }}"></script>
    @yield('scripts')

</body>

</html>
