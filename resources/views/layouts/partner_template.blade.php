<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	
<head>
    @include('common.partner.head')
</head>

<body>

<!-- Check if user is logged in-->
@if (Auth::check())
@if(Auth::user()->user_type_id == 1)
@include('common.partner.header-login')
@else
@include('common.partner.header', ['currentPropertyId' => $current_property_id ?? null])
@endif
@else 
@include('common.partner.header-login')
@endif

<!-- Partner sidebar-->
@if(Route::currentRouteName() == 'settings' || 
Route::currentRouteName() == 'facilities' || 
Route::currentRouteName() == 'photos' ||  
Route::currentRouteName() == 'amenities' || 
Route::currentRouteName() == 'layout' ||  
Route::currentRouteName() == 'create-new-property-diff-address' || 
Route::currentRouteName() == 'create-new-property')
	@include('common.partner.sidebar')
@endif

@yield('main')


<!-- Footer -->
@include('common.footer')

</body>
</html>