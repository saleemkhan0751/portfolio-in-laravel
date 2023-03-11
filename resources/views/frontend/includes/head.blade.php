<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='icon' href="#" type='image/x-icon'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">

    <title>{{ config('Farm App Admin') }} @yield("title")</title>
    <link rel="icon" href="{!! asset('admin/images/logo2.jpeg') !!}"/>
    @include("frontend.includes.styles")
    @include("frontend.includes.scripts")
</head>
