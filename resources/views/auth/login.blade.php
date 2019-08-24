@extends('layouts.blank')

@section('admin.title')
    Login
@stop


@section('main_content')
    <!-- Login Full Background -->
    <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
    <img src="{{ asset('assets/img/placeholders/backgrounds/login_full_bg.jpg') }}" alt="Login Full Background"
         class="full-bg animation-pulseSlow">
    <!-- END Login Full Background -->

    <!-- Login Container -->
    <div id="login-container" class="animation-fadeIn">
        <!-- Login Title -->
        <div class="login-title text-center">
            <h1><i class="gi gi-flash"></i> <strong>Sunamganj College</strong><br>
                <small>Please <strong>Login</strong></small>
            </h1>
        </div>
        <!-- END Login Title -->

        <!-- Login Block -->
        <div class="block push-bit">

            @include('layouts.partials.session-msg')

            @include('auth.login-form')

            @include('auth.forgotpassword')
        </div>
        <!-- END Login Block -->
    </div>
    <!-- END Login Container -->

@stop


@push('footer_js')
    <script src="{{ asset('assets/js/pages/login.js') }}"></script>
    <script>$(function(){ Login.init(); });</script>

@endpush
