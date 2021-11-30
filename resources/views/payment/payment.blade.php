@extends('layouts.master')

@section('main')
<div class="container-fluid container-fluid-90 margin-top-85 min-height">
	@if(Session::has('message'))
		<div class="row mt-5">
			<div class="col-md-12 text-13 alert mb-0 {{ Session::get('alert-class') }} alert-dismissable fade in  text-center opacity-1">
				<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('message') }}
			</div>
		</div>
	@endif 

	<div class="row justify-content-center">
		<div class="col-md-8 mb-5 mt-3 main-panel p-5 border rounded">
			<form action="{{ url('payments/create_booking') }}" method="post" id="checkout-form">
				{{ csrf_field() }}
				<div class="row justify-content-center">
				<input name="property_id" type="hidden" value="{{ $property_id }}">
				<input name="checkin" type="hidden" value="{{ $checkin }}">
				<input name="checkout" type="hidden" value="{{ $checkout }}">
				<input name="number_of_guests" type="hidden" value="{{ $number_of_guests }}">
				<input name="nights" type="hidden" value="{{ $nights }}">
				<input name="currency" type="hidden" value="{{ $result->property_price->code }}">
				<input name="booking_id" type="hidden" value="{{ $booking_id }}">
				<input name="booking_type" type="hidden" value="{{ $booking_type }}">
				<input name="discount_redeemed_points" type="hidden" value="">

				@if($status == "" && $booking_type == "request")
					<div class="h2 pb-4 m-0 text-24">{{ trans('messages.listing_book.request_message') }}</div>
				@endif
				@if($booking_type == "instant"|| $status == "Processing" )
					<div class="col-md-12 p-0">
						<label for="exampleInputEmail1">{{ trans('messages.payment.country') }}</label>
					</div>
				
					<div class="col-sm-12 p-0 pb-3">
						<select name="payment_country" id="country-select" data-saving="basics1" class="form-control mb20">
							@foreach($country as $key => $value)
							<option value="{{ $key }}" {{ ($key == $default_country) ? 'selected' : '' }}>{{ $value }}</option>
							@endforeach
						</select>
					</div>
				
					@if(Auth::user()->hasMaturePoints())
					<div class="col-sm-6 p-0 pt-2 pb-2">
						<label for="exampleInputEmail1">{{ trans('messages.payment.discount_points') }}</label>
						<br/><input type="number" id="points" name="points" min="0" max="{{ Auth::user()->totalMaturedPoints() }}" />
						<br/><span><small>{{ trans('messages.payment.help_discount_points') }}</small></span>
					</div>
					<div class="col-sm-6 p-0 pt-2 pb-2">
						<label for="exampleInputEmail1">{{ trans('messages.payment.applicable_discount') }}</label>
						<br/>$<span id="maximum_applicable_discount"></span>
						<br/><span><small>{{ trans('messages.payment.help_applicable_discount') }}</small></span>
					</div>

					@endif
					<div class="col-sm-12 p-0">
						<label for="exampleInputEmail1">{{ trans('messages.payment.payment_type') }}</label>
					</div>

					<div class="col-sm-12 p-0 pb-3">
						<select name="payment_method" class="form-control mb20" id="payment-method-select">
							@if($paypal_status->value == 1)
								<option value="paypal" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
								{{ trans('messages.payment.paypal') }} 
								</option>
							@endif

							@if($stripe_status->value == 1)  
								<option value="stripe" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
								{{ trans('messages.payment.stripe') }}
								</option>
							@else
								<option value="">
								{{ trans('messages.payment.disable') }}
								</option>
							@endif 
						</select>
						<div class="paypal-div">
							<span id='paypal-text'>{{ trans('messages.payment.redirect_to_paypal') }}</span>
						</div>
						
					</div>
				
				@endif
		
					<div class="col-sm-12 p-0">
						<label for="message"></label>
					</div>

					<div class="col-sm-12 p-0 pb-3">
						<textarea name="message_to_host" placeholder="{{ trans('messages.trips_active.type_message') }}" class="form-control mb20" rows="7" required></textarea>
					</div>

			
					<div class="col-sm-12 p-0 text-right mt-4">
						<button id="payment-form-submit" type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3">
							<i class="spinner fa fa-spinner fa-spin d-none"></i>
							{{ ($booking_type == 'instant') ? trans('messages.listing_book.book_now') : trans('messages.property.continue') }}
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-4  mt-3 mb-5">
				<div class="card p-3">
					<a href="{{ url('/') }}/properties/{{ $result->id}}">
						<img class="card-img-top p-2 rounded" src="{{ $result->cover_photo }}" alt="{{ $result->name }}" height="180px">
					</a>

					<div class="card-body p-2">
						<a href="{{ url('/') }}/properties/{{ $result->id}}">
							<p class="text-16 font-weight-700 mb-0">{{ $result->name }}</p>
						</a>
						@if ($result->property_address)
						<p class="text-14 mt-2 text-muted mb-0">
							<i class="fas fa-map-marker-alt"></i>
							{{$result->property_address->address_line_1}}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}
						</p>
						@else
							<p class="text-14 mt-2 text-muted mb-0"> </p>
						@endif
						<div class="border p-4 mt-4 text-center rounded-3">
							<p class="text-16 mb-0">
								<strong class="font-weight-700 secondary-text-color">{{ $result->property_type_name }}</strong> 
								{{trans('messages.payment.for')}}
								<strong class="font-weight-700 secondary-text-color">{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong> 
							</p>
							<div class="text-16"><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>					
						</div>

						<div class="border p-4 rounded-3 mt-4">
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.payment.night')}}</p>
								</div>
								<div>
									<p class="pr-4">{{ $nights }}</p>
								</div>
							</div>
							
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->property_price ) !!} x {{ $nights }} {{trans('messages.payment.nights')}}</p>
								</div>
								<div>
									<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->total_night_price ) !!}</p>
								</div>
							</div>
						
							@if($price_list->service_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.service_fee')}}</p>
									</div>
	
									<div>
										<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->service_fee ) !!}</p>
									</div>
								</div>
							@endif
							
							@if($price_list->additional_guest)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.additional_guest_fee')}}</p>
									</div>
	
									<div>
										<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->additional_guest ) !!}</p>
									</div>
								</div>
							@endif
						
							@if($price_list->security_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.security_deposit')}}</p>
									</div>
	
									<div>
										<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol,  $price_list->security_fee ) !!}</p>
									</div>
								</div>
							@endif
							
							@if($price_list->cleaning_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.cleaning_fee')}}</p>
									</div>
	
									<div>
										<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->cleaning_fee )!!}</p>
									</div>
								</div>
							@endif
							<hr>
						
							<div class="d-flex justify-content-between font-weight-700">
								<div>
									<p class="pl-4">{{trans('messages.payment.total')}}</p>
								</div>
	
								<div>
									<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->total ) !!}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<p class="exfont text-16">
							{{trans('messages.payment.paying_in')}}
							<strong><span id="payment-currency">{!! moneyFormat($currencyDefault->org_symbol,$currencyDefault->code) !!}</span></strong>.
							{{trans('messages.payment.your_total_charge')}}
							<strong><span id="payment-total-charge">{!! moneyFormat($currencyDefault->org_symbol, $price_eur) !!}</span></strong>.
							{{trans('messages.payment.exchange_rate_booking')}} {!! $currencyDefault->org_symbol !!} 1 to {!! moneyFormat($result->property_price->currency->org_symbol, $price_rate ) !!} {{ $result->property_price->currency_code }} ( {{trans('messages.listing_book.host_currency')}} ).
						</p>
					</div>
				</div>
				
			
		</div>
	</div>
</div>
@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$('#payment-method-select').on('change', function(){
  var payment = $(this).val();
  if(payment == 'stripe'){
    $('.cc-div').addClass('display-off');
    $('.paypal-div').addClass('display-off');
  }else {
    $('#paypal-text').html('You will be redirected to PayPal.');
    $('.cc-div').addClass('display-off');
    $('.paypal-div').removeClass('display-off');
  }
});

$(document).ready(function() {
	$('#points').change(function(){
		val = ($(this).val()*0.01);
		$('#maximum_applicable_discount').html(val);
	});
	
    $('#checkout-form').validate({        
        submitHandler: function(form)
        {
 			$("#payment-form-submit").on("click", function (e)
            {	
            	$("#payment-form-submit").attr("disabled", true);
                e.preventDefault();
            });


            $(".spinner").removeClass('d-none');
            $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
            return true;
        }
    });
});


$('#country-select').on('change', function() {
  var country = $(this).find('option:selected').text();
  $('#country-name-set').html(country);
})
</script>
@endpush 
@stop