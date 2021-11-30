	<div class="w-100 overflow-auto right-inbox p-3">
		<a href="{{ url('/') }}/properties/{{ $booking->property_id}}"><h4 class="text-left text-15 font-weight-700 pl-2 ">{{$booking->properties->name}}</h4></a>	 
		<span class="street-address text-muted text-14 pl-4">
			<i class="fas fa-map-marker-alt mr-2"></i>{{ ($booking->properties && $booking->properties->property_address) ? $booking->properties->property_address->address_line_1 : ''}}
		</span>
		<div class="row p-2">
			<div class="col-md-12 border p-2">
				<div class="d-flex  justify-content-between">
					<div>
						<div class="text-16"><strong>{{trans('messages.header.check_in')}}</strong></div>
						<div class="text-14">{{$booking->start_date}}</div>
					</div>

					<div>
						<div class="text-16"><strong>{{trans('messages.header.check_out')}}</strong></div>
						<div class="text-14">{{$booking->end_date}}</div>
					</div>

				</div>
			</div>
		</div>

		<div class="row p-2">
			<div class="col-md-12 col-sm-6 col-xs-6 border border-success pl-3 pr-3 text-center pt-3 pb-3 mt-3 rounded-3">
				<p class="text-16 font-weight-700 text-success pt-0 m-0">
					<i class="fas fa-bed text-20 d-none d-sm-inline-block pr-2 text-success"></i><strong>{{$booking->guest}}</strong> <!-- <br> --> {{trans('messages.header.guest')}} </p>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12 p-2">
					<h5 class="text-16 mt-3"><strong>{{trans('messages.payment.payment')}}</strong></h5>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 p-2">
					<div class="full-table mt-3 border text-dark rounded-3 pt-3 pb-3 mb-4">
						<p class="row margin-top10 text-justify text-16">
							<span class="text-left col-sm-6 text-14">${{$booking->per_night}} x {{$booking->total_night}} {{trans('messages.property_single.night')}} </span>
							<span class="text-right col-sm-6 text-14">${{$booking->per_night * $booking->total_night}} </span>
						</p>

						<p class="row margin-top10 text-justify text-16">
							<span class="text-left col-sm-6 text-14">{{trans('messages.property_single.service_fee')}}</span>
							<span class="text-right col-sm-6 text-14">${{$booking->service_charge}}</span>
						</p>

						<p class="row margin-top10 text-justify text-16">
							<span class="text-left col-sm-6 text-14">{{trans('messages.property_single.total')}}</span>
							<span class="text-right col-sm-6 text-14">${{$booking->total}}</span>
						</p>
					</div>	
				</div>
			</div>

		</div>
