@extends('layouts.master')

@section('main')
<div class="container-fluid container-fluid-90 margin-top-85 min-height">
	<div class="row">
		<div class="col-md-8 mb-5 mt-3 main-panel p-5 border rounded">
			<div class="col-lg-12 p-0">
				@if($booking_details->status == 'Pending')
					<h2 class="font-weight-700">{{ trans('messages.booking_request.request_has_sent') }}</h2>
					<p>{{ trans('messages.booking_request.not_a_confirmed_booking') }} {{ trans('messages.booking_request.hear_back_within_24') }} {{ trans('messages.booking_request.not_be_charged') }} {{$booking_details->properties->users->first_name}} {{ trans('messages.booking_request.accommodate_stay') }}.</p>
				@endif
			
				@if($booking_details->status == 'Accepted')
					<h2>{{trans('messages.booking_request.get_ready')}} {{ $booking_details->properties->property_address->city }}!</h2>
					<p>{{trans('messages.booking_request.confirmed_booking')}} {{$booking_details->properties->users->first_name}}. {{trans('messages.booking_request.emailed_itinerary')}} {{$booking_details->properties->users->email}}.</p>
				@endif
			</div>
		
			
		</div>

		<div class="col-md-4">
			<div class="card mt-3 mb-5 p-3">
				<a href="{{ url('/') }}/properties/{{ $booking_details->properties->id}}">
					<img class="card-img-top p-2 rounded" src="{{$booking_details->properties->cover_photo}}" alt="{{$booking_details->properties->name}}" height="180px">
				</a>

				<div class="card-body p-4">
					<a href="{{ url('/') }}/properties/{{ $booking_details->properties->id}}">
						<p class="text-16 font-weight-700 mb-0">{{ $booking_details->properties->name }}</p>
					</a>
					
					<p class="text-14 mt-2 text-muted mb-0">
						<i class="fas fa-map-marker-alt"></i>
						{{$booking_details->properties->property_address->address_line_1}}, {{ $booking_details->properties->property_address->state }}, {{ $booking_details->properties->property_address->country_name }}
					</p>
					<div class="border p-4 mt-3 text-center rounded-3">
						<p class="text-16 mb-0">
							<strong class="font-weight-700 secondary-text-color">{{ $booking_details->properties->property_type_name }}</strong> 
							{{trans('messages.payment.for')}}
							<strong class="font-weight-700 secondary-text-color">{{ $booking_details->guest }} {{trans('messages.payment.guest')}}</strong> 
						</p>
						<div class="text-16"><strong>{{ date('D, M d, Y', strtotime($booking_details->startdate_dmy)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($booking_details->enddate_dmy)) }}</strong></div>					
					</div>

					<div class="border p-2 mt-3 rounded-3">
						<div class="d-flex justify-content-between text-16">
							<div>
								<p class="pl-4">{{trans('messages.booking_detail.night')}}</p>
							</div>

							<div>
								<p class="pr-4">{{ $booking_details->total_night }}</p>
							</div>
						</div>

						<div class="d-flex justify-content-between text-16">
							<div>
								<p class="pl-4">{{trans('messages.booking_detail.guest')}}</p>
							</div>

							<div>
								<p class="pr-4">{{ $booking_details->guest}}</p>
							</div>
						</div>

						<div class="d-flex justify-content-between text-16">
							<div>
								<p class="pl-4">{{trans('messages.booking_detail.rate_per_night')}}</p>
							</div>

							<div>
								<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->per_night }}</p>
							</div>
						</div>

						@if($booking_details->cleaning_charge != 0)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.booking_detail.cleanning_fee')}}</p>
								</div>

								<div>
									<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->cleaning_charge }}</p>
								</div>
							</div>
						@endif

						@if($booking_details->guest_charge != 0)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.booking_detail.additional_guest_fee')}}</p>
								</div>

								<div>
									<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->guest_charge }}</p>
								</div>
							</div>
						@endif

						@if($booking_details->security_money != 0)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.booking_detail.security_fee')}}</p>
								</div>

								<div>
									<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->security_money }}</p>
								</div>
							</div>
						@endif

						<div class="d-flex justify-content-between text-16">
							<div>
								<p class="pl-4">{{trans('messages.booking_detail.subtotal')}}</p>
							</div>

							<div>
								<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->base_price }}</p>
							</div>
						</div>

						@if($booking_details->host_fee)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.booking_detail.host_fee')}}</p>
									<i class="icon icon-question icon-question-sign" data-behavior="tooltip" rel="tooltip" aria-label="dint charges a fee to cover the cost (banking fees) of processing payment from the traveler."></i>

								</div>

								<div>
									<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->host_fee }}</p>
								</div>
							</div>
						@endif

						<hr>
						<div class="d-flex justify-content-between text-16 font-weight-700"  id="total">
							<div>
								<p class="pl-4">{{trans('messages.booking_detail.total_payout')}}</p>
							</div>

							<div>
								<p class="pr-4">{!! $booking_details->currency->symbol !!}{{ $booking_details->host_payout }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@push('scripts')
<script type="text/javascript">
	$('#request-add-email').on('click', function(){
		var content = '<div class="form-group">'
			+'<input type="email" name="friend[]" class="form-control" id="exampleInputPassword1" placeholder="Email">'
			+'</div>';
		$(content).insertBefore('#add-email-field');
	});
</script>
@endpush
@stop