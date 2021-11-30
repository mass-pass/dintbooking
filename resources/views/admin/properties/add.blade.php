@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
  <section class="content-header">
          <h1>
          List Your Space
          <small>List Your Space</small>
        </h1>
        <ol class="breadcrumb">
    <li><a href="{{url('/')}}/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    </ol>
  </section>

    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">List Your Space</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <form id="add_pr" class="form-horizontal" method="post" action="{{route('admin.properties.store')}}" id="lys_form" accept-charset='UTF-8'>
             {{ csrf_field() }}

            <div class="box-body">
            <input type="hidden" name='street_number' id='street_number'>
            <input type="hidden" name='route' id='route'>
            <input type="hidden" name='postal_code' id='postal_code'>
            <input type="hidden" name='city' id='city'>
            <input type="hidden" name='state' id='state'>
            <input type="hidden" name='country' id='country'>
            <input type="hidden" name='latitude' id='latitude'>
            <input type="hidden" name='longitude' id='longitude'>
            
            <div class="form-group">
              <label for="exampleInputEmail1" class="control-label col-sm-3">User <span class="text-danger">*</span></label>
              <div class="col-sm-4" id="respo">
              <select id="host_id" name="host_id" class="form-control">
                <option value=""> Select </option>
                @foreach($users as $key => $value)
                  <option data-icon-class="icon-star-alt"  value="{{ $value->id }}">
                    {{ $value->first_name.' '.$value->last_name }}
                  </option>
                @endforeach
              </select>
              </div> 
              <div class="col-sm-2">
                <a href="#" data-toggle="modal" data-target="#customerModal" class=" btn btn-primary btn-sm customer-modal"><span class="fa fa-user"></span></a>
              </div>
              @if ($errors->has('host_id')) 
                <p class="error-tag">{{ $errors->first('host_id') }}</p> 
              @endif
            </div>



            <div class="form-group">
              <label for="exampleInputEmail1" class="control-label col-sm-3">{{trans('messages.property.home_type')}}</label>
              <div class="col-sm-6">
              <select name="property_type_id" class="form-control">
                @foreach($property_type as $key => $value)
                  <option data-icon-class="icon-star-alt"  value="{{ $key }}">
                    {{ $value }}
                  </option>
                @endforeach
              </select>
              </div>
              @if ($errors->has('property_type_id')) <p class="error-tag">{{ $errors->first('property_type_id') }}</p> @endif
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1" class="control-label col-sm-3">{{trans('messages.property.room_type')}}</label>

           <div class="col-sm-6">
              <select name="space_type" class="form-control">
                @foreach($space_type as $key => $value)
                  <option data-icon-class="icon-star-alt" value="{{ $key }}">
                    {{ $value }}
                  </option>
                @endforeach
              </select>
              </div>
              @if ($errors->has('space_type')) <p class="error-tag">{{ $errors->first('space_type') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1" class="control-label col-sm-3">{{trans('messages.property.accommodate')}}</label>
              <div class="col-sm-6">
              <select name="accommodates" class="form-control">
                @for($i=1;$i<=16;$i++)
                  <option class="accommodates" data-accommodates="{{ ($i == '16') ? $i.'+' : $i }}" value="{{ ($i == '16') ? $i.'+' : $i }}">
                    {{ $i }}
                  </option>
                @endfor
              </select>
              </div>
              @if ($errors->has('accommodates')) <p class="error-tag">{{ $errors->first('accommodates') }}</p> @endif
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" class="control-label col-sm-3">{{trans('messages.property.city')}} <span class="text-danger">*</span></label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="map_address" name="map_address" placeholder="">
              </div>
              @if ($errors->has('map_address')) <p class="error-tag">{{ $errors->first('map_address') }}</p> @endif
              <div id="us3"></div>
            </div>
            </div> 
              <div class="box-footer">
                <button type="reset" class="btn btn-default btn-sm">Reset</button>
                <button type="submit" class="btn btn-info pull-right btn-sm">Continue</button>
              </div>
          </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

      <div class="modal fade" id="customerModal" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
              <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="theModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" id="signup_form" method="post" name="signup_form" accept-charset='UTF-8'>
                        {{ csrf_field() }}

                              <h4 class="text-info text-center ml-40">Customer Information</h4>
                              <input type="hidden" name="default_country" id="default_country" class="form-control">
                              <input type="hidden" name="carrier_code" id="carrier_code" class="form-control">
                              <input type="hidden" name="formatted_phone" id="formatted_phone" class="form-control">
                              {{csrf_field()}}
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">First Name<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Last Name<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Email<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control error" name="email" id="email" placeholder="">
                                    <div id="emailError"></div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Phone</label>
                                  <div class="col-sm-8">
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                    <span id="phone-error" class="text-danger"></span>
                                    <span id="tel-error" class="text-danger"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="Password" class="control-label col-sm-3">Password<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="">
                                  </div>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1" class="control-label col-sm-3">Status</label>
                                <div class="col-sm-8">
                                  <select class="form-control" name="status" id="status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                  </select>
                                </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" id="customerModalBtn" class="btn btn-info pull-left">Submit</button>
                                <button class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                               
                              </div>
                        </form>
                    </div>
              </div>
          </div>
      </div>
  </div>



@push('scripts')
<script src="{{ asset('backend/js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/js/isValidPhoneNumber.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  
        jQuery.validator.addMethod("laxEmail", function(value, element) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
        }, "{{ __('messages.jquery_validation.email') }}" );

        $('#signup_form').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    maxlength: 255
                },
                email: {
                    required: true,
                    maxlength: 255,
                    laxEmail:true
                },

                password: {
                    required: true,
                    minlength: 6
                }
            }
        });

        
        $(document).on('blur keyup', '#email', function() {
            var emailError = '';
            $('#customerModalBtn').attr('disabled', false);
            var email      = $('#email').val();
            var _token     = $('input[name="_token"]').val();
            $('.error-tag').html('').hide();
            if(email != '') {
              $.ajax({
                url:"{{ route('checkUser.check') }}",
                method:"POST",
                data:{email:email, _token:_token},
                success:function(result)
                {
                  if (result == 'not_unique') {
                    $('#emailError').html('<label class="text-danger">'+"{{ __('messages.jquery_validation.email_existed') }}"+'</label>');
                    $('#email').addClass('has-error');
                    $('#customerModalBtn').attr('disabled', 'disabled');
                  } else {
                    $('#email').removeClass('has-error');
                    $('#emailError').html('');
                    $('#customerModalBtn').attr('disabled', false);
                  }
                }
              })
            } else {
              $('#emailError').html('');
            }
            
      });
