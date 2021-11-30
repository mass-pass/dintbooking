@extends('layouts.master')
@push('css')
<link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ url('css/glyphicon.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ url('js/ninja/ninja-slider.min.css') }}" />
@endpush
@section('main')

<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}">

<div class="carousel-inner" role="listbox">
	<div class="item active">
		<div class="ex-image-container" onclick="lightbox(0)" style="background-image:url({{$result->cover_photo}});">
		</div>
	</div>
</div>

<div class="container-fluid container-fluid-90">
	<div class="row" id="mainDiv">
		<div class="col-lg-8 col-xl-9">
			<div id="sideDiv">
				<div class="d-flex border rounded-4 p-4 mt-4">
					<div class="text-center">
						<a href="{{ url('users/show/'.$result->owner_id) }}">
							<img alt="User Profile Image" class="img-fluid circle-avatar mr-4 img-90x90" src="{{ $result->users->profile_src }}" title="{{$result->users->first_name}}">
						</a>
					</div>

					<div class="ml-2">
						<h3 class="text-20 mt-4"><strong>{{ $result->title }}</strong></h3>
						<span class="text-14 gray-text"><i class="fas fa-map-marker-alt"></i> {{ $result->city }} </span>
						
					</div>
				</div>

				<div class="row justify-content-between mt-4 ">
					<div class="col text-center border p-4 rounded mt-3 mr-2 mr-sm-5 bg-light text-dark">
						<i class="fa fa-ship fa-2x" aria-hidden="true"></i>
						<div>Entire Boat</div>
					</div>

					<div class="col text-center border p-4 rounded mt-3 bg-light text-dark">
						<i class="fa fa-users fa-2x" aria-hidden="true"></i>
						<div> {{ $result->authorised_onboard_capacity }} Person </div>
					</div>

					<div class="col text-center border p-4 rounded mt-3 ml-2 ml-sm-5 bg-light text-dark">
						<i class="fa fa-bath fa-2x" aria-hidden="true"></i>
						<div>
							{{ $result->bathroom_count}} Bathrooms
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-xl-3 mb-4 mt-4">
			<div id="sticky-anchor" class="d-none d-md-block"></div>
			<div class="card p-4">
				<div id="booking-price" class="panel panel-default">
					<div class="" id="booking-banner" class="">
						<div class="secondary-bg rounded">
							<div class="col-lg-12">
								<div class="row justify-content-between p-3">
									<div class="text-white">
										$ {{ $result->price }}
									</div>

									<div class="text-white text-14">
										<div id="per_night" class="per-night">
											Per Day
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="mt-4">
						<form accept-charset="UTF-8" method="post" action="" id="booking_form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12  p-4 single-border border-r-10 ">
									<div class="row p-2" id="daterange-btn">
										<div class="col-6 p-0">
											<label>Boat Date</label>
											<div class="mr-2">
												<input class="form-control" id="boat_date" name="boat_date" value="{{ $boat_date }}" placeholder="dd-mm-yyyy" type="text" required>
											</div>
										</div>
									</div>

									<div class="row mt-4">
										<div class="col-md-12 p-0">
											<div class=" ml-2 mr-2 ">
												<label>No Of People</label>
												<div class="">
													<select id="num_of_people" class="form-control" name="num_of_people">
														@for($i=1;$i<= $result->num_of_passengers;$i++)
															<option value="{{ $i }}">{{ $i }}</option>
															@endfor
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							<div id="book_it" class="mt-4">
								<div class="js-subtotal-container booking-subtotal panel-padding-fit">
									<div id="loader" class="display-off single-load">
										<img src="{{URL::to('/')}}/front/img/green-loader.gif" alt="loader">
									</div>

									<table class="table table-bordered price_table" id="booking_table">
										<tbody>
											<tr>
												<td class="pl-4">
													$ {{ $result->price }} x <span id="total_night_count" value="">1</span> Per Day
												</td>
												<td class="pl-4"><span id="total_night_price" value=""> {{ $result->price }} </span> <span id="custom_price" class="fa fa-info-circle secondary-text-color" data-html="true" data-toggle="tooltip" data-placement="top" title=""></span></td>
											</tr>

											<tr>
												<td class="pl-4">
													{{trans('messages.property_single.service_fee')}}
												</td>
												<td class="pl-4"><span id="service_fee" value=""> $ 0 </span></td>
											</tr>

											<tr class="additional_price">
												<td class="pl-4">
													{{trans('messages.property_single.additional_guest_fee')}}
												</td>
												<td class="pl-4">$<span id="additional_guest" value=""> 0 </span></td>
											</tr>

											<tr class="security_price">
												<td class="pl-4">
													{{trans('messages.property_single.security_fee')}}
												</td>
												<td class="pl-4">$<span id="security_fee" value=""> 0 </span></td>
											</tr>

											<tr class="cleaning_price">
												<td class="pl-4">
													{{trans('messages.property_single.cleaning_fee')}}
												</td>
												<td class="pl-4">$<span id="cleaning_fee" value=""> 0 </span></td>
											</tr>

											<tr>
												<td class="pl-4">
													Discount
												</td>
												<td class="pl-4">$ <span id="discount" value=""> 0 </span></td>
											</tr>

											<tr>
												<td class="pl-4">{{trans('messages.property_single.total')}}</td>
												<td class="pl-4"><span id="total" value=""> {{ $result->price }} </span></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div id="book_it_disabled" class="text-center d-none">
									<p id="book_it_disabled_message" class="icon-rausch">
										{{trans('messages.property_single.date_not_available')}}
									</p>
									<a href="{{URL::to('/')}}/search?location={{$result->city }}" class="btn btn-large btn-block text-14" id="view_other_listings_button">
										{{trans('messages.property_single.view_other_list')}}
									</a>
								</div>

								<div class="book_btn col-md-12 text-center {{ ($result->owner_id == @Auth::guard('users')->user()->id || $result->status == 'Unlisted') ? 'display-off' : '' }}">

									<button type="submit" class="btn vbtn-outline-success text-14 font-weight-700 mt-3 pl-5 pr-5 pt-3 pb-3" id="save_btn">
										<i class="spinner fa fa-spinner fa-spin d-none"></i>
										<span class="">
											{{trans('messages.property_single.request_book')}}
										</span>
									</button>
								</div>

								<p class="col-md-12 text-center mt-3">{{trans('messages.property_single.review_of_pay')}}</p>

								<ul class="list-inline text-center d-flex align-items-center justify-content-center">
									<li class="list-inline-item">
										
									</li>

									<li class="list-inline-item">
										<a class="twitter-share-button" href="" data-size="large" aria-label="tweet">Tweet</a>
									</li>

									<li class="list-inline-item">
										<a href="" aria-label="linkedin" onclick="" class="shareButton">
											<i class="fab fa-linkedin-in"></i> Share
										</a>
									</li>
								</ul>
							</div>
							<input id="hosting_id" name="hosting_id" type="hidden" value="{{ $result->id }}">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row mt-4 mt-sm-0">
		<div class="col-lg-8 col-xl-9 col-sm-12">
			<div class="row  justify-content-center border rounded pb-5" id="listMargin">
				<div class="col-md-12 mt-3 pl-4 pr-4">
					<div class="mt-3">
						<div class="row">
							<div class="col-md-12">
								<h2><strong>{{trans('messages.property_single.about_list')}}</strong> </h2>
								<p class="mt-4 text-justify">{{ $result->descripton }}</p>
							</div>
						</div>
					</div>

					<div class="mt-3">
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18"> {{trans('messages.property_single.the_space')}}</h2>
									</div>
								</div>
							</div>

							<div class="col-md-9 col-sm-9">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div><strong>Cabins:</strong> {{ @$result->cabin_count }}</div>
										<div><strong>{{trans('messages.property_single.bathroom')}}:</strong> {{ @$result->bathroom_count }}</div>
										<div><strong>Berths:</strong> {{ @$result->berth_count }}</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18"> Feature</h2>
									</div>
								</div>
							</div>

							<div class="col-md-9 col-sm-9">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div><strong>Manufacturer:</strong> {{ @$result->manufacturer }}</div>
										<div><strong>Length:</strong> {{ @$result->length }}</div>
										<div><strong>Year Of Construction:</strong> {{ @$result->year_of_construction }}</div>
									</div>
									<div class="col-md-6 col-sm-6">
										<div><strong>Capacity:</strong> {{ @$result->authorised_onboard_capacity }}</div>
										<div><strong>Capacity Recommended:</strong> {{ $result->recommended_onboard_capacity }}</div>
										<div><strong>Model:</strong> {{ @$result->model }}</div>
									</div>
								</div>
							</div>
						</div>
						<hr>
					</div>

					<div class="row">
						<div class="col-md-3 col-sm-3">
							<div class="d-flex h-100">
								<div class="align-self-center">
									<h2 class="font-weight-700 text-18">Discounts</h2>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-sm-9">
							<div class="row">
								<div class="col-md-6 col-sm-6">
									<div><strong>First booking discount:</strong> 0%</div>
									<div><strong>Early-bird discount:</strong> 0%</div>
									<div><strong>Last-minute booking:</strong> 0%</div>
								</div>
								
							</div>
						</div>

						<!-- photos -->
					</div>
				
					<!--Start Reviews-->
					@if(!$result->reviews->count())
						<div class="mt-5">
							<div class="row">
								<div class="col-md-12">
									<h2><strong>{{ trans('messages.reviews.no_reviews_yet') }}</strong></h2>
								</div>

								@if($result->users->reviews->count())
								<div class="col-md-12">
									<p>{{ trans_choice('messages.reviews.review_other_properties', $result->users->guest_review, ['count'=>$result->users->guest_review]) }}</p>
									<p class="text-center mt-5 mb-4">
										<a href="{{ url('users/show/'.$result->users->id) }}" class="btn btn vbtn-outline-success text-14 font-weight-700 pl-5 pr-5 pt-3 pb-3">{{ trans('messages.reviews.view_other_reviews') }}</a>
									</p>
								</div>
								@endif
							</div>
						</div>
					@else
						<div class="mt-5">
							<div class="row">
								<div class="col-md-12">
									<div class="d-flex">
										<div>
											<h2 class="text-20"><strong> {{ trans_choice('messages.reviews.review',$result->guest_review) }}</strong></h2>
										</div>

										<div class="ml-4"> 
											<p>	<i class="fa fa-star secondary-text-color"></i> {{sprintf("%.1f",$result->avg_rating )}} ({{ $result->guest_review }})</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="mt-3">
							<div class="row">
								<div class="col-md-12">
									<h3 class="font-weight-700 text-16">{{ trans('messages.property_single.summary') }}</h3>
								</div>
	
								<div class="col-md-12">
									<div class="mt-3 p-4 pt-3 pb-3 border rounded">
										<div class="row justify-content-between">
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.accuracy') }}</h4>
													</div>
		
													<div >
														<progress max="5" value="{{$result->accuracy_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->accuracy_avg_rating)}}</span>
													</div>
												</div>
											</div>
										
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.location') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->location_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->location_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4 class="text-truncate">{{ trans('messages.reviews.communication') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->communication_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->communication_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.checkin') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->checkin_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->checkin_avg_rating)}}</span>
													</div>
												</div>
											</div>
										
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.cleanliness') }}</h4> 
													</div>
		
													<div>
														<progress max="5" value="{{$result->cleanliness_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->cleanliness_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.value') }}</h4>
													</div>
		
													<div>
														<ul>
															<li>
																<progress max="5" value="{{$result->value_avg_rating}}">
																	<div class="progress-bar">
																		<span></span>
																	</div>
																</progress>
																<span> {{sprintf("%.1f",$result->value_avg_rating)}}</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="mt-5">
							<div class="row">
								@foreach($result->reviews as $row_review)
									@if($row_review->reviewer == 'guest')
										<div class="col-12 mt-4 mb-2">
											<div class="d-flex">
												<div class="">
													<div class="media-photo-badge text-center">
														<a href="{{ url('users/show/'.$row_review->users->id) }}" ><img alt="{{ $row_review->users->first_name }}" class="" src="{{ $row_review->users->profile_src }}" title="{{ $row_review->users->first_name }}"></a>
													</div>
												</div>
							
												<div class="ml-2 pt-2">
													<a href="{{ url('users/show/'.$row_review->users->id) }}" >
														<h2 class="text-16 font-weight-700">{{ $row_review->users->full_name }}</h2>
													</a>
													<p class="text-14 text-muted"><i class="far fa-clock"></i> {{ dateFormat($row_review->date_fy) }}</p>
												</div>
											</div>
										</div>
	
										<div class="col-12 mt-2">
											<div class="background text-15"  >
												@for($i=1; $i <=5 ; $i++)
													@if($row_review->rating >= $i)
														<i class="fa fa-star secondary-text-color"></i>
													@else
														<i class="fa fa-star"></i>
													@endif
												@endfor
											</div>
											<p class="mt-2 text-justify pr-4">{{ $row_review->message }}</p>
										</div>
									@endif
								@endforeach
							</div>
						</div>

						<div class="mt-4">
							@if($result->users->reviews->count() - $result->reviews->count())
								<div class="row">
									
									<div class="col-md-12">
										<p class="text-center mt-2">
											<a target="blank" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5" href="{{ url('users/show/'.$result->users->id) }}">
												<span>{{ trans('messages.reviews.view_other_reviews') }}</span>
											</a>
										</p>
									</div>
								</div>
							@endif
						</div>
					@endif
					<hr>
					<!--End Reviews-->
					<div class="mt-5">
						<div class="col-md-12">
							<div class="clearfix"></div>
							<h2><strong>{{trans('messages.property_single.about_host')}}</strong></h2> 
							<div class="d-flex mt-4">
								<div class="">
									<div class="media-photo-badge text-center">
										<a href="{{ url('users/show/'.$result->host_id) }}"><img alt="{{ $result->users->first_name }}" class="circle-avatar" src="{{ $result->users->profile_src }}" title="{{ $result->users->first_name }}"></a>
									</div>
								</div>

								<div class="ml-2 pt-3">
									<a href="{{ url('users/show/'.$result->host_id) }}">
										<h2 class="text-16 font-weight-700">{{ $result->users->full_name }}</h2>
									</a>
									<p>{{trans('messages.users_show.member_since')}} {{ date('F Y', strtotime($result->users->created_at))  }}</p>
								</div>
							</div> 
						</div>
					</div>
					</div>
					<hr>	
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>
</div>

