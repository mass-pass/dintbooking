@extends('layouts.master')
<title>List Your Property - Name</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" class="active">Name and location <div><span class="current"></span><span></span><span></span></div></a></li>
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
               <div class="row">
                  <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="post" onsubmit="return CheckForBlank();" action="/property-name">
                  {{ csrf_field() }}
                  <input type="hidden" name='property_type_id' id='property_type_id' value="1">
                     <h3 class="mb-5">What's the name of your place?</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <label class="mt-4">Property Name</label>
                        <input type="text" name="name" class="w-100 mb-5" required>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.53925910071!2d-80.29949906059734!3d25.78239073313235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C%20FL%2C%20USA!5e0!3m2!1sen!2sin!4v1624554473526!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                     </div>
                     <hr class="mt-4">
                     <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
                  </div>
                  <div class="col-lg-3">
                     <div class="place-section-left d-flex">
                        <div class="mr-3"><i class="far fa-thumbs-up"></i></div>
                        <span class="close-icon"><i class="fal fa-times"></i></span>
                        <div class="">
                           <h4>What should i consider when choosing name?</h4>
                           <ul>
                              <li>Keep it Short and Catchy</li>
                              <li>Avoid abbreviations</li>
                              <li>Stick To the facts</li>
                           </ul>
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
<script type="text/javascript">
	$(document).ready(function () {
		$('#name-and-location').validate({
			rules: {
				name: {
					required: true
				},
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
			}
		});
	});
</script>
@endpush