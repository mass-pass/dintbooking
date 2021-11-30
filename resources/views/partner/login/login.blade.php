<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta property="og:url"                content="{{ isset($shareLink) ? $shareLink : url('/') }}"/>
		<meta property="og:type"               content="article"/>
		<meta property="og:title"              content="{{ isset($title) ? $title : '' }}"/>
		<meta property="og:description"        content="{{ isset($result->property_description->summary) ? $result->property_description->summary : ''  }}"/>	
		<meta property="og:image"              content="{{ (isset($property_id) && !empty($property_id && isset($property_photos[0]->photo) )) ? s3Url($property_photos[0]->photo, $property_id) : 'BANNER_URL'  }}"/>


		
		@if (!empty($favicon))
			<link rel="shortcut icon" href="{{ $favicon }}">
		@endif

		<title>{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ $additional_title ?? '' }}</title>
		<meta name="description" content="{{ $description ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'description') }} {{ $additional_description ?? '' }}">
		
		<meta property="og:image" content="">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="csrf-token" content="{{ csrf_token() }}">

        @stack('css')
<!-- CSS start-->
	<link rel="stylesheet" href="{{asset('css/vendor.css')}}"> 
	<link rel="stylesheet" href="{{asset('css/main.css')}}"> 
<!--CSS end-->
@stack('after-css')

        

