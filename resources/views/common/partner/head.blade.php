
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Metas For sharing property in social media -->
    <meta property="og:url" content="{{ isset($shareLink) ? $shareLink : url('/') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ isset($title) ? $title : '' }}" />

    <title>{{ $title ?? '' }}</title>
    <meta name="description" content="{{ $description ?? '' }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @stack('css')

    <!-- CSS start-->
	<link rel="stylesheet" href="{{asset('css/vendor.css')}}"> 
    <link rel="stylesheet" href="{{asset('partner/css/style.css')}}">
    
    <link rel="stylesheet" href="{{asset('partner/css/responsive.css')}}">
    <!--CSS end-->

    @stack('after-css')

    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>

    <script type="text/javascript"> 
    var APP_URL = "{{(url('/'))}}"; 
    </script>