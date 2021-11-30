@extends('layouts.master')
<title>List Your Property - Amenities</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="fil-success"></span><span class="current"></span><span></span><span></span><span></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="property-setup" class="tab-pane active">
            <div class="place-section">
            <form class="form-horizontal" role="form" method="post" action="amenities">
            {{ csrf_field() }}
               <div class="row">
                  <div class="col-lg-12">
                  <h3 class="mb-5">What can guests use at your place?</h3>
                  </div>
                  <div class="col-md-9">
						<div class="box box-info">
							<div class="box-body">
                     <div class="col-lg-12">
                     <div class="place-section-right general-seting">
									@foreach($amenities_type as $row_type)
                           
											<div class="col-md-12"> <h4>{{ $row_type->name }} <span class="text-danger">*</span></h4></div>
										
										<div class="row">
											@if($row_type->description != '')
												<p class="text-muted">{{ $row_type->description }}</p><hr class="mt-5 mb-10">
											@endif
											<div class="col-md-10 col-sm-12 col-xs-12">
												<ul class="list-unstyled">
													@foreach($amenities as $amenity)
													@if($amenity->type_id == $row_type->id)
													<li>
														<span>&nbsp;&nbsp;</span>
														<label class="label-large label-inline amenity-label">
														<input type="checkbox" value="{{ $amenity->id }}" name="amenities[]" data-saving="{{ $row_type->id }}" {{ in_array($amenity->id, $property_amenities) ? 'checked' : '' }}> &nbsp;&nbsp;
														<span>{{ $amenity->title }}</span>
														</label>
														<span>&nbsp;</span>

														@if($amenity->description != '')
														<span data-toggle="tooltip" class="icon" title="{{ $amenity->description }}"></span>
														@endif
													</li>
													@endif
													@endforeach
												</ul>
											</div>
                                 </div>
										</div>
									@endforeach
								<br>
							</div>
						</div>
                     <hr class="mt-4">
                     <div class="btn-section-artment">
                     <a onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left"></i></a>
                     <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
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