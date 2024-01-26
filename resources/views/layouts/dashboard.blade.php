<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/custom/img/logo-tab.png')}}">
    @include('backend.components.css')
    @yield('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
{{--@guest()--}}
{{--        <script>window.location = "/login";</script>--}}
{{--@endguest--}}

@auth()
    <!-- Navbar -->
    @include('backend.components.navbar')
    <!-- /.navbar -->

        <!-- Main Sidebar Container -->
    @include('backend.components.sidebar')
    @include('backend.components.flash_message')

    <!-- Content Wrapper. Contains page content -->
        @yield('dashboard')

        @include('backend.components.footer')

        @include('backend.components.modals')
@else
    <script>window.location = "/login";</script>
@endif

</div>
<!-- ./wrapper -->
@include('backend.components.js')
@yield('js')
{{--<script async src="https://cse.google.com/cse.js?cx=9b37933fc23c511ff"></script>--}}
{{--<div style="width: 500px; float: right" >--}}
{{--        <div class="gcse-search"></div>--}}
{{--    <div class="gcse-search" data-image_as_oq="term2"></div>--}}
{{--        <div class="gcse-searchbox"></div>--}}
{{--        <div class="gcse-searchbox-only"></div>--}}
{{--        <div class="gcse-searchresults-only"></div>--}}
{{--</div>--}}
</body>
</html>
