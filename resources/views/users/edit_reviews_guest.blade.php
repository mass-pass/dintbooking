@extends('layouts.master')
@section('main')  
<div class="margin-top-85">
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-lg-10 p-0">
			<div class="container-fluid min-height">
				<div class="col-md-12 mt-5 p-0">
					<div class="main-panel">
						<div class="row mt-5">
							<div class="col-md-12 p-0">
								<div class="container-fluid">
									<div class="row flex-column-reverse flex-md-row">
										<div class="col-md-8 border rounded-3 p-4 mb-5">    
											<div class="panel panel-default {{ $review_id?'display-off':''}} opening-div">
												<div class="panel-body text-18 font-weight-700 pb-2">
													{{ trans('messages.reviews.write_review_for') }} {{ $result->properties->users->first_name }}
												</div>
												
												<div class="panel-footer text-16">
													<p>
														{{ trans('messages.reviews.write_review_guest_desc1') }}
														{{ trans('messages.reviews.write_review_guest_desc2') }}
													</p>
													<p>
														{{ trans('messages.reviews.write_review_guest_desc3') }}
													</p>
													<button class="btn vbtn-outline-success text-16 font-weight-700 p-0 mt-2 pl-4 pr-4 pt-2 pb-2" id="open-review"> 
														{{ trans('messages.reviews.write_a_review') }}
													</button>
												</div>
											</div> 
											
											<div class="panel panel-default {{ $review_id?'':'display-off'}} review-div">
												<input type="hidden" value="{{ $review_id }}" name="review_id" id="review_id">
												<input type="hidden" value="{{ $result->id }}" name="booking_id" id="booking_id">
												
												<div class="panel-footer">
													<p class="font-weight-700">{{ trans('messages.reviews.guest_star_reviews_desc') }}</p>
													<form id="guest-review-form1" method="post" class="edit_review">
														{{ csrf_field() }}
														<div id="review-guest-1">
															<input type="hidden" value="host_summary" name="section" id="section">
															<div class="input-fields">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.describe_your_exp') }} <span class="text-danger">*</span></h4>
																<p class="mt-4">{{ trans('messages.reviews.describe_your_exp_guest_desc',['site_name'=>$site_name]) }}</p>
																<textarea rows="5" placeholder="{{ trans('messages.reviews.describe_your_exp_placeholder') }}" name="message" id="message" data-behavior="countable" cols="40" maxlength="500" class="form-control mb10 mt-2">{{ isset($result->review_details($review_id)->message) ? $result->review_details($review_id)->message : '' }}</textarea>
																<span class="float-right">{{ trans('messages.reviews.500_words_left') }}</span>

																<span class="error-msg text-12 d-none text-danger" id='error-comments'>{{ trans('messages.reviews.this_field_is_required') }}</span>
															</div>

															<div class="input-fields mt-5">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.private_host_feedback') }}</h4>
																<p class="mt-4">{{ trans('messages.reviews.private_host_feedback_desc',['site_name'=>$site_name]) }}</p>
																<div class="row-space-2">
																	<h4>{{ trans('messages.reviews.what_did_you_love_about_staying') }}</h4>
																	<textarea rows="5" name="secret_feedback" id="secret_feedback" class="form-control mt-2">{{ isset($result->review_details($review_id)->secret_feedback) ? $result->review_details($review_id)->secret_feedback : '' }}</textarea>
																</div>
																<div class="mt-4">
																	<h4>{{ trans('messages.reviews.how_host_improve') }}</h4>
																	<textarea rows="5" name="improve_message" id="improve_message" class="form-control mt-2">{{ isset($result->review_details($review_id)->improve_message) ? $result->review_details($review_id)->improve_message : '' }}</textarea>
																</div>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.overall_exp') }}<span class="text-danger">*</span></h4>
																<input type="hidden" name="rating" id="rating" value="{{ isset($result->review_details($review_id)->rating) ? $result->review_details($review_id)->rating : '' }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="rating-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->rating) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<span class="error-msg d-none" id='error-rating'>{{ trans('messages.reviews.this_field_is_required') }}</span>
															</div>

															<div class="mt-4 mb-4 text-right">
																<button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" type="submit" id="btn_next">
																 <i class="spinner fa fa-spinner fa-spin d-none" id="btn_spin"></i>	
																 <span id="btnnext-text1">{{ trans('messages.reviews.next') }}</span>									
																</button>
															</div>
														</div>
													</form>

													<form id="guest-review-form2" method="post" class="edit_review">
														{{ csrf_field() }}
														<div id="review-guest-2" class="display-off">
															<div class="input-fields">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.accuracy') }}</h4>
																<p class="mt-2">{!! trans('messages.reviews.accuracy_desc1') !!}</p>
																<input type="hidden" name="accuracy" id="accuracy" value="{{ isset($result->review_details($review_id)->accuracy) ? $result->review_details($review_id)->accuracy : '' }}">
																<div class="background text-16" >
																	@for($i=1; $i <=5 ; $i++)
																	<i id="accuracy-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->accuracy) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.accuracy_desc2') }}</p> 
																<textarea rows="2" placeholder="{{ trans('messages.reviews.accuracy') }}" name="accuracy_message" id="accuracy_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->accuracy_message) ? $result->review_details($review_id)->accuracy_message : '' }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.cleanliness') }}</h4>
																<p class="mt-2">{{ trans('messages.reviews.cleanliness_desc1') }}</p>
																<input type="hidden" name="cleanliness" id="cleanliness" value="{{ isset($result->review_details($review_id)->cleanliness) ? $result->review_details($review_id)->cleanliness : '' }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="cleanliness-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->cleanliness) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.cleanliness_desc2') }}</p> 
																<textarea rows="2" placeholder="{{ trans('messages.reviews.cleanliness') }}" name="cleanliness_message" id="cleanliness_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->cleanliness_message) ? $result->review_details($review_id)->cleanliness_message : '' }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.arrival') }}</h4>
																<p class="mt-2">{{ trans('messages.reviews.arrival_desc1') }}</p>
																<input type="hidden" name="checkin" id="checkin" value="{{ isset($result->review_details($review_id)->checkin) ? $result->review_details($review_id)->checkin : ''  }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="checkin-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->checkin) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.arrival_desc2') }}</p>
																<textarea rows="2" placeholder="{{ trans('messages.reviews.arrival') }}" name="checkin_message" id="checkin_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->checkin_message) ? $result->review_details($review_id)->checkin_message : ''  }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.amenities') }}</h4>
																<p class="mt-2">{{ trans('messages.reviews.amenities_desc1') }}</p>
																<input type="hidden" name="amenities" id="amenities" value="{{ isset($result->review_details($review_id)->amenities) ? $result->review_details($review_id)->amenities : '' }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="amenities-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->amenities) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.amenities_desc2') }}</p>
																<textarea rows="2" placeholder="{{ trans('messages.reviews.amenities') }}" name="amenities_message" id="amenities_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->amenities_message) ? $result->review_details($review_id)->amenities_message : '' }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.communication') }}</h4>
																<p class="mt-2">{{ trans('messages.reviews.communication_desc1') }}</p>
																<input type="hidden" name="communication" id="communication" value="{{ isset($result->review_details($review_id)->communication) ? $result->review_details($review_id)->communication : ''  }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="communication-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->communication) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.communication_desc2') }}</p> 
																<textarea rows="2" placeholder="{{ trans('messages.reviews.communication') }}" name="communication_message" id="communication_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->communication_message) ? $result->review_details($review_id)->communication_message : ''  }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.location') }}</h4>
																<p class="mb10">{{ trans('messages.reviews.location_desc1') }}</p>
																<input type="hidden" name="location" id="location" value="{{ isset($result->review_details($review_id)->location) ? $result->review_details($review_id)->location : ''  }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="location-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->location) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.location_desc2') }}</p> 
																<textarea rows="2" placeholder="{{ trans('messages.reviews.location') }}" name="location_message" id="location_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->location_message) ? $result->review_details($review_id)->location_message : ''  }}</textarea>
															</div>

															<div class="input-fields mt-4">
																<h4 class="text-16 font-weight-700">{{ trans('messages.reviews.value') }}</h4>
																<p class="mb10">{{ trans('messages.reviews.value_desc1') }}</p>
																<input type="hidden" name="value" id="value" value="{{ isset($result->review_details($review_id)->value) ? $result->review_details($review_id)->value : ''  }}">
																<div class="background text-16">
																	@for($i=1; $i <=5 ; $i++)
																	<i id="value-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->value) ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
																	@endfor
																</div>
																<p>{{ trans('messages.reviews.value_desc2') }}</p>
																<textarea rows="2" placeholder="{{ trans('messages.reviews.value') }}" name="value_message" id="value_message" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->value_message) ? $result->review_details($review_id)->value_message : '' }}</textarea>
															</div>

															<div class="mt-4 mb-4 text-right">
																<button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 " id="btn_submit" type="submit">
																	<i class="spinner fa fa-spinner fa-spin d-none" id="btn_spin2"></i>

																	<span id="btnnext-text2">{{ trans('messages.reviews.submit') }}</span>

																	
																</button>
															</div>
														</div>
													</form>
												</div>
											</div>             
										</div>

										<div class="col-md-4">
											<div class="border rounded-3 p-4">
												<a href="{{ url('/') }}/properties/{{ $result->property_id }}" alt="{{ $result->properties->name }}" class="media-cover">
													<img class="img-fluid" src="{{ $result->properties->cover_photo }}" alt="coverphoto">
												</a>
												<div class="mt-3">
													<div class="col-xs-12 mb20 l-pad-none r-pad-none">
														<div class="font-weight-700"><a href="{{ url('/') }}/properties/{{ $result->property_id }}" alt="{{ $result->properties->name }}" class="media-cover" target="_blank">{{ $result->properties->name }}</a></div>
														{{-- <div class="text-muted">{{ $result->properties->name }} · {{ $result->properties->property_address->city }}</div> --}}
														<div class="location-title">{{ trans('messages.reviews.hosted_by') }} <a href="{{ url('/') }}/users/show/{{ $result->host_id }}" class="media-cover" target="_blank">{{ $result->properties->users->full_name }}</a></div>
														<div class="text-muted">{{ $result->dates }}</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop  


