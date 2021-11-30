<?php 
    $lang = Session::get('language');
?>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	
<head>
    @include('common.head')
</head>

<body>
<!--Universal header -->

@include('common.header')


<!-- Main -->
@yield('main')


<!-- Footer conditions -->
@if(Route::currentRouteName() !== 'create-account' && 
Route::currentRouteName() !== 'contact-details'  && 
Route::currentRouteName() !== 'partner.create-account')
@include('common.footer')
@endif

@include('common.foot')

</body>
</html>