</script>
 
<script type="text/javascript">
      // flag for button disable/enable
    var hasPhoneError = false;
    var hasEmailError = false;

    //jquery validation
    $.validator.setDefaults({
        highlight: function(element) {
            $(element).parent('div').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).parent('div').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
                $('#emailError').html('').hide();
                error.insertAfter(element);
        }
    });

    /*
     intlTelInput
     */
        $(document).ready(function()
        {
          

            $("#phone").intlTelInput({
                separateDialCode: true,
                nationalMode: true,
                preferredCountries: ["us"],
                autoPlaceholder: "polite",
                placeholderNumberType: "MOBILE",
                utilsScript: "../backend/js/intl-tel-input-13.0.0/build/js/utils.js"
            });

            var countryData = $("#phone").intlTelInput("getSelectedCountryData");
            $('#default_country').val(countryData.iso2);
            $('#carrier_code').val(countryData.dialCode);

            $("#phone").on("countrychange", function(e, countryData)
            {
                formattedPhone();

                // log(countryData);
                $('#default_country').val(countryData.iso2);
                $('#carrier_code').val(countryData.dialCode);

                if ($.trim($(this).val()) !== '') {
                    //Invalid Number Validation - Add
                    if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                        $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                        hasPhoneError = true;
                        enableDisableButton();
                        $('#phone-error').hide();
                    } else  {
                        $('#tel-error').html('');

                        $.ajax({
                            method: "POST",
                            url: "{{url('duplicate-phone-number-check')}}",
                            dataType: "json",
                            cache: false,
                            data: {
                                'phone': $.trim($(this).val()),
                                'carrier_code': $.trim(countryData.dialCode),
                            }
                        })
                        .done(function(response)
                        {
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
        });
    /*
    intlTelInput
     */

    // Validate phone via Ajax
    $(document).ready(function()
    {
        $("input[name=phone]").on('blur keyup', function(e)
        {
            formattedPhone();
            if ($.trim($(this).val()) !== '') {
                if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                    $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                    hasPhoneError = true;
                    enableDisableButton();
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

    /**
    * [check submit button should be disabled or not]
    * @return {void}
    */
    function enableDisableButton()
    {
        if (!hasPhoneError && !hasEmailError) {
            $('form').find("button[type='button']").prop('disabled',false);
        } else {
            $('form').find("button[type='button']").prop('disabled',true);
        }
    }

    $(document).ready(function () {

            $('#add_pr').validate({
                // rules: {
                //     map_address: {
                //         required: true
                //     },
                //     host_id: {
                //         required: true
                //     }
                // }
            });

        });
    function updateControls(addressComponents) {
     
        $('#street_number').val(addressComponents.streetNumber);
        $('#route').val(addressComponents.streetName);

        if(typeof(addressComponents.city)!== 'undefined'){
        $('#city').val(addressComponents.city);
        } else {
          $('#city').val(addressComponents.stateOrProvince); 
        }
        $('#state').val(addressComponents.stateOrProvince);
        $('#postal_code').val(addressComponents.postalCode);
        $('#country').val(addressComponents.country);
        if( typeof(addressComponents.city) !== 'undefined' && addressComponents.country !== 'undefined' && typeof(addressComponents.city) !== null && addressComponents.country !== null && typeof(addressComponents.city) !== '' && addressComponents.country !== ''){
            $('#map_address').val(addressComponents.city + ',' + addressComponents.country_fullname);
        } else {
           if (addressComponents.stateOrProvince != '' && addressComponents.country_fullname != '') {
              $('#map_address').val(addressComponents.stateOrProvince + ',' + addressComponents.country_fullname);
           }
        }
          
    }

    $('#us3').locationpicker({
        location: {
            latitude: 0,
            longitude: 0
        },
        radius: 0,
        addressFormat: "",
        inputBinding: {
            latitudeInput: $('#latitude'),
            longitudeInput: $('#longitude'),
            locationNameInput: $('#map_address')
        },
        enableAutocomplete: true,
        onchanged: function (currentLocation, radius, isMarkerDropped) {
            var addressComponents = $(this).locationpicker('map').location.addressComponents;
            console.log(addressComponents);
            updateControls(addressComponents);
        },
        oninitialized: function (component) {
            var addressComponents = $(component).locationpicker('map').location.addressComponents;
            updateControls(addressComponents);
        }
    });

  

      /**
       * Customer add using ajax call when click on new customer button.
       */
    $(document).ready(function()
    {var customerBtn = $( window ).width();
     if(customerBtn <768) {
      $('#respo').css("margin-bottom","7px");
     }
      $('#customerModal').on('hidden.bs.modal', function (e) {
      $(this).find('form').trigger('reset'); 
      $('#signup_form').validate().resetForm();
      $('#signup_form').find('.error').removeClass('error');
      $('#signup_form').find('#error_msg').hide();
       //location.reload();
      });
    });

      $('#customerModalBtn').on('click', function() {
           var first_name      = $('#first_name').val();
           var last_name       = $('#last_name').val();
           var email           = $('#email').val();
           var phone           = $('#phone').val();
           var carrier_code    = $('#carrier_code').val();
           var formatted_phone = $('#formatted_phone').val();
           var default_country = $('#default_country').val();
           var password        = $('#password').val();
           var status          = $('#status').val();
           var token           = $('input[name="_token"]').val();
           if (first_name && last_name && email) {
              $.ajax({
                url:"{{url('admin/add-ajax-customer')}}",
                type:'POST',
                data:{
                  'first_name':first_name,
                  'last_name':last_name,
                  'email':email,
                  'password':password,
                  'status':status,
                  'phone':phone,
                  'carrier_code':carrier_code,
                  'formatted_phone':formatted_phone,
                  'default_country':default_country,
                  '_token':token
                },
                dataType:'JSON'
              })
              .done(function(response) {
                if (response.status == 1) {
                  $('#customerModal').modal('hide');
                  $('#host_id').append('<option data-icon-class="icon-star-alt" value="' + response.user.id + '" selected="selected">' + response.user.first_name + ' ' + response.user.last_name + '</option>');
                  $('#signup_form')[0].reset();
                }
              })
              .fail(function(error) {
                console.log(error);
              });
           } else {
             $('#signup_form').submit();
           } 
      });
     
  </script>
@endpush

@endsection
