@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
<section>
	<div v-cloak id="dashboardController" class="content-wrapper" style="padding-top:120px;">
		<div class="container">
			<div class="content-header">
				<div class="dash-info">
					<ul class="list-inline mb-0">
						<li class="list-inline-item ">
							{{date("F d, Y")}}
						</li>
						
					</ul>
				</div>
				<div class="dash-links">
					<ul class="list-inline mb-0">
						<li class="list-inline-item">
							<a href="javascript:void(0)" v-on:click="printWindow()" class="btn btn-sm btn-light"><i class="fas fa-print"></i></a>
						</li>
						<li class="list-inline-item">
							<a href="" class="btn btn-sm btn-light"><i class="fas fa-sync-alt"></i></a>
						</li>
						<li class="list-inline-item">
							<a href="{{ route('partner.bookings.new', ['property' => $current_property_id])}}" class="btn btn-sm btn-success text-uppercase">Create new reservation</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="content-body">

				<!-- Top boxes starts -->
				<div class="top-boxes">
					<div class="row">
						<div class="col-md-4">
							<div class="top-box-item shadow-sm">
								<div class="top-box-header">
									<span class="count">{{count($today_arrivals)}}</span>
									<span class="icon">
										<i class="far fa-bell "></i>
									</span>
								</div>
								<div class="top-box-body">
									<h6 class="mb-0">Arrivals</h6>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-box-item shadow-sm">
								<div class="top-box-header">
									<span class="count text-danger">{{count($today_departure)}}</span>
									<span class="icon">
										<i class="fa fa-sign-out-alt "></i>
									</span>
								</div>
								<div class="top-box-body">
									<h6 class="mb-0">Departures</h6>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="top-box-item shadow-sm">
								<div class="top-box-header">
									<span class="count text-primary">{{count($today_booked)}}</span>
									<span class="icon">
										<i class="fas fa-percentage "></i>
									</span>
								</div>
								<div class="top-box-body">
									<h6 class="mb-0">Accommodations Booked</h6>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Top boxes ends -->


				<!-- Reservation and activity table wrapper starts -->
				<div class="table-wrapper mb-4">
					<div class="row">

						<!-- Reservation table wrapper starts -->
						<div class="col-md-6">
							<div class="card shadow-sm">
								<div class="card-header">
									<h6 class="mb-0">Reservations</h6>
									<div class="right-header ">
										<ul class="list-inline mb-0 right-list">
											<li class="list-inline-item">
												<a href="javascript:void(0)" v-on:click="setReservationData()">
													<i class="fa fa-sync-alt"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<div class="top-navs">
										<ul class="nav nav-pills re-nav">
											<li class="nav-item">
												<span v-on:click="reservationTabChange(1)" class="nav-link" v-bind:class="{active: reservation.activeTab == 1}">Arrivals</span>
											</li>
											<li class="nav-item">
												<span v-on:click="reservationTabChange(2)" class="nav-link" :class="{active: reservation.activeTab == 2}">Depatures</span>
											</li>
											<li class="nav-item">
												<span v-on:click="reservationTabChange(3)" class="nav-link" :class="{active: reservation.activeTab == 3}">Stayovers</span>
											</li>
											<li class="nav-item">
												<span v-on:click="reservationTabChange(4)" class="nav-link" :class="{active: reservation.activeTab == 4}">In-House Guests</span>
											</li>
										</ul>
									</div>
									<div class="col-sm-12 ajaxhidden-re" v-if="reservation.showLoader">
										<div class="col-sm-4 offset-sm-4">
											<img class="ldlz m-4" data-src="{{url('img/loading.gif')}}" src="{{url('img/loading.gif')}}"  style="width: 128px; height: 128px; opacity: 1; visibility: visible;">
										</div>
									</div>
									<div class="table-wrapper ajaxresult-re" v-if="!reservation.showLoader">
										@include('partner.dashboard.reservations')
                                    </div>
								</div>
							</div>
						</div>
						<!-- Reservation table wrapper ends -->
						
						<!-- Activity table wrapper starts -->
						<div class="col-md-6">
							<div class="card shadow-sm">
								<div class="card-header">
									<h6 class="mb-0">Today's activity</h6>
									<div class="right-header ">
										<ul class="list-inline mb-0 right-list">
											<li class="list-inline-item">
												<a href="javascript:void(0)" v-on:click="setActivityData()">
													<i class="fa fa-sync-alt"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<div class="top-navs">
										<ul class="nav nav-pills ac-nav">
											<li class="nav-item">
												<span v-on:click="activityTabChange(1)" class="nav-link" v-bind:class="{active: activity.activeTab == 1}">Sales</span>
											</li>
											<li class="nav-item">
												<span v-on:click="activityTabChange(2)" class="nav-link" v-bind:class="{active: activity.activeTab == 2}">Cancellations</span>
											</li>
											<li class="nav-item">
												<span v-on:click="activityTabChange(3)" class="nav-link" v-bind:class="{active: activity.activeTab == 3}">Overbookings</span>
											</li>
										</ul>
									</div>
									<div class="col-sm-12 ajaxhidden-ac" v-if="activity.showLoader">
											<div class="col-sm-4 offset-sm-4">
											<img class="ldlz m-4" data-src="{{url('img/loading.gif')}}" src="{{url('img/loading.gif')}}"  style="width: 128px; height: 128px; opacity: 1; visibility: visible;">
											</div>
									 </div>
									<div class="table-wrapper ajaxresult-ac" v-if="!activity.showLoader">
										@include('partner.dashboard.activity')
									</div>
								</div>
							</div>
						</div>
						<!-- Activity table wrapper ends -->

					</div>
				</div>
				<!-- Reservation and activity table wrapper ends -->


				<!-- main table wrapper starts -->
				<div class="table-wrapper mb-4">
					<div class="row">
						<div class="col-md-12">
							<div class="card shadow-sm">
								<div class="card-header">
									<h6 class="mb-0">14 day outlook</h6>
									<div class="right-header ">
										<ul class="list-inline mb-0 right-list">
											<li class="list-inline-item">
												<a href="javascript:void(0)" v-on:click="setFourtenDateData(2)">
													<i class="fa fa-sync-alt"></i>
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="card-body">
									<div class="table-wrapper">
										<div class="table-header-wrapper">
											<div class="row">
												<div class="col-md-9">
													<div class="row">
														<div class="col-md-3 ajaxresult" v-if="!fourtenDate.showLoader">
															<div class="today-item">
																<span class="count totalPer"> @{{ fourtenDate.data.totalPer }} </span>
																<span class="title">14 days occupancy</span>
															</div>
														</div>
														<div class="col-md-3 ajaxresult"  v-if="!fourtenDate.showLoader">
															<div class="today-item">
																<span class="count total_earnings"> @{{ fourtenDate.data.total_earnings }} </span>
																<span class="title">14 days revenue</span>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3 ajaxresult"  v-if="!fourtenDate.showLoader">
													<div class="input-group calenderView">
														<div v-on:click="setFourtenDateData(0)" class="input-group-prepend">
															<span class="input-group-text"><i class="fa fa-chevron-left"></i></span>
														</div>
														<input type="text" id="calendar_selected_date" class="form-control" v-model="fourtenDate.data.displayStartDate">
														<div v-on:click="setFourtenDateData(1)" class="input-group-append">
															<span class="input-group-text"> <i class="fa fa-chevron-right"></i></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-sm-12 ajaxhidden" v-if="fourtenDate.showLoader">
											<div class="col-sm-4 offset-sm-4">
											<img class="ldlz m-4" data-src="{{url('img/loading.gif')}}" src="{{url('img/loading.gif')}}"  style="width: 128px; height: 128px; opacity: 1; visibility: visible;">
											</div>
										</div>
										<div class="table-header mb-0 border-0 ajaxresult" v-if="!fourtenDate.showLoader">
											<div class="tab-links">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item" role="presentation">
														<a class="nav-link " id="blocked-tab" data-toggle="tab" href="#blocked" role="tab" aria-controls="blocked" aria-selected="true">Accommodations Booked + Blocked</a>
													</li>
													<li class="nav-item" role="presentation">
														<a class="nav-link active" id="Avail-tab" data-toggle="tab" href="#Avail" role="tab" aria-controls="Avail" aria-selected="false">Availability</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="table-body ajaxresult" v-if="!fourtenDate.showLoader">
											<div class="tab-content">
												<div class="tab-pane fade" id="blocked">
													<div class="table-responsive">
														<table class="table ">
															<thead class="total-row-date">
																<tr>
																	<td>Available Accommodations</td>
																	<td v-for="(booking, index) in fourtenDate.data.bookings"> 
																		<p class="date"> @{{ (index == 0) ? fourtenDate.data.dateHead : ''}}</p>
																		<span class="badge badge-danger" :class="{ active: booking.data.length > 0}"> @{{ booking.data.length }} </span>
																		<p class="day"> @{{ booking.dateDisplay }}</p>
																	</td>
																</tr>
															</thead>
															  <tbody>
																@php
																$rooms = 0;
																@endphp
																@foreach($properties->first()->property_layouts as $propertyLayouts)
																@php
																// $rooms = $rooms + $property->rooms;
																@endphp
																<tr class="{{$propertyLayouts->id}}-row each-row-date">
																	<td> {{($propertyLayouts->title_custom != '') ? $propertyLayouts->title_custom : $propertyLayouts->title}} </td>
																	<td v-for="(booking, index) in fourtenDate.data.bookings">
																		<span class="badge badge-danger" :class="{ active: booking.data.length > 0}"> @{{ booking.data.length }} </span>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
													</div>

												</div>
												<div class="tab-pane fade show active" id="Avail">
													<div class="table-responsive">
														<table class="table  ">
															<thead class="total-row-date">
																<tr>
																	<td>Available Accommodations</td>
																	<td v-for="(booking, index) in fourtenDate.data.bookings"> 
																		<p class="date"> @{{ (index == 0) ? fourtenDate.data.dateHead : ''}}</p>
																		<span class="badge badge-danger" :class="{ active: booking.data.length > 0}"> @{{ booking.data.length }} </span>
																		<p class="day"> @{{ booking.dateDisplay }}</p>
																	</td>
																</tr>
															</thead>
															<tbody>
																@foreach($properties->first()->property_layouts as $propertyLayouts)
																<tr class="{{$propertyLayouts->id}}-row each-row-date-ava">
																	<td> {{($propertyLayouts->title_custom != '') ? $propertyLayouts->title_custom : $propertyLayouts->title}} </td>
																	<td v-for="(booking, index) in fourtenDate.data.bookings">
																		<span class="badge badge-danger" :class="{ active: booking.data.length > 0}"> @{{ booking.data.length }} </span>
																	</td>
																</tr>
																@endforeach
															</tbody>
														</table>
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
				<!--main table wrapper ends -->
			</div>
		</div>
	</div>
</section>

@stop

@push('scripts')
	<script type="text/javascript">
		var token = $('meta[name=csrf-token]').attr('content');
		var current_property_id = <?php echo "'" . $current_property_id . "'"; ?>;
		var properties_ids = <?php echo json_encode($properties_ids); ?>;
		var rooms = <?php echo $rooms; ?>;
	</script>
	<script type='text/javascript' src="{{ URL::to('/') }}/js/partner/dashboard/dashboard.js"></script>
@endpush



