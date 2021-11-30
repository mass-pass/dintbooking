@php
    $default_language = App\Models\Language::first();
@endphp
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
                            <a href="#" aria-label="modalLanguge" data-toggle="modal" data-target="#languageModalCenter"> <i class="fa fa-globe"></i> {{  Session::get('language_name')  ?? $default_language->name }} </a>
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