<div class="container-fluid container-fluid-90 mt-70">
	<div class="row mt-5">
		<div class="col-md-12">
			<div id="room-detail-map" class="single-map-w"></div>
		</div>
	</div>
</div>



@push('scripts')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places'></script>
<script type="text/javascript" src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ninja/ninja-slider.js') }}"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/daterangepicker.min.js')}}"></script>
<script type="text/javascript" src="{{ url('js/daterangecustom.js')}}"></script>

<script type="text/javascript">
	$(function() {
		var checkin = $('#startDate').val();
		var checkout = $('#endDate').val();
		var page = 'single'
		dateRangeBtn(checkin,checkout,page);
		
	});
</script>

<script type="text/javascript">
$("#view-calendar").on("click", function() {
	return $("#startDate").trigger("select");
})

$( window ).resize(function() {
	if ($(window).width() < 760) {
		$("#listMargin").css({"margin-top": "0px"});
		//alert(1);
	} else {
		sticky_relocate();
	}
});

function sticky_relocate() {
	var window_top = $(window).scrollTop();
	var list_div = $("#listMargin").height();

	var div_top = $('#sticky-anchor').offset().top;
	if (window_top > div_top && $(window).width() > 992) {
		$('#booking-price').addClass('stick');
		$('#sticky-anchor').height($('#sticky').outerHeight());
		$("#listMargin").addClass('mt-25');
		$("#listMargin").css({"margin-top": "25px"});
		divAdjust();
	} else {
		$('#booking-price').removeClass('stick');
		$('#sticky-anchor').height(0);
		divAdjust();
	}
	if(window_top > list_div){
		$('#booking-price').addClass('d-none');
	}else{
		$('#booking-price').removeClass('d-none');
	}
}

