@extends('admin.template')
@section('main')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3 settings_bar_gap">
          @include('admin.common.settings_bar')
        </div>
        <!-- right column -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#" data-toggle="tab">Twilio</a></li>
              
            </ul>
          </div>

          <div class="box box-muted">
           
         
            <form id="smsform" method="post" action="{{ url('admin/settings/sms')}}" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
              	<input class="form-control" type="hidden" name="default_country" id="default_country" value="{{isset($phoneSms['default_country)']) ? $phoneSms['default_country']:''}}">
              	<input class="form-control" type="hidden" name="carrier_code" id="carrier_code" value="{{isset($phoneSms['carrier_code']) ? $phoneSms['carrier_code']:''}}">
              	<input class="form-control" type="hidden" name="formatted_phone" id="formatted_phone" value="{{isset($phoneSms['formatted_phone']) ? $phoneSms['formatted_phone']:''}}">
                
                 <div class="form-group">
                  <label for="exampleInputPassword1" class="control-label col-sm-3">Twilio Phone Number<span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{isset($phoneSms['formatted_phone']) ? $phoneSms['formatted_phone']:''}} ">
                    <span id="phone-error" class="text-danger text-13"></span>
                    <span id="tel-error" class="text-danger text-13"></span>
                  </div>
                </div>
              	<div class="form-group">
              		<label class="col-sm-3 control-label" for="inputEmail3">Twilio SID<span class="text-danger">*</span></label>
              		<div class="col-sm-6">
              			<input class="form-control" type="text" name="twilio_sid" id="sid" placeholder="Twilio SID" value="{{isset($phoneSms['twilio_sid']) ? $phoneSms['twilio_sid']:''}}">
              		</div>
              	</div>
              	<div class="form-group">
              		<label class="col-sm-3 control-label" for="inputEmail3">Twilio Token<span class="text-danger">*</span></label>
              		<div class="col-sm-6">
              			<input class="form-control" type="text" name="twilio_token" id="token" placeholder="Twilio Token" value="{{isset($phoneSms['twilio_token']) ? $phoneSms['twilio_token']:''}}">
              		</div>
              	</div>
              	<div class="form-group">
              		<label class="col-sm-3 control-label" for="inputEmail3">Defaults</label>
              		<div class="col-sm-6">
              			<select name="defaults" class="form-control" >
              				<option value="no" {{isset($phoneSms['defaults']) && $phoneSms['defaults'] == 'no' ? 'selected':""}}>No</option>
              				<option value="yes" {{isset($phoneSms['defaults']) && $phoneSms['defaults'] == 'yes' ? 'selected':""}}>Yes</option>
              			

              			</select>
              		</div>
              	</div>
              	<div class="form-group">
              		<label class="col-sm-3 control-label" for="inputEmail3">Status</label>
              		<div class="col-sm-6">
              			<select name="status" class="form-control" >
              				<option value="0" {{isset($phoneSms['status']) && $phoneSms['status'] == '0' ? 'selected':""}}>Inactive</option>
              				<option value="1" {{isset($phoneSms['status']) && $phoneSms['status'] == '1' ? 'selected':""}}>Active</option>

              			</select>
              		</div>
              	</div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                @if(Request::segment(3) == 'email' || Request::segment(3) == '' || Request::segment(3) == 'api_informations' || Request::segment(3) == 'payment_methods' || Request::segment(3) == 'social_links')
                <a class="btn btn-default" href="{{ url('admin/settings') }}">Cancel</a>
                @else
                <button type="submit" class="btn btn-info " id="submitBtn">Submit</button>
                <a class="btn btn-danger" href="{{ url('admin/settings') }}">Cancel</a>

                @endif
              
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  @endsection
@push('scripts')

<script type="text/javascript"  src="{{ asset('js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}" type="text/javascript"></script>

<script src="{{ asset('backend/js/isValidPhoneNumber.js') }}" type="text/javascript"></script>

<script>

  $(document).ready(function() {
   $(document).on('submit', 'form', function() {
     $('button').attr('disabled', 'disabled');
   });
 });
</script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#smsform').validate({
                rules: {
                    phone: {
                        required: true
                    },
                    twilio_sid: {
                        required: true
                    },
                    twilio_token: {
                        required: true
                    },
                    defaults: {
                        required: true
                    },
                    status: {
                        required: true
                    }
                }
            });

        });
        

</script>
<script type="text/javascript">
      

    //jquery validation
    $.validator.setDefaults({
        highlight: function(element) {
            $(element).parent('div').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).parent('div').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
                $('#tel-error').html(' ').hide();
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
                utilsScript: '{{ URL::to('/') }}/js/intl-tel-input-13.0.0/build/js/utils.js'
            });

            var countryData = $("#phone").intlTelInput("getSelectedCountryData");
            $('#default_country').val(countryData.iso2);
            $('#carrier_code').val(countryData.dialCode);

            $("#phone").on("countrychange", function(e, countryData)
            {
                formattedPhone();

                
                $('#default_country').val(countryData.iso2);
                $('#carrier_code').val(countryData.dialCode);

                if ($.trim($(this).val()) !== '') {
                    //Invalid Number Validation - Add
                    if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                        $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                         $('#tel-error').show();
                         $('#phone-error').hide();
                    } else  {
                        $('#phone-error').html('').show();
                        $('#tel-error').hide();

                     }
                   } else {
                     $('#tel-error').hide();

                   }
            });
        });

    // Validate phone via Ajax
    $(document).ready(function()
    {
        $("input[name=phone]").on('blur keyup', function(e)
        {
            formattedPhone();
           $('#submitBtn').attr('disabled', false);
            if ($.trim($(this).val()) !== '') {
                if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                    $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                   $('#submitBtn').attr('disabled','disabled');
                  
                     $('#tel-error').show();
                    $('#phone-error').hide();
                } else {
               
                 $('#phone-error').show();
                 $('#tel-error').hide();
               
            }
          } else {
               $('#tel-error').hide();

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

</script>

@endpush

