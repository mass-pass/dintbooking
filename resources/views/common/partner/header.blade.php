
<style>
    .custom-modal .modal-content {
        -webkit-box-shadow: 0 2px 8px 0 rgb(0 0 0 / 16%);
        box-shadow: 0 2px 8px 0 rgb(0 0 0 / 16%);
        padding: 32px;
        border-radius: 5px;
    }
    .custom-modal .modal-header {
        border-bottom: none;
    }
    .custom-modal .modal-content h5 {
        font-size: 18px;
        font-weight: 600;
    }
    .modal-body {
        max-height: calc(100vh - 12.5rem);
        overflow-y: auto;
    }
    .custom-modal .country-list {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        width: 100%;
    }
    .custom-modal .country-list li {
        -ms-flex-preferred-size: 25%;
        -webkit-flex-basis: 25%;
        flex-basis: 25%;
        width: 25%;
        max-width: 25%;
        padding: 16px 8px 0;
        list-style: none;
    }

    .custom-modal .country-list li a {
        display: flex;
        position: relative;
        font-size: 14px;
        color: #333;
        padding: 12px;
        border-radius: 2px;
    }

    .custom-modal .country-list li img {
        width: 22px;
        height: 22px;
        object-fit: cover;
        border: 1px solid #e6e6e6;
        background-color: #f2f2f2;
        margin-right: 16px;
        border-radius: 50%;
    }
</style>
<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}"> 

<header style="position: fixed;left: 0;top: 0; z-index: 555;width: 100%;">
    <div class="header-wrapper">
        <div class="container-fluid">
           <div class="headerTop">
            <div class="right-header ">
                <ul class="list-inline mb-0 right-list">
                    <li class="list-inline-item">
                        <a href="#" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter" data-tooltip-position="bottom"  data-tooltip-text="Choose your currency">
                           <strong> {!! Session::get('symbol')  !!} {{ Session::get('currency')  }}</strong>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#" data-toggle="modal" data-target="#languageModalCenter" aria-label="modalLanguge"  class="language-btn">
                            <img src="{{ url('images/flags/') }}/{{  flagsShortcodes(Session::get('language_name'))  ?? 'en' }}.png">
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('partner.list-property') }}" class="btn btn-outline-dark">
                            List your property
                        </a>
                    </li>
                  
                </ul>
            </div>
           </div>
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand" href="#"><img src="{{ url('images/logo.png') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ (Route::current()->uri() == 'partner/dashboard') ? ' active' : ''  }}">
                            <a class="nav-link" href="/partner/dashboard/{{ $currentPropertyId }}">Dashboard <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{ (Route::current()->uri() == 'partner/calendar') ? ' active' : ''  }}">
                            <a class="nav-link" href="/partner/calendar/{{ $currentPropertyId }}">Calendar</a>
                        </li>
                        <li class="nav-item {{ (Route::current()->uri() == 'partner/reservations') ? ' active' : ''  }}">
                            <a class="nav-link" href="{{url('partner/reservations/'.$currentPropertyId)}}">Reservations</a>
                        </li>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link {{ (Route::current()->uri() == 'partner/rates-availability') ? ' active' : ''  }}" href="{{url('partner/rates-availability/'.$currentPropertyId)}}" >
                                Rates and Availability
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Reports
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Invoices</a>
                                <a class="dropdown-item" href="#">Reservation statements</a>
                                <a class="dropdown-item" href="#">Financial overview</a>
                                <a class="dropdown-item" href="#">Bank details</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('partner.inbox', ['property' => $currentPropertyId])}}">Inbox</a>
                        </li>
                        <li class="nav-item {{ (Route::current()->uri() == 'partner/reviews') ? ' active' : ''  }}">
                            <a class="nav-link" href="{{ url('partner/reviews/'.$currentPropertyId) }}">Reviews</a>
                        </li>
                    </ul>
                    <div class="right-header ">
                        <ul class="list-inline mb-0 right-list">
                          
                            
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="far fa-hdd"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">
                                    <i class="fa fa-broom"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{route('partner.only.property.listings', ['property' => $currentPropertyId])}}">
                                    <i class="far fa-building"></i>
                                </a> 
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('layout', ['property' => $currentPropertyId]) }}">
                                    <i class="fa fa-cog"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Get help
                                    <i class="far fa-comment"></i>
                                </a>
                            </li>
                            <li class="list-inline-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="user_drop_down" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                </a>
                                <div style="right:0px !important;left:auto;" class="dropdown-menu" aria-labelledby="user_drop_down">
                                    <a class="dropdown-item" href="{{ url('logout') }}">{{trans('messages.header.logout')}}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Header bottom line starts -->
    <div class="header-bottom-line">
        <span class="multiple-color-item green"></span>
        <span class="multiple-color-item blue"></span>
        <span class="multiple-color-item purple"></span>
        <span class="multiple-color-item red"></span>
    </div>
    <!-- Header bottom line starts -->
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