<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dev[Geek] | {{ $title ??  '' }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Battambang:wght@400;700&family=Nunito:wght@300;400&family=Poppins:wght@200;300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <style>
        body {
            font-family: "Source Sans Pro", System-ui,-apple-system, "Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans","Liberation Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        }
    </style>
    @stack('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    @if($spinLogo)
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('img/logo_no_bg.png') }}" alt="Dev Geek Logo" height="auto" width="150">
    </div>
    @endif

    <!-- Navbar -->
    <x-inc.navbar/>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <x-inc.logo/>

        <!-- Sidebar -->
        <div class="sidebar font-weight-normal">
            <!-- Sidebar user panel (optional) -->
            <x-inc.auth/>

            <!-- Sidebar Menu -->
            <x-inc.sidebar activeRoute="{{ $activeRoute }}"/>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{ $header }}
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                {{ $slot }}
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <x-inc.footer/>
</div>
<!-- ./wrapper -->
@livewireScripts
<script src="{{ asset('js/all.js') }}"></script>
@stack('script')
</body>
</html>
