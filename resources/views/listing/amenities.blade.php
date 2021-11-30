	@extends('layouts.master')
	@section('main')
	<div class="margin-top-85">
		<div class="row m-0">
			<!-- sidebar start-->
			@include('users.sidebar')
			<!--sidebar end-->
			<div class="col-md-10">
				<div class="main-panel min-height mt-4">
					<div class="row justify-content-center">
						<div class="col-md-3 pl-4 pr-4">
							@include('listing.sidebar')
						</div>

						<div class="col-md-9 mt-4 mt-sm-0 pl-4 pr-4">
							<form id="amenities_id" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
								{{ csrf_field() }}

								@foreach($amenities_type as $row_type)
									<div class="col-md-12 p-0 mt-4 border rounded-3">
											<div class="row">
												<div class="col-md-12 pl-4 main-panelbg mb-4">
													<h4 class="text-18 font-weight-700 pl-0 pr-0 pt-4 pb-4">{{ $row_type->name }}
														@if($row_type->name == 'Common Amenities')
														<span class="text-danger">*</span>
														@endif
													</h4>
													@if($row_type->description != '')
														<p class="text-muted">{{ $row_type->description }}</p>
													@endif
												</div>

												<div class="col-md-12 pl-4 pr-4 pt-0 pb-4">
													<div class="row">
														@foreach($amenities as $amenity)
														<div class="col-md-6">
															@if($amenity->type_id == $row_type->id)
																	<label class="label-large label-inline amenity-label mt-4">
																		<input type="checkbox" value="{{ $amenity->id }}" name="amenities[]" data-saving="{{ $row_type->id }}" {{ in_array($amenity->id, $property_amenities) ? 'checked' : '' }}>
																		<span>{{ $amenity->title }}</span>
																	</label>
																	<span>&nbsp;</span>

																	@if($amenity->description != '')
																		<span data-toggle="tooltip" class="icon" title="{{ $amenity->description }}"></span>
																	@endif
															@endif
														</div>
														@endforeach
														<span class="ml-4"  id="at_least_one"><br></span>
													</div>
												</div>
											</div>
									</div>
								@endforeach
								
								<div class="col-md-12 p-0 mt-4 mb-5">
									<div class="row justify-content-between mt-4">
										<div class="mt-4">
											<a data-prevent-default="" href="{{ url('listing/'.$result->id.'/location') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" >
											{{trans('messages.listing_description.back')}}
											</a>
										</div>

										<div class="mt-4">
											<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="btn_next"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
												<span id="btn_next-text">{{trans('messages.listing_basic.next')}}</span>
												 
											</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop

	@push('scripts')
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#amenities_id').validate({
				rules: {
					'amenities[]': {
						required: true,
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
	                $("#btn_next-text").text("{{trans('messages.listing_basic.next')}}..");
	                return true;
	            },
				messages: {
					'amenities[]': {
						required: "{{ __('messages.jquery_validation.required') }}",
					}
				},
				
				groups: {
				amenities: "amenities[]"
				},
				errorPlacement: function(error, element) {
				if (element.attr("name") == "amenities[]") {
					error.insertAfter("#at_least_one");
				} else {
					error.insertAfter(element);
				}
				},
			});
		});
	</script>
@endpush