<body>
    <input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}"> 
    <header class="header_area  animated fadeIn">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid container-fluid-90">
                    <a class="navbar-brand logo_h" aria-label="logo" href="{{ env('GUEST_DOMAIN')?env('GUEST_DOMAIN'):url('') }}">
                    <img src="{{ $logo ?? '' }}" alt="logo" class="img-logo">
                </a>  
                    <!-- Trigger Button -->
                    <a href="#" aria-label="navbar" class="navbar-toggler" data-toggle="modal" data-target="#left_modal">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <div class="nav navbar-nav menu_nav justify-content-end">

                        <div class="nav-item currency-section nav-item-tooltip">

                            <button type="button" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter" data-tooltip-position="bottom"  data-tooltip-text="Choose your currency">
                                <span class="currency-text" >{!! Session::get('symbol')  !!} {{ Session::get('currency')  }}</span>
                                
                                <!-- <span class="currency-country">text</span> -->
                            </button>
                            <!-- <span class="custom-tooltip">Choose your language</span> -->
                            </div>
                            <div class="nav-item language-section nav-item-tooltip">

                            
                            <button type="button" data-toggle="modal" data-target="#languageModalCenter" aria-label="modalLanguge"  class="language-btn">

                                <span class="language-img"><img src="{{ url('images/flags/') }}/{{  flagsShortcodes(Session::get('language_name'))  ?? 'en' }}.png"></span>
                                <!-- <span class="language-text">India</span> -->
                            </button>
                            <!-- <span class="custom-tooltip">Choose your language</span> -->
                            </div>
                            <div style="  padding-top:18px;" class="nav-item help-section nav-item-tooltip">
    
                            <!-- <span class="custom-tooltip">Choose your language</span> -->
                            </div>
                        </div>
                    </div>
                   
                </div>
            </nav>
        </div>
    </header>

    <!-- Modal Window -->
    <div class="modal left fade" id="left_modal" tabindex="-1" role="dialog" aria-labelledby="left_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 secondary-bg"> 
                    @if(Auth::check())
                        <div class="row justify-content-center">
                            <div>
                                @if(file_exists(public_path('images/profile').'/'.Auth::user()->id.'/'.basename(Auth::user()->profile_src)))
                                <img src="{{Auth::user()->profile_src}}" class="head_avatar" alt="{{Auth::user()->first_name}}">
                                @else
                                <img src="{{ url('images/default-profile.png') }}" class="head_avatar" alt="{{Auth::user()->first_name}}">
                                @endif
                            </div>

                            <div>
                                <p  class="text-white mt-4"> {{Auth::user()->first_name}}</p>
                            </div>
                        </div>
                    @endif

                    <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <ul class="mobile-side">
                        @if(Auth::check())
                            <li><a style="height:auto;" href="{{ url('dashboard') }}"><i class="fa fa-tachometer-alt mr-3"></i>{{trans('messages.header.dashboard')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('inbox') }}"><i class="fas fa-inbox mr-3"></i>{{trans('messages.header.inbox')}}</a></li>
                            <li><a style="height:auto;" style="height:auto;" href="{{ url('properties') }}"><i class="far fa-list-alt mr-3"></i>{{trans('messages.header.your_listing')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('my-bookings') }}"><i class="fa fa-bookmark mr-3"></i>{{trans('messages.booking_my.booking')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('trips/active') }}"><i class="fa fa-suitcase mr-3"></i> {{trans('messages.header.your_trip')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('users/payout-list') }}"><i class="far fa-credit-card mr-3"></i> {{trans('messages.sidenav.payouts')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('users/transaction-history') }}"><i class="fas fa-money-check-alt mr-3 text-14"></i> {{trans('messages.account_transaction.transaction')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('users/profile') }}"><i class="far fa-user-circle mr-3"></i>{{trans('messages.utility.profile')}}</a></li>
                            <a style="height:auto;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <li><i class="fas fa-user-edit mr-3"></i>{{trans('messages.sidenav.reviews')}}</li>
                            </a>
                        
                            <div class="collapse" id="collapseExample">
                                <ul class="ml-4">
                                    <li><a style="height:auto;" href="{{ url('users/reviews') }}" class="text-14">{{trans('messages.reviews.reviews_about_you')}}</a></li>
                                    <li><a style="height:auto;" href="{{ url('users/reviews_by_you') }}" class="text-14">{{trans('messages.reviews.reviews_by_you')}}</a></li>
                                </ul>
                            </div>
                            <li><a style="height:auto;" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt mr-3"></i>{{trans('messages.header.logout')}}</a></li>
                        @else
                            <li><a style="height:auto;" href="{{ url('signup') }}"><i class="fas fa-stream mr-3"></i>{{trans('messages.sign_up.sign_up')}}</a></li>
                            <li><a style="height:auto;" href="{{ url('login') }}"><i class="far fa-list-alt mr-3"></i>{{trans('messages.header.login')}}</a></li>
                        @endif

                        @if(Request::segment(1) != 'help')
                            <a style="height:auto;" href="https://{{env('PARTNER_DOMAIN')}}/create-account">
                                <button class="btn vbtn-outline-success text-14 font-weight-700 pl-5 pr-5 pt-3 pb-3">
                                        {{trans('messages.header.list_space')}}
                                </button>
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{--Language Modal --}}
        <div class="modal custom-modal fade mt-5 z-index-high" id="languageModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
            <div  class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="w-100 pt-3">
                            <h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle">{{ trans('messages.home.choose_language') }}</h5>
                        </div>

                        <div>
                            <button type="button" class="close text-28 mr-2 filter-cancel" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                    </div>

                    <div class="modal-body  pb-5">
                        <div class="row">
                        <div class="col-md-12 mt-4">
                        <ul class="country-list">

                            @foreach(getLanguages() as $key => $value)
                            <li>
                                    <a href="javascript:void(0)" class="language_footer {{ (Session::get('language') == $key) ? 'active' : '' }}" data-lang="{{$key}}"><img src="{{ url('images/flags') }}/{{ $key }}.png"> {{$value}}</a>
                            </li>
                            @endforeach
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{--Currency Modal --}}
        <div class="modal fade mt-5 z-index-high" id="currencyModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="w-100 pt-3">
                            <h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle">{{ trans('messages.home.choose_currency') }}</h5>
                        </div>
                            
                        <div>
                            <button type="button" class="close text-28 mr-2 filter-cancel font-weight-500" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> 
                    </div>

                    <div class="modal-body pb-5">
                        <div class="row">
                            @foreach(getCurrencies() as $key => $value)
                            <div class="col-6 col-sm-3 p-3">
                                <div class="currency pl-3 pr-3 text-16 {{ (Session::get('currency') == $value->code) ? 'border border-success rounded-5 currency-active' : '' }}">
                                    <a href="javascript:void(0)" class="currency_footer " data-curr="{{$value->code}}">
                                        <p class="m-0 mt-2  text-16">{{$value->name}}</p>
                                        <p class="m-0 text-muted text-16">{{$value->code}} - {!! $value->org_symbol !!} </p> 
                                    </a>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-4 margin-top-85 min-height">
        <div class="d-flex justify-content-center">
            <div class="p-5 mt-5 mb-5 border w-450" >
                @if(Session::has('message'))
                    <div class="row mt-3">
                        <div class="col-md-12 p-2 text-center text-14 alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
                            <a href="#"  class="close text-18" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ Session::get('message') }}
                        </div>
                    </div>
                @endif 

                <a href="{{ isset($facebook_url) ? $facebook_url:URL::to('facebookLogin') }}">
                    <button class="btn btn-outline-primary pt-3 pb-3 text-16 w-100">
                        <span><i class="fab fa-facebook-f mr-2 text-16"></i> {{trans('messages.sign_up.sign_up_with_facebook')}}</span>
                    </button>
                </a>

                <a href="{{URL::to('googleLogin')}}">
                    <button class="btn btn-outline-danger pt-3 pb-3 text-16 w-100 mt-3">
                    <span><i class="fab fa-google-plus-g  mr-2 text-16"></i>  {{trans('messages.sign_up.sign_up_with_google')}}</span>
                    </button>
                </a>
                
                <p class="text-center font-weight-700 mt-1">{{trans('messages.login.or')}}</p>
                <form id="login_form" method="post" action="{{url('authenticate')}}"  accept-charset='UTF-8'>  
                    {{ csrf_field() }}
                    <div class="form-group col-sm-12 p-0">
                        @if ($errors->has('email'))
                            <p class="error">{{ $errors->first('email') }}</p> 
                        @endif
                        <input type="email" class="form-control text-14" value="{{ old('email') }}" name="email" placeholder = "{{trans('messages.login.email')}}">
                    </div>

                    <div class="form-group col-sm-12 p-0">
                        @if ($errors->has('password')) 
                            <p class="error">{{ $errors->first('password') }}</p> 
                        @endif
                        <input type="password" class="form-control text-14" value="" name="password" placeholder = "{{trans('messages.login.password')}}">
                    </div>

                    <div class="form-group col-sm-12 p-0 mt-3" >
                        <div class="d-flex justify-content-between">
                            <div class="m-3 text-14">
                                <input type="checkbox" class='remember_me' id="remember_me2" name="remember_me" value="1">
                                {{trans('messages.login.remember_me')}}
                            </div>
                            
                            <div class="m-3 text-14">
                                <a href="{{URL::to('/')}}/forgot_password" class="forgot-password text-right">{{trans('messages.login.forgot_pwd')}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-12 p-0" >
                        <button type='submit' id="btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-dark w-100 rounded"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
                                <span id="btn_next-text">{{trans('messages.login.login')}}</span>
                        </button>
                    </div>
                </form>
                
                <div class="mt-3 text-14">
                    {{trans('messages.login.do_not_have_an_account')}}
                    <a href="{{URL::to('/')}}/signup" >
                    {{trans('messages.login.register')}}
                    </a>
                </div>  
            </div>
        </div>
    </div>

    {{--Footer Section Start --}}
    <footer class="main-panel card border footer-bg p-4" id="footer">
        <div class="container-fluid container-fluid-90">
            <div class="row">
                <div class="col-6 col-sm-3 mt-4">
                    <h2 class="font-weight-700">{{ trans('messages.static_pages.hosting') }}</h2>
                    <div class="row">
                        <div class="col p-0">
                            <ul class="mt-1">
                                @if(isset($footer_first))
                                @foreach($footer_first as $ff)
                                <li class="pt-3 text-16">
                                    <a href="{{ url($ff->url) }}">{{ $ff->name }}</a>
                                </li>

                                @endforeach
                                @endif 
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-3 mt-4">
                    <h2 class="font-weight-700">{{ trans('messages.static_pages.company') }}</h2>
                    <div class="row">
                        <div class="col p-0">
                            <ul class="mt-1">
                                @if(isset($footer_second))
                                @foreach($footer_second as $fs)
                                <li class="pt-3 text-16">
                                    <a href="{{ url($fs->url) }}">{{ $fs->name }}</a>
                                </li>
                                @endforeach
                                @endif                                
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-3 mt-4">
                    <h2 class="font-weight-700">{{trans('messages.home.top_destination')}}</h2>
                    <div class="row">
                        <div class="col p-0">
                            <ul class="mt-1">
                                @if(isset($popular_cities))
                                @foreach($popular_cities->slice(0, 10) as $pc)
                                <li class="pt-3 text-16">
                                    <a href="{{URL::to('/')}}/search?location={{ $pc->name }}&checkin={{ date('d-m-Y') }}&checkout={{ date('d-m-Y') }}&guest=1">{{ $pc->name }}</a>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-sm-3 mt-5">
                    <div class="row mt-5">
                        <div class="col-md-12 text-center">
                            <a href="{{ url('/') }}"><img src="{{$logo ?? ''}}" class="img-logo" alt="logo"></a>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="social mt-4">
                            <ul class="list-inline text-center">
                                @if(isset($join_us))
                                @for($i=0; $i<count($join_us); $i++)
                                    @if(!empty($join_us[$i]->value) && trim($join_us[$i]->value) != '#')
                                        <li class="list-inline-item">
                                        <a class="social-icon  text-color text-18" target="_blank" href="{{ $join_us[$i]->value }}" aria-label="{{$join_us[$i]->name}}"><i class="fab fa-{{ str_replace('_','-',$join_us[$i]->name) }}"></i></a>
                                        </li>
                                    @endif
                                @endfor
                                @endif  
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p class="text-center text-underline">
                                <a href="#" aria-label="modalLanguge" data-toggle="modal" data-target="#languageModalCenter"> <i class="fa fa-globe"></i> {{  Session::get('language_name')  ?? $default_language[0]->name }} </a>
                                <a href="#" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter"> <span class="ml-4">{!! Session::get('symbol')  !!} - <u>{{ Session::get('currency')  }}</u> </span></a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="border-top p-0 mt-4">
            <div class="row  justify-content-between p-2">
                <p class="col-lg-12 col-sm-12 mb-0 mt-4 text-14 text-center">
                © {{ date('Y') }} {{$site_name ?? ''}}. {{ trans('messages.home.all_rights_reserved') }}</p>
            </div>
        </div>
    </footer>
    <!-- New Js start-->
    <script src="{{asset('js/jquery-2.2.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    
    <script type="text/javascript">
        var APP_URL = "{{ url('/') }}";
        var USER_ID = "{{ isset(Auth::user()->id)  ? Auth::user()->id : ''  }}";
        var sessionDate      = '{!! Session::get('date_format_type') !!}';

    $(".currency_footer").on('click', function() {
        var currency = $(this).data('curr');
            $.ajax({
                type: "POST",
                url: APP_URL + "/set_session",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'currency': currency
                    },
                success: function(msg) {
                    location.reload()
                },
        });
    });

    $(".language_footer").on('click', function() {
        var language = $(this).data('lang');
        $.ajax({
            type: "POST",
            url: APP_URL + "/set_session",
            data: {
                    "_token": "{{ csrf_token() }}",
                    'language': language
                },
            success: function(msg) {
                location.reload()
            },
        });
    });

    </script>
	</body>
</html>



<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
jQuery.validator.addMethod("laxEmail", function(value, element) {
	// allow any non-whitespace characters as the host part
	return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
}, "{{ __('messages.jquery_validation.email') }}" );

$(document).ready(function () {
	$('#login_form').validate({
		rules: {
			email: {
				required: true,
				maxlength: 255,
				laxEmail: true
			},

			password: {
				required: true
			}
		},
		submitHandler: function(form)
        {
 			$("#btn").on("click", function (e)
            {	
            	$("#btn").attr("disabled", true);
                e.preventDefault();
            });


            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("{{trans('messages.login.login')}}..");
            return true;
        },
		messages: {
			email: {
				required:  "{{ __('messages.jquery_validation.required') }}",
				maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
			},

			password: {
				required: "{{ __('messages.jquery_validation.required') }}",
			}
		}
	});
});
</script>