function divAdjust() {
	if ($(window).width() > 992) {
		var mainDiv = $("#mainDiv").height();
		var sideDiv = $("#sideDiv").height();
		var listMargin = (mainDiv - sideDiv)-40;
		$("#listMargin").css({"margin-top": "-"+listMargin +"px"});
	}
	else {
			// More than 960
	}
}

$(function(){
	var checkin     = $('#url_checkin').val();
	var checkout    = $('#url_checkout').val();
	var guest       = $('#url_guests').val();
	
});



$(function() {
	$(window).scroll(sticky_relocate);
	sticky_relocate();
});

document.addEventListener('readystatechange', event => { 
	if (event.target.readyState === "complete") {
			setTimeout(function() { 
				sticky_relocate();
			}, 1000);
	}
});



$(document).ready(function() {
    $('#booking_form').validate({        
        submitHandler: function(form)
        {

     		$("#save_btn").on("click", function (e)
            {	
            	$("#save_btn").attr("disabled", true);
                e.preventDefault();
            });
            
            $(".spinner").removeClass('d-none');
            $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
            return true;
        }
    });
});

$('.more-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').addClass('d-none');
	$('#'+name+'_after').removeClass('d-none');
});

$('.less-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').removeClass('d-none');
	$('#'+name+'_after').addClass('d-none');
});

