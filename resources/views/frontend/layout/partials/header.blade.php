<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- SEO -->
    <meta name="author" content="Kapil">
    <meta name="description" content="Sunamganj College.">
    <meta name="keywords" content="gather, responsive, event, meetup, template, conference, gather, rsvp, download">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/website/images/favicon.ico') }}">

    <title>@yield('title', 'Sunamganj College') - {{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/website/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Google Font : Open Sans & Montserrat -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    @stack('header_top_css')

    <!-- Plugins -->
    <link href="{{ asset('assets/website/css/plugins/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/plugins/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/plugins/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/plugins/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/website/css/plugins/streamline-icons.css') }}" rel="stylesheet">

    <!-- Event Style -->
    <link href="{{ asset('assets/website/css/event.css') }}" rel="stylesheet">

    <!-- Color Theme -->
    <!-- Options: green, purple, red, yellow, mint, blue, black  -->
    <link href="{{ asset('assets/website/css/themes/green.css') }}" rel="stylesheet">

    @stack('header_css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/website/js/ie/respond.min.js') }}"></script>
    <![endif]-->

    <!-- Modernizr -->
    <script src="{{ asset('assets/website/js/modernizr.min.js') }}"></script>
    <!-- Subtle Loading bar -->
    <script src="{{ asset('assets/website/js/plugins/pace.js') }}"></script>

    @stack('header_js')
</head>

<body class="animate-page" data-spy="scroll" data-target="#navbar" data-offset="100">
<!--Preloader div-->
<div class="preloader"></div>