@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
	$('#open-review').on( 'click', function(){
		$('.opening-div').addClass('display-off');
		$('.review-div').removeClass('display-off');
	});


	$('.icon-click').on('mouseover', function(){
		var temp = $(this).attr('id');
		temp     = temp.split('-');
		var name = temp[0];
		var val  = temp[1];
		var prv  = $('#'+name).val();
		$('#'+name).val(val);
		for(i = 1; i <= prv; i++){
			$('#'+name+'-'+i).removeClass('icon-beach');
			$('#'+name+'-'+i).addClass('icon-light-gray');
		}
		
		for(i = 1; i <= val; i++){
			$('#'+name+'-'+i).removeClass('icon-light-gray');
			$('#'+name+'-'+i).addClass('icon-beach');
		}
	})

	$('.thumb-icon').on('click', function(){
		$('.thumb-icon').removeClass('icon-select');
		$('.thumb-icon').removeClass('icon-unselect');
		var rec = $(this).attr('data-rel');
		$('#recommend').attr('value', rec);
		if(rec == 0)
			$(this).addClass('icon-unselect');
		else
			$(this).addClass('icon-select');
	});

	$('#guest-review-form1').on('submit', function(e){
		e.preventDefault();
	// $('#error-comments').hide();
	// $('#error-rating').hide();

	var booking_id = $('#booking_id').val();
	var review_id  = $('#review_id').val();
	var message    = $('#message').val();
	var secret_feedback   = $('#secret_feedback').val(); 
	var improve_message = $('#improve_message').val();
	var rating     = $('#rating').val();
	var dataURL    = APP_URL + "/reviews/edit/" + booking_id;
	if(message == ''){
		console.log("1");
		$('#error-comments').removeClass('d-none');
	}
	else {

		$(this).addClass('disabled');
        $("#btn_spin").removeClass('d-none');
        $("#btnnext-text1").text("{{trans('messages.listing_basic.next')}}..");
		
		$.ajax({
			url: dataURL,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				'review_id': review_id,
				'message': message,
				'secret_feedback': secret_feedback, 
				'improve_message': improve_message,
				'rating': rating,
			},
			type: 'post',
			dataType: 'json',
			success: function (result) {
				if(result.success){
					$('#review-guest-1').addClass('display-off');
					$('#review-guest-2').removeClass('display-off');
					$('#review_id').val(result.review_id);
				}
			},
			error: function (request, error) {
			// This callback function will trigger on unsuccessful action
			//show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
		},
	});
	}
});

	$('#guest-review-form2').on('submit', function(e){
		e.preventDefault();

		$(this).addClass('disabled');
        $("#btn_spin2").removeClass('d-none');
        $("#btnnext-text2").text("{{ trans('messages.reviews.submit') }}..");
        
		var booking_id = $('#booking_id').val();

		var review_id = $('#review_id').val();
		var accuracy = $('#accuracy').val();
		var accuracy_message = $('#accuracy_message').val(); 
		var cleanliness = $('#cleanliness').val();
		var cleanliness_message = $('#cleanliness_message').val();
		var checkin = $('#checkin').val();
		var checkin_message = $('#checkin_message').val();
		var amenities = $('#amenities').val();
		var amenities_message = $('#amenities_message').val();
		var communication = $('#communication').val();
		var communication_message = $('#communication_message').val();
		var location = $('#location').val();
		var location_message = $('#location_message').val();
		var value = $('#value').val();
		var value_message = $('#value_message').val();
		var recommend = $('#recommend').val();
		var dataURL = APP_URL + "/reviews/edit/" + booking_id;
		$.ajax({
			url: dataURL,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data: {
				'review_id': review_id,
				'accuracy': accuracy,
				'accuracy_message': accuracy_message, 
				'cleanliness': cleanliness,
				'cleanliness_message': cleanliness_message,
				'checkin': checkin,
				'checkin_message': checkin_message, 
				'amenities': amenities,
				'amenities_message': amenities_message, 
				'communication': communication,
				'communication_message': communication_message, 
				'location': location,
				'location_message': location_message,  
				'value': value,
				'value_message': value_message,
				'recommend': recommend,
			},
			type: 'post',
			dataType: 'json',
			success: function (result) {
				if(result.success){
					window.location.href = APP_URL + "/users/reviews_by_you"
				}
			},
			error: function (request, error) {
				// This callback function will trigger on unsuccessful action
				//show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
			},
		});
	});
</script>
@endpush
