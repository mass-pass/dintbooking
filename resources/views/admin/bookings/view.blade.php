	@php
	@endphp
	@extends('admin.template') 
		@section('main')
			<div class="content-wrapper">
				<section class="content-header">
					<h1>Bookings<small>Control panel</small></h1>
					@include('admin.common.breadcrumb')
				</section>

				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/bookings') }}" method="GET" accept-charset="UTF-8">
										{{ csrf_field() }}
										<div class="col-md-12  d-none">
											<input class="form-control" type="text" id="startDate"  name="from" value="<?= isset($from) ? $from : '' ?>" hidden>
											<input class="form-control" type="text" id="endDate"  name="to" value="<?= isset($to) ? $to : '' ?>" hidden>
										</div>
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<div class="col-md-3 col-sm-3 col-xs-12">
														<label>Date Range</label>
														<div class="input-group  col-xs-12">
															<button type="button" class="form-control" id="daterange-btn">
																<span class="pull-left">
																	<i class="fa fa-calendar"></i>  Pick a date range
																</span>
																<i class="fa fa-caret-down pull-right"></i>
															</button>
														</div>
													</div>

													<div class="col-md-3 col-sm-3 col-xs-12">
														<label>Property</label>
														<select class="form-control select2" name="property" id="property">
															<option value="">All</option>
															@if(!empty($properties))
																@foreach($properties as $property)
																	<option value="{{$property->id}}" "{{$property->id == $allproperties ? ' selected="selected"' : ''}}">{{$property->name}}</option>
																@endforeach
															@endif
														</select>
													</div>

													<div class="col-md-2 col-sm-2 col-xs-12">
														<label>Customer</label>
														<select class="form-control select2customer" name="customer" id="customer">
															<option value="">All</option>
															@if(!empty($customers))
																@foreach($customers as $customer)
																		<option value="{{$customer->id}}" "{{ $customer->id == $allcustomers ? ' selected="selected"' : ''}}">{{$customer->first_name." ".$customer->last_name}}</option>
																@endforeach
															@endif
														</select>
													</div>

													<div class="col-md-2 col-sm-2 col-xs-12">
														<label>Status</label>
														<select class="form-control" name="status" id="status">
															<option value="" >All</option>
															<option value="Accepted" {{ $allstatus == "Accepted" ? ' selected="selected"' : '' }}>Accepted</option>
															<option value="Cancelled"  {{ $allstatus == "Cancelled"  ? ' selected="selected"' : '' }}>Cancelled</option>
															<option value="Declined" {{ $allstatus == "Declined" ? ' selected="selected"' : '' }}>Declined</option>
															<option value="Expired"  {{ $allstatus == "Expired"  ? ' selected="selected"' : '' }}>Expired</option>
															<option value="Pending"  {{ $allstatus == "Pending"  ? ' selected="selected"' : '' }}>Pending</option>
														</select>
													</div>

													<div class="col-md-1 col-sm-2 col-xs-4">
														<br>
														<button type="submit" name="btn" class="btn btn-primary btn-flat">Filter</button>
													</div>

													<div class="col-md-1 col-sm-2 col-xs-4"> 
														<br>
														<button type="submit" name="reset_btn" class="btn btn-primary btn-flat">Reset</button>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<div class="row">
										<div class="col-md-2">
											<div class="panel panel-primary">
												<div class="panel-body text-center">
													<span class="text-20">{{ $total_bookings }}</span><br>
													<span class="font-weight-bold total-book">Total Bookings</span>
												</div>
											</div>
										</div>
										
										<div class="col-md-2">
											<div class="panel panel-primary">
												<div class="panel-body text-center">
													<span class="text-20">{{ $total_customers }}</span><br>
													<span class="font-weight-bold total-customer">Total Customers</span>
												</div>
											</div>
										</div> 

										@if($different_total_amounts)
											@foreach($different_total_amounts as $total_amount)
											<div class="col-md-2">
												<div class="panel panel-primary">
													<div class="panel-body text-center">
														<span class="text-20">{!! $total_amount['total'] !!}</span><br>
														Total<span class="font-weight-bold total-amount"> {{ $total_amount['currency_code'] }}</span> amount
													</div>
												</div>
											</div>
											@endforeach
										@endif
									</div> 
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-body">
									<div class="table-responsive">
										{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0']) !!}
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		@endsection
	@push('scripts')
	<script src="{{ asset('backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
	{!! $dataTable->scripts() !!}
	@endpush 
	@section('validate_script')
	<script src="{{ asset('js/admin/validate.js') }}"></script>
	@endsection