@include('common.head')

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








