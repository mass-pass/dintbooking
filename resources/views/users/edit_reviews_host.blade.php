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
						<div class="row flex-column-reverse flex-md-row">
							<div class="col-md-9">    
								<div class="mt-4 mt-sm-0 {{ $review_id?'display-off':''}} opening-div">
									<h3 class="font-weight-700">{{ trans('messages.reviews.write_review_for') }} {{ $result->users->first_name }}</h3>
									<div class="mt-3">
										<p class="text-justify">
										{{ trans('messages.reviews.write_review_host_desc1') }}
										{{ trans('messages.reviews.write_review_host_desc2',['site_name'=>$site_name]) }}
										</p>

										<p class="text-justify">
										{{ trans('messages.reviews.write_review_host_desc3') }}
										</p>

										<button class="dint-button  vbtn-success pl-4 pr-4 mb-4 rounded" id="open-review">
										{{ trans('messages.reviews.write_a_review') }}
										</button>
									</div>
								</div>

								<div class="mt-4 mt-sm-0 {{ $review_id?'':'display-off'}} review-div">
									
									<form id="guest-form" method="post" class="edit_review">
										{{ csrf_field() }}
										<input type="hidden" value="{{ $review_id }}" name="review_id" id="review_id">
										<input type="hidden" value="{{ $result->id }}" name="booking_id" id="booking_id">
										<div class="form-group">
											<label for="message" class="font-weight-700">1. {{ trans('messages.reviews.describe_your_exp') }} <span class="text-danger">*</span></label>
											<p class="text-15">{{ trans('messages.reviews.describe_your_exp_host_desc',['first_name'=>$result->users->first_name]) }}</p>
											<textarea rows="3" placeholder="What was it like to host this guest?" name="message" id="review_message" data-behavior="countable" cols="40" maxlength="500" class="form-control mb10">{{ isset($result->review_details($review_id)->message) ? $result->review_details($review_id)->message : '' }}</textarea>
											<span class="float-right">{{ trans('messages.reviews.500_words_left') }}</span>
											<p class="text-15">{{ trans('messages.reviews.describe_your_exp_host_desc2') }}</p>
										</div>

										<div class="form-group">
											<label for="message" class="font-weight-700">2. {{ trans('messages.reviews.private_guest_feedback') }}</label>
											<p class="text-15">{{ trans('messages.reviews.private_guest_feedback_desc') }}</p>
											<textarea rows="3" placeholder="Thank your guest for visiting or offer some tips to help them improve for their next trip." name="secret_feedback" id="secret_feedback" cols="40" class="form-control mb10">{{ isset($result->review_details($review_id)->secret_feedback) ? $result->review_details($review_id)->secret_feedback : ''  }}</textarea>
										</div>

										<div class="form-group">
											<label for="message" class="font-weight-700">3. {{ trans('messages.reviews.overall_exp') }}</label>
											<input type="hidden" name="rating" id="rating" value="{{ isset($result->review_details($review_id)->rating) ? $result->review_details($review_id)->rating : ''  }}">
											<div class="background ml-3">
											@for($i=1; $i <=5 ; $i++)
												<i id="rating-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->rating) ? 'secondary-text-color':'icon-light-gray' }} icon-click"></i> 
											@endfor
											</div> 
										</div>

										<div class="form-group">
											<label for="message" class="font-weight-700">4. {{ trans('messages.reviews.cleanliness_host_desc') }}</label>
											<input type="hidden" name="cleanliness" id="cleanliness" value="{{ isset($result->review_details($review_id)->cleanliness) ? $result->review_details($review_id)->cleanliness : ''  }}">
											<div class="background ml-3">
											@for($i=1; $i <=5 ; $i++)
												<i id="cleanliness-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->cleanliness) ? 'secondary-text-color':'icon-light-gray' }} icon-click"></i> 
											@endfor
											</div> 
										</div>

										<div class="form-group">
											<label for="message" class="font-weight-700">5. {{ trans('messages.reviews.communication_host_desc') }}</label>
											<input type="hidden" name="communication" id="communication" value="{{ isset($result->review_details($review_id)->communication) ? $result->review_details($review_id)->communication : '' }}">
											<div class="background ml-3">
											@for($i=1; $i <=5 ; $i++)
												<i id="communication-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->communication) ? 'secondary-text-color':'icon-light-gray' }} icon-click"></i> 
											@endfor
											</div> 
										</div>



										<div class="form-group">
											<label for="message" class="font-weight-700">6. {{ trans('messages.reviews.observance_house_rules_desc') }}</label>
											<input type="hidden" name="house_rules" id="house_rules" value="{{isset($result->review_details($review_id)->house_rules) ? $result->review_details($review_id)->house_rules : ''}}">
											<div class="background ml-3">
											@for($i=1; $i <=5 ; $i++)
												<i id="house_rules-{{$i}}" class="fa fa-star {{ $i <= isset($result->review_details($review_id)->house_rules) ? 'secondary-text-color':'icon-light-gray' }} icon-click"></i> 
											@endfor 
											</div>
										</div>

										<div class="form-group w-100  mt-5">
											<button class="btn vbtn-outline-success text-16 font-weight-700 pl-4 pr-4 pt-3 pb-3" type="submit" id="save_button">
												<i class="spinner fa fa-spinner fa-spin d-none"></i>
												<span id="save_button_text">{{ trans('messages.reviews.submit') }}</span>
											</button>
										</div>
									</form>
								</div>             
							</div>

							<div class="col-md-3">
								<div class="text-center card pt-3 pb-3">
									<a href="{{ url('users/show/'.$result->users->id) }}" title="{{ trans('messages.dashboard.view_profile') }}">
										<div class='img-round'>
											<img src="{{ $result->users->profile_src }}" alt="{{ $result->users->first_name }}" class="rounded-circle img-100x100">
										</div>
									</a>
								
								<div class="add-photo"><a href="#" class="text-color text-color-hover font-weight-700">{{ $result->users->first_name }}</a></div>
									<div class="row">
										<div class="col-md-12 ">
										<small class="text-15 text-center">{{ trans('messages.reviews.stayed_at') }}
											{{ $result->properties->name }}</small>
										{{-- <small class="float-left">{{ $result->dates }}</small> --}}
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
<script type="text/javascript">
	$('#open-review').on( 'click', function(){
	$('.opening-div').addClass('display-off');
	$('.review-div').removeClass('display-off');
	});
	$('.icon-click').on('mouseover', function(){
	var temp = $(this).attr('id');
	temp = temp.split('-');
	var name = temp[0];
	var val = temp[1];
	var prv = $('#'+name).val();
	$('#'+name).val(val);
	for(i = 1; i <= prv; i++){
		$('#'+name+'-'+i).removeClass('secondary-text-color');
		$('#'+name+'-'+i).addClass('icon-light-gray');
	}
	for(i = 1; i <= val; i++){
		$('#'+name+'-'+i).removeClass('icon-light-gray');
		$('#'+name+'-'+i).addClass('secondary-text-color');
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
	})
	$('#guest-form').on('submit', function(e){
	e.preventDefault();
	$('#save_button').addClass('disabled');
    $(".spinner").removeClass('d-none');
    $("#save_button_text").text("{{ trans('messages.reviews.submit') }}..");
    
	var booking_id = $('#booking_id').val();
	var review_id = $('#review_id').val();
	var message = $('#review_message').val();
	var secret_feedback = $('#secret_feedback').val(); 
	var cleanliness = $('#cleanliness').val();
	var rating = $('#rating').val();
	var communication = $('#communication').val();
	var house_rules = $('#house_rules').val();
	var recommend = $('#recommend').val();
	dataURL = APP_URL + "/reviews/edit/" + booking_id;

	$.ajax({
		url: dataURL,
		headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    	},
		data: {
			'review_id': review_id,
			'message': message,
			'secret_feedback': secret_feedback, 
			'cleanliness': cleanliness,
			'rating': rating,
			'communication': communication,
			'house_rules': house_rules,
			'recommend' : recommend,
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
	})
</script>
@endpush