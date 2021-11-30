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
						<form method="post" id="list_des" action="{{url('listing/'.$result->id.'/'.$step)}}"  accept-charset='UTF-8'>
							{{ csrf_field() }}
							<div class="col-md-12 border mt-4 pb-5 rounded-3 pl-sm-0 pr-sm-0 ">
								<div class="form-group col-md-12 main-panelbg pb-3 pt-3 mt-sm-0 ">
									<h4 class="text-18 font-weight-700 pl-3">{{trans('messages.listing_sidebar.description')}}</h4>
								</div>

								<div class="row">
									<div class="col-md-12 pl-5 pr-5">
										<label>{{trans('messages.listing_description.listing_name')}} <span class="text-danger">*</span></label>
										<input type="text" name="name" class="form-control text-16 mt-2" value="{{  ($description && $description->properties) ? $description->properties->name : '' }}" placeholder="" maxlength="100">
										<span class="text-danger">{{ $errors->first('name') }}</span>
									</div>
								</div>

								<div class="row mt-4">
									<div class="col-md-12 pl-5 pr-5">
										<label>{{trans('messages.listing_description.summary')}} <span class="text-danger">*</span></label>
										<textarea class="form-control text-16 mt-2" name="summary" rows="6" placeholder="" maxlength="500" ng-model="summary">{{ $description->summary ?? '' }}</textarea>
										<span class="text-danger">{{ $errors->first('summary') }}</span>
									</div>
								</div>

								<div class="row mt-4">
									<div class="col-md-12 pl-5 pr-5">
										<p>
											{{trans('messages.listing_description.add_more')}} <a href="{{ url('listing/'.$result->id.'/details') }}" class="secondary-text-color" id="js-write-more">{{trans('messages.listing_description.detail')}}</a> {{trans('messages.listing_description.detail_data')}}.
										</p>
									</div>
								</div>
							</div>

							<div class="col-md-12 p-0 mt-4 mb-5">
								<div class="row m-0 justify-content-between">
									<div class="mt-4">
										<a  href="{{ url('listing/'.$result->id.'/basics') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5">
											{{trans('messages.listing_description.back')}}
										</a>
									</div>

									<div class="mt-4">
										<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5" id="btn_next"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
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
<script type="text/javascript">
	$(document).ready(function () {
		$('#list_des').validate({
			rules: {
				name: {
					required: true
				},
				summary: {
					required: true,
					maxlength: 500
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
				name: {
					required: "{{ __('messages.jquery_validation.required') }}",
				},
				summary: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength500') }}",
				} 
			}
		});
	});
</script>
@endpush