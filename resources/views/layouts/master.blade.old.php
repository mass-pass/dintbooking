@include('common.head')

<!--Universal header -->
@if(Route::currentRouteName() != 'partner.create-account')
@include('common.header')
@endif

<!-- Partner-->
@if (Auth::check())
@if(Auth::user()->user_type_id == 1)
@include('common.partner.header-login')
@else
@include('common.partner.head')
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




<!-- Main -->
@yield('main')




<!-- Footer conditions -->
@if(Route::currentRouteName() !== 'create-account' && 
Route::currentRouteName() !== 'contact-details'  && 
Route::currentRouteName() !== 'partner.create-account')
@include('common.footer')
@endif

@include('common.foot')








