<?php 
    $lang = Session::get('language');
?>

<!DOCTYPE html>
<html lang="{{ flagsShortcodes(Session::get('language'))  ?? 'en' }}">
	
<head>

         <!-- Required meta tags -->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Metas For sharing property in social media -->
		<meta property="og:url"                content="{{ isset($shareLink) ? $shareLink : url('/') }}"/>
		<meta property="og:type"               content="article"/>
		<meta property="og:title"              content="{{ isset($title) ? $title : '' }}"/>
		<meta property="og:description"        content="{{ isset($result->property_description->summary) ? $result->property_description->summary : ''  }}"/>	
		<meta property="og:image"              content="{{ (isset($property_id) && !empty($property_id && isset($property_photos[0]->photo) )) ? s3Url($property_photos[0]->photo, $property_id) : 'BANNER_URL'  }}"/>
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@if (!empty($favicon))
			<link rel="shortcut icon" href="{{ $favicon }}">
		@endif

		<title>{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ $additional_title ?? '' }}</title>
		<meta name="description" content="{{ $description ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'description') }} {{ $additional_description ?? '' }}">

	@stack('css')
<!-- CSS start-->
	<link rel="stylesheet" href="{{asset('css/vendor.css')}}"> 
	<link rel="stylesheet" href="{{asset('css/main.css')}}"> 
<!--CSS end-->
@stack('after-css')

</head>
<body>