<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dev[Geek] | {{ __('Lock Screen') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <img src="{{ asset('img/logo_no_bg.png') }}" alt="Dev Geek" width="150px">
    </div>
    <!-- User name -->
    <div class="lockscreen-name">{{ auth()->user()->name }}</div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            {!! Avatar::create(auth()->user()->name)
                    ->setDimension(70, 70)
                    ->setFontSize(22)
                    ->toSvg() !!}
{{--            <img src="../../dist/img/user1-128x128.jpg" alt="User Image">--}}
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form class="lockscreen-credentials" method="POST" action="{{ route('login.unlock') }}">
            @csrf
            <div class="input-group">
                <input type="password" name="password" class="form-control {{ session('error') ? 'is-invalid' : '' }}" placeholder="{{ __('Password') }}" required autofocus>
                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->
    </div>
    @if(session('error'))
    <p class="p-0 text-center text-danger">{{ session()->get('error') }}</p>
    @endif
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
       {{ __('Enter your password to retrieve your session') }}
    </div>
    <div class="text-center">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="nav-link">
            {{ __('Or sign in as a different user') }}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </a>

    </div>
    <div class="lockscreen-footer text-center">
        &copy; 2016-{{ date('Y') }} <b><a href="https://web.facebook.com/devgeek.dev" target="_blank" class="text-black">DevGeek</a></b><br>
        All rights reserved
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
