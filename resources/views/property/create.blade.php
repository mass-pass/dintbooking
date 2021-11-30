@extends('layouts.master')
@section('main')
<div class="mb-4 margin-top-85">
	<div class="row m-0">
		@include('users.sidebar')
		<div class="col-md-10  min-height">
			<div class="main-panel m-4 list-background border rounded-3">
				<h3 class="text-center mt-5 text-24 font-weight-700">{{trans('messages.property.list_space')}}</h3>
				<p class="text-center text-16 pl-4 pr-4">{{ $site_name }} {{trans('messages.property.property_title')}}.</p>
				<form id="list_space" method="post" action="{{route('property.store')}}" class="mt-4" id="lys_form" accept-charset='UTF-8'>
					{{ csrf_field() }}
					<input type="hidden" name='street_number' id='street_number'>
					<input type="hidden" name='route' id='route'>
					<input type="hidden" name='postal_code' id='postal_code'>
					<input type="hidden" name='city' id='city'>
					<input type="hidden" name='state' id='state'>
					<input type="hidden" name='country' id='country'>
					<input type="hidden" name='latitude' id='latitude'>
					<input type="hidden" name='longitude' id='longitude'>
					<div class="row p-4">
						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="exampleInputEmail1">{{trans('messages.property.home_type')}}</label>
								<select name="property_type_id" class="form-control text-16  @error('property_type_id') is-invalid @enderror">
									@foreach($property_type as $key => $value)
										<option data-icon-class="icon-star-alt"  value="{{ $key }}">
										{{ $value }}
										</option>
									@endforeach
								</select>
								@if ($errors->has('property_type_id')) <span class="invalid-feedback">{{ $errors->first('property_type_id') }}</span> @endif
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="exampleInputEmail1">{{trans('messages.property.room_type')}}</label>
								<select name="space_type" class="form-control text-16  @error('space_type') is-invalid @enderror">
									@foreach($space_type as $key => $value)
										<option data-icon-class="icon-star-alt" value="{{ $key }}">
										{{ $value }}
										</option>
									@endforeach
								</select>
								@if ($errors->has('space_type')) <span class="invalid-feedback">{{ $errors->first('space_type') }}</span> @endif
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="exampleInputEmail1">{{trans('messages.property.accommodate')}}</label>
								<select name="accommodates" class="form-control text-16  @error('accommodates') is-invalid @enderror">
									@for($i=1;$i<=16;$i++)
									<option class="accommodates" data-accommodates="{{ $i }}" value="{{ $i }}">
										{{ $i }}
									</option>
									@endfor
								</select>
								@if ($errors->has('accommodates')) <span class="invalid-feedback">{{ $errors->first('accommodates') }}</span> @endif
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group mt-4">
								<label for="exampleInputPassword1">{{trans('messages.property.city')}} <span class="text-danger">*</span></label>
								<input type="text" class="form-control text-16  @error('map_address') is-invalid @enderror" id="map_address" name="map_address" placeholder="">
								@if ($errors->has('map_address')) <span class="invalid-feedback">{{ $errors->first('map_address') }}</span> @endif
								<div id="us3"></div>
							</div>
						</div>

						<div class="col-md-12">
							<div class="float-right">
								<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 mt-4 mb-4" id="btn_next"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
									<span id="btn_next-text">{{trans('messages.property.continue')}}</span>

								</button>
							</div>
						</div>
					</div>   
				</form>
			</div>
		</div>
	</div>
</div>
@stop
@push('scripts')
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places'></script>
	<script type="text/javascript" src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/propertycreate.js') }}"></script>
	<script  type="text/javascript">
		$(document).ready(function () {
			$('#list_space').validate({
				rules: {
					property_type_id: {
						required: true
					},
					space_type: {
						required: true
					},
					accommodates: {
						required: true
					},
					map_address: {
						required: true
					}
				},
				submitHandler: function(form)
	            {
	        		$("#btn_next").on("click", function (e)
	                {
	                	$("#btn_next").attr("disabled", true);
	                    e.preventDefault();
	                });

	                $(".spinner").removeClass('d-none');
	                $("#btn_next-text").text("{{trans('messages.property.continue')}}..");
	                return true;
	            },
				messages: {
					property_type_id: {
						required:  "{{ __('messages.jquery_validation.required') }}",
					},
					space_type: {
						required: "{{ __('messages.jquery_validation.required') }}",
					},
					accommodates: {
						required:  "{{ __('messages.jquery_validation.required') }}",
					},
					map_address: {
						required:  "{{ __('messages.jquery_validation.required') }}",
					},
				}
			});
		});
	</script>
@endpush
