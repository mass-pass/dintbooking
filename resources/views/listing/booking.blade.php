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

						<div class="col-md-9 mt-sm-0 pl-4 pr-4">
							<form id="booking_id" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}"  accept-charset='UTF-8'>
								{{ csrf_field() }}
								<div class="col-md-12 p-0 mt-4 border rounded pb-4 m-0">
									<div class="form-group col-md-12 main-panelbg pb-3 pt-3 pl-4">
											<h4 class="text-16 font-weight-700">{{trans('messages.listing_sidebar.booking')}}</h4>
									</div>
									<div class="row m-0 pl-5 pr-5">
										<div class="col-md-12 p-0">
											<h3>{{trans('messages.listing_book.booking_title')}} <span class="text-danger">*</span></h3>
											<p class="text-muted">{{trans('messages.listing_book.booking_data')}}.</p>
										</div>
									</div>
									
									<div class="row m-0">
										<div class="col-md-4 pl-5 pr-5">
											<label>{{trans('messages.listing_book.booking_type')}}</label>
											<select name="booking_type" id="booking_type" class="form-control text-16 mt-2">
												<option value="request" {{ ($result->booking_type == 'request') ? 'selected' : '' }}>{{trans('messages.listing_book.review_request')}}</option>
												<option value="instant" {{ ($result->booking_type == 'instant') ? 'selected' : '' }}>{{trans('messages.listing_book.guest_instant')}}</option>
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-12 mt-4 p-0 mb-5">
									<div class="row justify-content-between">
										<div class="mt-4">
											<a href="{{ url('listing/'.$result->id.'/pricing') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3">
												{{trans('messages.listing_description.back')}}
											</a>
										</div>

										<div class="mt-4">
											<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3" id="btn_next"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
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
				$('#booking_id').validate({
					rules: {
						booking_type: {
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
		                $("#btn_next-text").text("{{trans('messages.listing_basic.next')}} ..");
		                return true;
		            },
					messages: {
						booking_type: {
							required:  "{{ __('messages.jquery_validation.required') }}",
						}
					}
				});
			});
		</script>
	@endpush