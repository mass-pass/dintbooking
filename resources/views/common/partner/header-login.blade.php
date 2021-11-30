<link rel="stylesheet" href="{{ asset('css/main.css') }}">


<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}"> 

<header class="header_area animated fadeIn">
<div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid container-fluid-90">
                <a class="navbar-brand logo_h" aria-label="logo" href="{{ url('/') }}">
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

                        @if(Request::segment(1) != 'help')
                            <div class="nav-item">
                                @if(!Auth::check())
                                    <a class="nav-link p-2" href="{{ route('partner.create-account') }}" aria-label="property-create">
                                        <button class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-4 pr-4">
                                            <p class="p-3 mb-0">  {{trans('messages.header.list_space')}}</p>
                                        </button>
                                    </a>
                                @else
                                    <a class="nav-link p-2" href="{{ route('partner.list-property') }}" aria-label="property-create">
                                        <button class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-4 pr-4">
                                            <p class="p-3 mb-0">  {{trans('messages.header.list_space')}}</p>
                                        </button>
                                    </a>
                                @endif
                            </div>
                        @endif
     
                        @if(!Auth::check())
                            <div class="nav-item">
                                <a class="nav-link" href="{{ url('signup') }}" aria-label="signup">{{trans('messages.sign_up.sign_up')}}</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="{{ url('login') }}" aria-label="login">{{trans('messages.header.login')}}</a>
                            </div>
                        @else
                            <div class="d-flex">
                                <div>
                                    <div class="nav-item mr-0">
                                        <img src="{{Auth::user()->profile_src}}" class="head_avatar" alt="{{Auth::user()->first_name}}">
                                    </div>
                                </div>
                                <div>
                                <div class="nav-item ml-0 pl-0">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle text-15" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-label="user-profile" aria-haspopup="true" aria-expanded="false">
                                            {{Auth::user()->first_name}}
                                        </a>
                                        <div class="dropdown-menu drop-down-menu-left p-0 drop-width text-14" aria-labelledby="dropdownMenuButton">
                                            <a class="vbg-default-hover border-0  font-weight-700 list-group-item vbg-default-hover border-0" href="{{ url('dashboard') }}" aria-label="dashboard">{{trans('messages.header.dashboard')}}</a>
                                            <a class="font-weight-700 list-group-item vbg-default-hover border-0 " href="{{ url('users/profile') }}" aria-label="profile">{{trans('messages.utility.profile')}}</a>
                                            <a class="font-weight-700 list-group-item vbg-default-hover border-0 " href="{{ url('logout') }}" aria-label="logout">{{trans('messages.header.logout')}}</a>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
    
  
</header>

<div class="row">
    @if (Route::currentRouteName() != 'facilities')
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
    @endif
    
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