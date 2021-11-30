@extends('layouts.master')

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ url('css/swiper-bundle.css')}}" />
@endpush 

@section('main')
<section style="margin-top: 50px;">
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                </div>
                <div class="content-body">   
                    <div class="row">             
                        <div class="col-md-3">
                            <div class="user-profile-sidewrapper">
                                <div class="card border">
                                    <div class="card-body">
                                        <div class="image-wrapper">
                                            <img src="{{ $result->profile_src }}">
                                        </div>
                                        <div class="image-rating mb-4">
                                            <span><i class="far fa-star"></i></span>
                                            <span ><b>{{ $reviews_count }} reviews</b></span>
                                        </div>
                                        <div class="hr">
                                            <hr>
                                        </div>
                                        <div class="image-status">
                                            <h5 class="mb-3">{{ ucfirst($result->first_name) }} {{ trans('messages.users_dashboard.confirmed') }}</h5>
                                            <ul>
                                                <li class="mb-3"><span><i class="{{ ($result->users_verification->email == 'yes') ? "fas fa-check" : "fas fa-times" }}"></i></span> &nbsp;Email address</li>
                                                <li><span><i class="{{ ($result->users_verification->phone == 'yes') ? "fas fa-check" : "fas fa-times" }}"></i></span> &nbsp;Phone number</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="profile-content-wrapper">
                                <div class="profile-header">
                                    <h2>Hi,I'm {{ucfirst($result->first_name)}}</h2>
                                    <p class="text-muted">joined in {{ $result->account_since }}</p>
                                </div>
                                @if(!$properties->isEmpty())
                                    <div class="profile-body ">
                                        <h4 class="mb-4">{{ucfirst($result->first_name)}}'s listings</h4>
                                        <div class="bill-slider-container">
                                            <div class="swiper-container bill-slider">
                                                <div class="swiper-wrapper">
                                                    @foreach($properties as $property)
                                                        <div class="swiper-slide">
                                                            <a href="#" class="bill-listing-link">
                                                                <img src="{{ $property->cover_photo }}">
                                                                <div class="bill-item">
                                                                    <div class="bill-rating">
                                                                        <span class="icon mr-1"><i class="fas fa-star"></i></span>
                                                                    <span><b>@if( $property->guest_review)
                                                                            {{ $property->avg_rating }}
                                                                        @else
                                                                            0
                                                                        @endif </b></span>
                                                                    <span class="text-muted">({{ $property->guest_review }})</span> 
                                                                    </div>
                                                                    <div class="bill-desc">
                                                                        <p>{{ $property->name}}</p>
                                                                        <p>{{ ($property && $property->property_address) ? $property->property_address->city : '' }}</p>
                                                                    </div> 
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="swiper-button-prev"></div>
                                            <div class="swiper-button-next"></div>
                                        </div>
                                    </div>
                                @else 
                                    <div class="profile-body ">
                                        <h4 class="mb-4">{{ucfirst($result->first_name)}}'s listings</h4>
                                        <p>No Records Found</p>
                                    </div>
                                @endif
                                <div class="hr">
                                    <hr>
                                </div>
                                <div class="profile-review pt-3">
                                    <h4><i class="fas fa-star"></i> {{ $reviews_count }} reviews</h4> <br>
									@if($reviews_from_guests->count() > 0)
                                        @foreach($reviews_from_guests as $row_host) 
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <p class="mb-0 lead"><strong>{{ $row_host->properties->name }}</strong></p>
                                                    <p class="text-muted mt-0">{{ ($row_host->created_at->diffForHumans()) }}</p>
                                                </div>
                                                <div class="col-md-3">
                                                <div class="posted-review-img">
                                                    <img src="{{ $row_host->users->profile_src }}">
                                                </div>
                                                </div>
                                            </div>
                                            <p>{{ $row_host->message }}</p>
                                        @endforeach
									@endif
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </section>
@stop

@push('scripts')
<script type="text/javascript" src="{{ url('js/swiper-bundle.min.js') }}"></script>
<script type="text/javascript">
	$("#profile-review-count").on('click', function(e){
		e.preventDefault()
		$('html,body').animate({
			scrollTop: $("#profile-review-title").offset().top},
			'slow');
	});
	var swiper = new Swiper(".bill-slider", {
		slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
	});
</script>
@endpush