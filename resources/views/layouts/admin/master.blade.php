<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- APP Url -->
    <meta name="app-url" content="{{ config('app.url') }}">
    <title>{{ getSysInfo()->nama }} Administration - @yield ('pagetitle')</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Styles -->
    @yield('stylesheets')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/admin/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm ">

    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')

    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

        @include('layouts.admin.breadcrumb')
            @yield('content')

        </div>
        <!-- /.content-wrapper -->
        @include('layouts.admin.footer')
        <!-- ./wrapper -->

        @yield('modals')
    </div>
    <!-- jQuery -->
    <script src="{{ asset('/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    
    <script src="{{ asset('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    
    <script src="{{ asset('/admin/js/adminlte.js') }}"></script>
    <script src="{{ asset('/admin/plugins/select2/js/select2.full.min.js') }}"></script>

    @yield('scripts')

    <script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4'
        });
    });
    </script>
    <!-- AdminLTE App -->
    <!-- AdminLTE for demo purposes -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

</body>

</html>