$('#room-detail-map').locationpicker({
	location: {
		latitude: "{{ $lat }}",
		longitude: "{{ $long }}"
	},
	radius: 0,
	addressFormat: "",
	markerVisible: false,
	markerInCenter: true,
	enableAutocomplete: true,
	scrollwheel: false,
	oninitialized: function (component) {
		setCircle($(component).locationpicker('map').map);
	}
});

function setCircle(map){
	var citymap = {
	loccenter: {
		center: {lat: 41.878, lng: -87.629},
		population: 240
	},
	};

	var cityCircle = new google.maps.Circle({
		strokeColor: '#329793',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#329793',
		fillOpacity: 0.35,
		map: map,
		center: {lat: "{{ $lat }}", lng: "{{ $long }}" },
		radius: citymap['loccenter'].population
	});
}

function lightbox(idx) {
	//show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
	$('#showSlider').removeClass("d-none");
	nslider.init(idx);
	$("#ninja-slider").addClass("fullscreen");
}

function fsIconClick(isFullscreen) { //fsIconClick is the default event handler of the fullscreen button
	if (isFullscreen) {
		$('#showSlider').addClass("d-none");
	}
}

function show_loader(){
	$('#loader').removeClass('d-none');
	$('#pagination').addClass('d-none');
}

function hide_loader(){
	$('#loader').addClass('d-none');
	$('#pagination').removeClass('d-none');
}

window.twttr = (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
	if (d.getElementById(id)) return t;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js, fjs);
	t._e = [];
	t.ready = function(f) {
		t._e.push(f);
	};

	return t;
	}(document, "script", "twitter-wjs"));
</script>
@endpush 
@stop

<!-- Start of LiveChat (www.livechatinc.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 12872328;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechatinc.com/chat-with/12872328/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>