@extends('layouts.master')

@section('main')
<div class="margin-top-85">
	<div class="row m-0">
		@include('users.sidebar')
		<div class="col-lg-10">
			<div class="main-panel">
				<div class="container-fluid min-height">
					<div class="row">
						<div class="col-md-12 p-0 mb-3">
							<div class="list-bacground mt-4 rounded-3 p-4 border">
								<span class="text-18 pt-4 pb-4 font-weight-700">
									{{trans('messages.users_dashboard.my_trips')}}
								</span>

								@if($bookings->total()>0)
								<div class="float-right">
									<div class="d-flex">
										<div class="pr-4">
											<span class="text-14 pt-2 pb-2 font-weight-700">{{trans('messages.users_dashboard.sort_by')}}</span>
										</div>

										<div>
											<form action="{{url('/trips/active')}}" method="POST" id="my-trip-form">
												{{ csrf_field() }}
												<select class="form-control room-list-status text-14 minus-mt-6" name="status" id="trip_select">
													<option value="All" {{ $status == "All" ? ' selected="selected"' : '' }}>All</option>
													<option value="Current" {{ $status == "Current" ? ' selected="selected"' : '' }}>Current</option>
													<option value="Upcoming" {{ $status == "Upcoming" ? ' selected="selected"' : '' }}>Upcoming</option>
													<option value="Pending" {{ $status == "Pending" ? ' selected="selected"' : '' }}>Pending</option>
													<option value="Completed" {{ $status == "Completed" ? ' selected="selected"' : '' }}>Completed</option>
													<option value="Expired" {{ $status == "Expired" ? ' selected="selected"' : '' }}>Expired</option>
												</select>
											</form>
										</div>
									</div>
								</div>
								@endif
							</div>
						</div>
					</div>
					@if(Session::has('message'))
					<div class="alert alert-success text-center" role="alert" id="alert">
                        <span id="messages">{{ Session::get('message') }}</span>
                    </div>
                    @endif

					@if($bookings->total()>0)
					@foreach($bookings as $booking)
						<?php 
                            if ($booking->created_at < $yesterday && $booking->status != 'Accepted') {

                                $booking->status = 'Expired';
                            } 
                        ?>
					<div class="row border border p-2  rounded-3 mt-4">
						<div class="col-md-3 col-xl-4 p-2">
							<div class="img-event">
								<a href="{{ url('/') }}/properties/{{ $booking->property_id}}">
									<img class="img-fluid rounded" src="{{ $booking->properties->cover_photo }}" alt="cover_photo">
								</a>  
							</div>
						</div>
						
						<div class="col-md-9 col-xl-8 pl-2">
							<div class="row m-0 pr-4">
								<div class="col-10 col-sm-9 p-0">
									<a href="{{ url('/') }}/properties/{{ $booking->property_id}}">
										<p class="mb-0 text-18 text-color font-weight-700 text-color-hover pr-2">{{ $booking->properties->name}} </p>     
									</a>
								</div>

								<div class="col-2 col-sm-3">
									<span class="badge vbadge-success text-13 mt-3 p-2 {{ $booking->status}}">{{ $booking->status}}</span>
								</div>
							</div>

							<div class="d-flex justify-content-between ">
								<div>
									<p class="text-14 text-muted mb-0">
										<i class="fas fa-map-marker-alt"></i>
										{{ ($booking->properties && $booking->properties->property_address) ? $booking->properties->property_address->address_line_1 : ''}}
									</p>
									<p class="text-14 mt-3"> 
										<i class="fas fa-calendar"></i> {{ date(' M d, Y', strtotime($booking->start_date)) }}  -  {{ date(' M d, Y', strtotime($booking->end_date)) }}
									</p>
	
									<p class="text-14 mt-3">
										<span class="{{$booking->status == 'Accepted' ? '' : 'd-none' }}">
											<a href="{{ url('/') }}/booking/receipt?code={{ $booking->code }}">
												<i class="fas fa-receipt"></i> {{trans('messages.trips_active.view_receipt')}}
											</a>
											
										</span>

										<span class="{{$booking->status == 'Processing' ? '' : 'd-none' }}">
											<a href="{{ url('/') }}/booking_payment/{{ $booking->id }}">
												<i class="fab fa-cc-amazon-pay"></i>  Make {{trans('messages.payment.payment')}}
											</a>
											
										</span>

									</p>
								</div>

								<div class="pr-2 mt-5 mt-sm-0">
									<div class="align-self-center  mt-sm-0 w-100">
										<div class="row justify-content-center">
											<div class='img-round '>
												<a href="{{ url('/') }}/users/show/{{ $booking->host_id}}">
													<img src="{{ $booking->host->profile_src }}" alt="{{ $booking->host->first_name }}" class="circle-avatar img-70x70">
												</a>
											</div>
										</div>

										<p class="text-center font-weight-700 mb-0">
											<a href="{{ url('/') }}/users/show/{{ $booking->host_id}}" class="text-color text-color-hover">
												{{ $booking->host->first_name}}
											</a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					<div class="row justify-content-between overflow-auto pb-3 mt-4 mb-5">
						{{ $bookings->appends(request()->except('page'))->links()}}
					</div>
					@else
					<div class="row jutify-content-center position-center w-100 p-4 mt-4 ">
						<div class="text-center w-100">
							<img src="{{ url('img/unnamed.png')}}"   alt="notfound" class="img-fluid">
							<p class="text-center"> {{trans('messages.message.empty_tripts')}} </p>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@push('scripts')
    <script type="text/javascript">
        $(document).on('change', '#trip_select', function(){

            $("#my-trip-form").trigger("submit"); 
              
        });
    </script>
@endpush