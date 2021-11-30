@extends('layouts.master')
@push('css')
   <link rel="stylesheet" type="text/css" href="{{ asset('js/intl-tel-input-13.0.0/build/css/intlTelInput.min.css')}}">
@endpush

@section('main')
   <div class="container contct-frm-detls inner-page-top-section">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8">
            <form class="contct-frm-detls-iner" name="contact_details" id="contact_details" role="form" method="POST" action="{{ route('partner.contact-details') }}">
               {{ csrf_field() }}
               <div class="contct-frm-header">
                  <h3>Contact details</h3>
                  <p>Your full name and phone number are needed to ensure the security of your Dint.com account</p>
               </div>

               <input type="hidden" name="default_country" id="default_country" class="form-control">
               <input type="hidden" name="carrier_code" id="carrier_code" class="form-control">
               <input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control">
               
               <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                  <label>First Name<span class="text-13 text-danger">*</span></label>
                  <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder='{{ trans('messages.sign_up.first_name') }}' required autofocus>
                  @if ($errors->has('first_name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('first_name') }}</strong>
                     </span>
                  @endif
               </div>

               <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                  <label>Last Name<span class="text-13 text-danger">*</span></label>
                  <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder='{{ trans('messages.sign_up.last_name') }}' required autofocus>
                  @if ($errors->has('last_name'))
                     <span class="help-block">
                         <strong>{{ $errors->first('last_name') }}</strong>
                     </span>
                  @endif
               </div>

               <div class="country-code form-group">
                  <label>Cell phone number</label>
                  <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" class="form-control">
                  <span id="tel-error" class="text-13 text-danger"></span>
                  <span id="phone-error" class="text-13 text-danger"></span>
                  <p>We'll text a two-factor authentication code to this number when you sign in</p>
               </div>
               <button id="contact_details_btn" type="submit" class="btn thme-btn d-block w-100">Next</button>
               <hr>
               <p class="text-center">By signing in or creating an account, you agree with our <a href="{{ url('terms') }}">Terms & conditions</a> and <a href="{{ url('privacy') }}">Privacy Statement</a></p>
               <hr>
               <p class="text-center"><a href="javascript:void(0);">Do not sell my personal information - California residents only</a></p>
               <hr>
               <p class="text-center mb-0">All right reserved.<br>Copyright ({{ date('Y') }}) Dint.com</p>
            </form>
         </div>
      </div>
   </div>
@stop

@section('validation_script')
   <script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}"></script>
   <script type="text/javascript" src="{{ asset('js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

   <script type="text/javascript">
      var hasPhoneError = false;
      //jquery validation
      $.validator.setDefaults({
         highlight: function(element) {
            $(element).parent('div').addClass('has-error');
         },
         unhighlight: function(element) {
            $(element).parent('div').removeClass('has-error');
         },
         errorPlacement: function (error, element) {
            $('.error-tag').html('').hide();
            error.insertAfter(element);
         }
      });

      $(document).ready(function () {
         $('#contact_details').validate({
            rules: {
               first_name: {
                  required: true,
                  maxlength: 255
               },
               last_name: {
                  required: true,
                  maxlength: 255
               }         
            },
            submitHandler: function(form) {   
               $("#contact_details_btn").on("click", function (e) { 
                  $("#contact_details_btn").attr("disabled", true);
                  e.preventDefault();
               });
               $(".spinner").removeClass('d-none');
               return true;
            },
            messages: {
               first_name: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
               },
               last_name: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
               },
            }
         });
         /*
         intlTelInput
         */
      
         $("#phone").intlTelInput({
            separateDialCode: true,
            nationalMode: true,
            preferredCountries: ["us"],
            autoPlaceholder: "polite",
            placeholderNumberType: "MOBILE",
            utilsScript: '{{ URL::to('/') }}/js/intl-tel-input-13.0.0/build/js/utils.js'
         });

         var countryData = $("#phone").intlTelInput("getSelectedCountryData");
         $('#default_country').val(countryData.iso2);
         $('#carrier_code').val(countryData.dialCode);

         $("#phone").on("countrychange", function(e, countryData){
            formattedPhone();
            // log(countryData);
            $('#default_country').val(countryData.iso2);
            $('#carrier_code').val(countryData.dialCode);
            if ($.trim($(this).val()) !== '') {
               //Invalid Number Validation - Add
               if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                  $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                  hasPhoneError = true;
                  $('#phone-error').hide();
               } else  {
                  $('#tel-error').html('');
                  $.ajax({
                     method: "POST",
                     url: "{{url('duplicate-phone-number-check')}}",
                     dataType: "json",
                     cache: false,
                     data: {
                        "_token": "{{ csrf_token() }}",
                        'phone': $.trim($(this).val()),
                        'carrier_code': $.trim(countryData.dialCode),
                     }
                  })
                  .done(function(response) {
                     if (response.status == true) {
                        $('#tel-error').html('');
                        $('#phone-error').show();

                        $('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
                        hasPhoneError = true;
                        enableDisableButton();
                     } else if (response.status == false) {
                        $('#tel-error').show();
                        $('#phone-error').html('');

                        hasPhoneError = false;
                        enableDisableButton();
                     }
                  });
               }
            } else {
               $('#tel-error').html('');
               $('#phone-error').html('');
               hasPhoneError = false;
               enableDisableButton();
            }
         });
    
         $("input[name=phone]").on('blur keyup', function(e){
            formattedPhone();
            $('#contact_details_btn').attr('disabled', false);
            $('#phone').html('').css("border-color","none");
            if ($.trim($(this).val()) !== '') {
               if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                  $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                  hasPhoneError = true;
                  $('#contact_details_btn').attr('disabled','disabled');
                  $('#phone').css("border-color","#a94442");
                  $('#phone-error').hide();
               } else {

                  var phone = $(this).val().replace(/-|\s/g,""); //replaces 'whitespaces', 'hyphens'
                  var phone = $(this).val().replace(/^0+/,"");  //replaces (leading zero - for BD phone number)
                  var token = "{{csrf_token()}}";
                  var pluginCarrierCode = $('#phone').intlTelInput('getSelectedCountryData').dialCode;
                  $.ajax({
                     url: "{{url('duplicate-phone-number-check')}}",
                     method: "POST",
                     dataType: "json",
                     data: {
                        'phone': phone,
                        'carrier_code': pluginCarrierCode,
                        '_token': "{{csrf_token()}}",
                     }
                  })
                  .done(function(response)
                  {
                     if (response.status == true) {
                        if (phone.length == 0) {
                           $('#phone-error').html('');
                        } else {
                           $('#phone-error').addClass('error').html(response.fail).css("font-weight", "bold");
                           hasPhoneError = true;
                           enableDisableButton();
                        }
                     } else if (response.status == false) {
                        $('#phone-error').html('');
                        hasPhoneError = false;
                        enableDisableButton();
                     }
                  });
                  $('#tel-error').html('');
                  $('#phone-error').show();
                  hasPhoneError = false;
                  enableDisableButton();
               }
            } else {
               $('#tel-error').html('');
               $('#phone-error').html('');
               hasPhoneError = false;
               enableDisableButton();
            }
         });
      });

      function formattedPhone()
      {
         if ($('#phone').val != '') {
            var p = $('#phone').intlTelInput("getNumber").replace(/-|\s/g,"");
            $("#formatted_phone").val(p);
         }
      }

      function enableDisableButton() 
      {
         if (!hasPhoneError) {
            $('form').find("button[type='submit']").prop('disabled', false);
         } else {
            $('form').find("button[type='submit']").prop('disabled', true);
         }
      }
   </script>
@endsection