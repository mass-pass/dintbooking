@extends('layouts.master')
@section('main')
<div class="container-fluid container-fluid-90 margin-top-85 min-height">
	<div class="row">
		<div class="col-md-8 col-sm-8 col-xs-12 mb-5 main-panel p-5 border rounded">
			<div class="pb-3 m-0 text-24 font-weight-700">{{trans('messages.payment.stripe')}} {{trans('messages.payment.payment')}} </div>
			<form action="{{URL::to('payments/stripe-request')}}" method="post" id="payment-form">
				{{ csrf_field() }}
				<div class="form-row p-0 m-0">
				<label for="card-element">
					{{trans('messages.payment_stripe.credit_debit_card')}}
				</label>
				<div id="card-element">
				<!-- a Stripe Element will be inserted here. -->
				</div>
	
				<!-- Used to display form errors -->
				<div id="card-errors" role="alert"></div>
			</div>
			<div class="form-group mt-5">
				<div class="col-sm-8 p-0">
					<button class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="stripe_btn"><i class="spinner fa fa-spinner fa-spin d-none"></i> {{trans('messages.payment_stripe.submit_payment')}}</button>
				</div>
			</div>
		</form>
		</div>
	
		<div class="col-md-4 mb-5">
			<div class="card p-3">
				<img class="card-img-top p-2 rounded" src="{{$result->cover_photo}}" alt="{{$result->name}}" height="180px">
				<div class="card-body p-2">
					<p class="text-16 font-weight-700 mb-0">{{ $result->name }}</p>
					@if($result->property_address)
					<p class="text-14 mt-2 text-muted mb-0">
						<i class="fas fa-map-marker-alt"></i>
						{{$result->property_address->address_line_1}}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}
					</p>
					@else
					<p class="text-14 mt-2 text-muted mb-0">
						<i class="fas fa-map-marker-alt"></i>
					</p>
					@endif
					<div class="border p-4 mt-4 text-center">
						<p class="text-16 mb-0">
							<strong class="font-weight-700 secondary-text-color">{{ $result->property_type_name }}</strong> 
							{{trans('messages.payment.for')}}
							<strong class="font-weight-700 secondary-text-color">{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong> 
						</p>
						<div class="text-14"><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>					
					</div>

					<div class="border p-4 mt-3">
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
									<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->additional_guest )!!}</p>
								</div>
							</div>
						@endif
					
						@if($price_list->security_fee)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.payment.security_deposit')}}</p>
								</div>

								<div>
									<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol,  $price_list->security_fee )!!}</p>
								</div>
							</div>
						@endif
						@if($price_list->discount)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.payment.discount')}}</p>
								</div>

								<div>
									<p class="pr-4">- {!! moneyFormat($result->property_price->currency->symbol, $price_list->discount ) !!}</p>
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
					
						<div class="d-flex justify-content-between font-weight-700 text-16">
							<div>
								<p class="pl-4">{{trans('messages.payment.total')}}</p>
							</div>

							<div>
								<p class="pr-4">{!! moneyFormat($result->property_price->currency->symbol, $price_list->total )!!}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body text-16">
					<p class="exfont">
						{{trans('messages.payment.paying_in')}}
						<strong><span id="payment-currency">{!!moneyFormat($currencyDefault->org_symbol,$currencyDefault->code)!!}</span></strong>.
						{{trans('messages.payment.your_total_charge')}}
						<strong><span id="payment-total-charge">{!! moneyFormat($currencyDefault->org_symbol, $price_eur) !!}</span></strong>.
						{{trans('messages.payment.exchange_rate_booking')}} {!! $currencyDefault->org_symbol !!} 1 to {!! moneyFormat($result->property_price->currency->org_symbol, $price_rate ) !!} {!! $result->property_price->currency_code !!} ( {{trans('messages.listing_book.host_currency')}} ).
					</p>
				</div>
			</div>
			
		
	</div>
	</div>
</div>
@push('scripts')
@if (Request::path() == 'payments/stripe')
	<script src="https://js.stripe.com/v3/"></script>
@endif
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script>

</script>
<script type="text/javascript">
	// Create a Stripe client
	var stripe = Stripe('{{$publishable}}');

	// Create an instance of Elements
	var elements = stripe.elements();

	// Custom styling can be passed to options when creating an Element.
	// (Note that this demo uses a wider set of styles than the guide below.)
	var style = {
		base: {
		color: '#32325d',
		lineHeight: '24px',
		fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
		fontSmoothing: 'antialiased',
		fontSize: '16px',
		'::placeholder': {
			color: '#aab7c4'
		}
		},
		invalid: {
		color: '#fa755a',
		iconColor: '#fa755a'
		}
	};

	// Create an instance of the card Element
	var card = elements.create('card', {style: style});

	// Add an instance of the card Element into the `card-element` <div>
	card.mount('#card-element');

	// Handle real-time validation errors from the card Element.
	card.addEventListener('change', function(event) {
		var displayError = document.getElementById('card-errors');
		if (event.error) {
		displayError.textContent = event.error.message;
		} else {
		displayError.textContent = '';
		}
	});

	// Handle form submission
	var form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
		event.preventDefault();

		stripe.createToken(card).then(function(result) {
		if (result.error) {
			// Inform the user if there was an error
			var errorElement = document.getElementById('card-errors');
			errorElement.textContent = result.error.message;
		} else {
			// Send the token to your server
			stripeTokenHandler(result.token);
		}
		});
	});

	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var form = document.getElementById('payment-form');
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'stripeToken');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);

		$("#stripe_btn").on("click", function (e)
        {	
        	$("#stripe_btn").attr("disabled", true);
            e.preventDefault();
        });

        $(".spinner").removeClass('d-none');
        $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");

		$("#payment-form").trigger("submit");

	}
	</script>
@endpush 
@stop