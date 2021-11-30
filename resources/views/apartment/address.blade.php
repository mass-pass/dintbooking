@extends('layouts.master')
<title>List Your Property - Address</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" class="active">Name and location <span class="fil-success"></span><span class="current"></span><span></span></a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
<div class="tab-content container">
         <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
            <form class="form-horizontal" role="form" method="post" action="address">
            {{ csrf_field() }}
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="mb-5">Where is the property you're listing</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                        <form>
                           <div class="form-group">
                              <label>Country/region</label>
                              <select name="country" class="form-control">
                              @foreach($country as $key => $value)
                                 <option value="{{ $key }}" >{{ $value }}</option>
                                 @endforeach
                              </select>
                           </div>
                           <div class="form-group">
                              <label>Street name and house number</label>
                              <input type="text" name="address" required class="form-control">
                              <span>Add apartment or floor number</span>
                           </div>
                           <div class="form-group">
                              <label>Zip code</label>
                              <input type="text" name="zip" required class="form-control w-50">
                           </div>
                           <div class="form-group">
                           <label for="exampleInputPassword1">{{trans('messages.property.city')}} <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" required id="map_address" name="city" placeholder="">
                              @if ($errors->has('map_address')) <p class="error-tag">{{ $errors->first('map_address') }}</p> @endif
                              <div id="us3"></div>
                           </div>
                           <div class="form-group">
                              <label>State</label>
                              <input type="text" name="state" class="form-control">
                           </div>
                        </form>
                     </div>
                     <hr class="mt-4">
                     <div class="btn-section-artment mt-2">
                        <a type="button" onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
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
	<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ @$map_key }}&libraries=places'></script>
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/locationpicker.jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/propertycreate.js') }}"></script>
	<script  type="text/javascript">
		$(document).ready(function () {
			$('#name-and-location').validate({
				rules: {
					country: {
						required: true
					},
					address: {
						required: true
					},
					zip: {
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
					country: {
						required:  "This field is required.",
					},
					address: {
						required: "This field is required.",
					},
					zip: {
						required:  "This field is required.",
					},
					summary: {
						required:  "This field is required.",
					},
				}
			});
		});
	</script>
@endpush
