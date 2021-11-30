@extends('layouts.master')
<link rel="stylesheet" type="text/css" href="{{ url('css/jquery-ui.min.css')}}" />
@section('main')
<!-- Modal -->
<!-- Button trigger modal -->
<div class="modal fade margin-top-85" id="hotel_date_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title text-16 font-weight-700" id="exampleModalLabel">{{trans('messages.listing_calendar.calendar_title')}}</h5>
				<button type="button" class="close text-28 mt-m-15" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body pl-5 pr-5">
				<form method="post" action="hotel_date_package/" class='form-horizontal' id='dtpc_form'>
					{{ csrf_field() }}
					<p class="bg-success text-white text-center text-16 d-none" id="model-message"></p>
					<input type="hidden" value="{{ $result->id }}" name="property_id" id="dtpc_property_id">

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.listing_calendar.start_date')}}<em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="start_date" id='dtpc_start' placeholder = "{{trans('messages.listing_calendar.start_date')}}" autocomplete = 'off'>
							<span class="text-danger" id="error-dtpc-start">{{ $errors->first('start_date') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob" >{{trans('messages.listing_calendar.end_date')}} <em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="end_date" id='dtpc_end' placeholder = "{{trans('messages.listing_calendar.end_date')}}" autocomplete = 'off'>
							<span class="text-danger" id="error-dtpc-end">{{ $errors->first('end_date') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.listing_calendar.price')}} <em class="text-danger">*</em></label>
							<input type="text" class="form-control text-14" name="price" id='dtpc_price' placeholder = "">
							<span class="text-danger" id="error-dtpc-price">{{ $errors->first('price') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0">
							<label for="input_dob">{{trans('messages.ical.status')}}<em class="text-danger">*</em></label>
							<select class="form-control text-14" name="status" id="dtpc_status">
								<option value="" >--{{trans('messages.ical.please_select')}}--</option>
								<option value="Available">Available</option>
								<option value="Not available">Not Available</option>
							</select>
							<span class="text-danger" id="error-dtpc-status">{{ $errors->first('status') }}</span>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0 text-right">
							<button type="button" class="btn btn-outline-danger text-14 mt-4 pl-4 pr-4 mr-2" data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>

							<button id="price_btn" class="btn vbtn-outline-success text-14 mt-4 pl-4 pr-4 ml-2" type="submit" name="submit">
								<i id="price_spinner" class="spinner fa fa-spinner fa-spin d-none" ></i>
								<span id="price_next-text">{{trans('messages.listing_calendar.submit')}}</span> 	
							</button>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal End -->
<!-- Import Calendar Modal Start -->
<!-- Modal -->
<div class="modal fade" id="import_calendar_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title font-weight-700 text-16">{{trans('messages.ical.import_a_new')}}</h5>
				<button type="button" class="close mt-m-15" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-28">&times;</span>
				</button>
			</div>

			<div class="modal-body pl-5 pr-5">
				<form id='icalendar_form'>
					
					<p class="bg-success text-white text-center text-16 d-none" id="icalendar-model-message"></p>
					<input type="hidden" value="{{ $result->id }}" name="property_id" id="icalendar_property_id">
				
					<div class="form-group">
						<label for="icalendar_url" class="col-form-label">{{trans('messages.ical.calendar_address')}} <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="url" id='icalendar_url' placeholder="{{trans('messages.ical.paste_calendar_address')}}" autocomplete = 'off'>
						<span class="text-danger" id="error-icalendar-url">{{ $errors->first('url') }}</span>
					</div>

					<div class="form-group">
						<label for="name" class="col-form-label">{{trans('messages.ical.name_calendar')}} <span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="name" id='icalendar_name' placeholder = "{{trans('messages.ical.your_calendar_name')}}" autocomplete = 'off'>
						<span class="text-danger" id="error-icalendar-name">{{ $errors->first('name') }}</span>
					</div>

					<div class="form-group">
						<label for="name" class="col-form-label">{{trans('messages.ical.color_of_calendar')}}<em class="text-danger">*</em></label>
						<select class="form-control" name="color" id="color">
						<option value="">--{{trans('messages.ical.please_select')}}--</option>
						<option value="#7FFFD4" style="background-color: Aquamarine;">Aquamarine</option>
						<option value="#0000FF" style="background-color: Blue;">Blue</option>
						<option value="#000080" style="background-color: Navy;color: #FFFFFF;">Navy</option>
						<option value="#800080" style="background-color: Purple;color: #FFFFFF;">Purple</option>
						<option value="#FF1493" style="background-color: DeepPink;">DeepPink</option>
						<option value="#EE82EE" style="background-color: Violet;">Violet</option>
						<option value="#FFC0CB" style="background-color: Pink;">Pink</option>
						<option value="#006400" style="background-color: DarkGreen;color: #FFFFFF;">DarkGreen</option>
						<option value="#008000" style="background-color: Green;color: #FFFFFF;">Green</option>
						<option value="#9ACD32" style="background-color: YellowGreen;">YellowGreen</option>
						<option value="#FFFF00" style="background-color: Yellow;">Yellow</option>
						<option value="#FFA500" style="background-color: Orange;">Orange</option>
						<option value="#FF0000" style="background-color: Red;">Red</option>
						<option value="#A52A2A" style="background-color: Brown;">Brown</option>
						<option value="#DEB887" style="background-color: BurlyWood;">BurlyWood</option>
						<option value="custom">{{trans('messages.ical.custom')}}</option>
						</select>
						<span class="text-danger" id="error-dtpc-color">{{ $errors->first('color') }}</span>
					</div>

					<div class="form-group">
						<div class="col-md-12 p-0 text-right mt-5">
							
							<button type="button" class="btn btn-outline-danger text-16 cls-reload pl-4 pr-4 ml-2" data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>

							<button class="btn vbtn-outline-success pull-right text-16 pl-4 pr-4 mr-2" type="submit" id="import_btn" name="Import"> <i class="spinner fa fa-spinner fa-spin d-none" id="import_spinner" ></i>
							<span id="import_btn-text">{{trans('messages.ical.import_calendar')}}</span>
							 </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Import Calendar Modal End -->

<!-- Export Icalendar Modal Starts -->

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="calendar_export_package" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header p-4">
				<h5 class="modal-title font-weight-700 text-16">{{trans('messages.ical.export_calendar')}}</h5>
				<button type="button" class="close mt-m-15 p-0" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" class="text-28">&times;</span>
				</button>
			</div>
			
			<div class="modal-body pl-5 pr-5">
				<div class="form-group">
					<p><span>{{trans('messages.ical.copy_paste_link')}}</span></p>
				
				</div>

				<div class="input-group mb-3">
					<input type="text" class="form-control" aria-describedby="basic-addon2" value="{{ url('icalender/export/'.$result->id.'.ics') }}" readonly="" id="myInput">
					<div class="input-group-append">
						<button class="btn vbtn-outline-success text-14 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5" onclick="myFunction()" id="copied">Copy</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Export Icalendar Modal End -->

<div class="margin-top-85">
	<div class="row m-0">
		<!-- sidebar start-->
		@include('users.sidebar')
		<!--sidebar end-->
		<div class="col-md-10">
			@if(Session::has('message'))
				<div class="alert {{ Session::get('alert-class') }}  alert-dismissible fade show text-center" role="alert">
					{{ Session::get('message') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>

			@endif 
			<div class="main-panel min-height mt-4">
				<div class="row justify-content-center">
					<div class="col-md-3 pl-4 pr-4">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mt-sm-0 pl-4 pr-4">
						<div class="row border rounded p-4 mt-4">
							<div class="col-md-12 p-0">
								<div class="row">
									<form method='post' action="property-save/{{$result->id}}/pricing">
										<input type="hidden" id="dtpc_property_id1" value="{{$result->id}}">
										<div class="col-md-12 p-0" >
											<div id="calender-dv">
												{!! $calendar !!}
											</div>
										</div>
									</form>
								</div>

								<div class="row justify-content-start mb-4">
									<ul class="list-inline ml-4">
										<li class="list-inline-item mt-4">
											<a class="js-calendar-sync text-white text-16 btn secondary-bg " data-prevent-default="true" href="{{ url('icalendar/synchronization/'.$result->id) }}" id="cal_sync"><i class="spinner fa fa-spinner fa-spin d-none" id="cal_sync_spinner"></i> {{trans('messages.ical.sync_with_other')}}</a>
										</li>

										<li class="list-inline-item mt-4">
											<button class="text-white text-16 btn secondary-bg imporpt_calendar">{{trans('messages.ical.import_calendar')}}</button>
										</li>

										<li class="list-inline-item mt-4">
											<button class="text-white text-16 btn secondary-bg" id="export_icalendar">{{trans('messages.ical.export_calendar')}}</button>    
										</li>
									</ul>
								</div>
							</div>
						</div>
						
						

						<div class="row justify-content-between mt-4 mb-5">
							<div class="mt-4">
								<a  data-prevent-default="" href="{{ url('listing/'.$result->id.'/booking') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3">
									{{trans('messages.listing_description.back')}}
								</a>
							</div>
							<div class="mt-4">
							<a  data-prevent-default="" href="{{route('property.show',$result->slug) }}" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="btn_next">
								<i class="spinner fa fa-spinner fa-spin d-none" id="btn_next_spinner"></i>
								<span id="btn_next-text">{{trans('messages.listing_basic.next')}}</span> 
							</a>
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
<script src="{{ url('js/front.min.js') }}"></script>
<script src="{{ url('js/jquery-ui.js') }}"></script>
<script type="text/javascript">
	$(document).on('click', '#cal_sync', function() {
		$(this).addClass('disabled');
		$("#cal_sync_spinner").removeClass('d-none');		
	});

	$(document).on('click', '#btn_next', function() {
		$(this).addClass('disabled');
        $("#btn_next_spinner").removeClass('d-none');
        $("#btn_next-text").text("{{trans('messages.listing_basic.next')}}..");
		
	});

	$('#icalendar_form').validate({  
			rules: {
				url: {
					required: true,
					maxlength: 255,
				},
				name: {
					required:true,
					maxlength:255,
				}
	        },    
	        submitHandler: function(form)
	        {
	            $("#import_btn").on("click", function (e)
                {	
                	$("#import_btn").attr("disabled", true);
                    e.preventDefault();
                });

	            $("#import_spinner").removeClass('d-none');
	            $("#import_btn-text").text("{{ trans('messages.ical.import_calendar') }} ..");
	            return true;

	        },
		    messages: {
	            url: {
	                required:  "{{ __('messages.jquery_validation.required') }}",
	                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
	            },

	            name: {
	                required:  "{{ __('messages.jquery_validation.required') }}",
	                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
	                equalTo:   "{{ __('messages.jquery_validation.equalTo') }}",
	            }
	        }   
	    });

</script>
@endpush 