@extends('layouts.master')
@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('js/intl-tel-input-13.0.0/build/css/intlTelInput.css')}}">
@endpush

@section('main')
<div class="margin-top-85">
    <div class="row m-0">
        <!-- sidebar start-->
        @include('users.sidebar')
        <!--sidebar end-->
        <div class="col-lg-10 p-0">
            <div class="container-fluid min-height">
                <div class="col-md-12 mt-5">
                    <div class="main-panel">
                        @include('users.profile_nav')

                        <!--Success Message -->
                        @if(Session::has('message'))
                            <div class="row mt-5">
                                <div class="col-md-12  alert {{ Session::get('alert-class') }} alert-dismissable fade in top-message-text opacity-1">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        @endif 

                        <div class="row justify-content-center mt-5 border rounded-3 mb-5 pt-2 pb-2">
                            <div class="col-md-12 p-4">
                                <form id='profile_update' method='post' action="{{url('users/profile')}}" onsubmit="return ageValidate();">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <input type="hidden" name="customer_id" id="user_id" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="default_country" id="default_country" value="{{Auth::user()->default_country }}" >
                                        <input type="hidden" name="carrier_code" id="carrier_code" value="{{Auth::user()->carrier_code }}">
                                        <input type="hidden" name="formatted_phone" id="formatted_phone" value="{{Auth::user()->formatted_phone }}">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_first_name">{{trans('messages.users_profile.first_name')}} <span class="text-danger">*</span></label>
                                                <input class='form-control text-16' type='text' name='first_name' value="{{$profile->first_name}}" id='first_name' size='30'>
                                                @if ($errors->has('first_name')) <p class="error-tag">{{ $errors->first('first_name') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_last_name">{{trans('messages.users_profile.last_name')}} <span class="text-danger">*</span></label>
                                                <input class='form-control  text-16' type='text' name='last_name' value="{{$profile->last_name}}" id='last_name' size='30'>
                                                    @if ($errors->has('last_name')) <p class="error-tag">{{ $errors->first('last_name') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_email"> {{trans('messages.users_profile.email_address')}}   
                                                    <span class="text-danger">*</span>
                                                    <i class="icon icon-lock" data-behavior="tooltip" aria-label="Private"></i>
                                                </label>

                                                <input class='form-control  text-16' type='text' name='email' value="{{$profile->email}}" id='email' size='30'>
                                                    @if ($errors->has('email')) <p class="error-tag">{{ $errors->first('email') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_phone"> {{trans('messages.users_profile.phone')}}<span class="text-danger">*</span> </label>
                                                <input type="tel" class="form-control  text-16" value="{{$profile->formatted_phone}}" id="phone" name="phone">
                                                <span id="phone-error" class="text-danger"></span>
                                                <span id="tel-error" class="text-danger"></span>
                                                @if ($errors->has('phone')) <p class="error-tag">{{ $errors->first('phone') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_gender"> {{trans('messages.users_profile.i_am')}} <i class="icon icon-lock icon-ebisu" data-behavior="tooltip" aria-label="Private"></i> </label>
                                                <div class="select">
                                                    <select class='form-control  text-16' name='details[gender]'>
                                                        <option value=''>{{trans('messages.users_profile.gender')}}</option>
                                                        <option value='Male' {{@$details['gender'] == 'Male'?'selected':''}}>{{trans('messages.users_profile.male')}}</option>
                                                        <option value='Female' {{@$details['gender'] == 'Female'?'selected':''}}>{{trans('messages.users_profile.female')}}</option>
                                                        <option value='Other' {{@$details['gender'] == 'Other'?'selected':''}}>{{trans('messages.users_profile.other')}}</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('gender')) <p class="error-tag">{{ $errors->first('gender') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="user_live">   {{trans('messages.users_profile.where_live')}}  
                                                </label>
                                                <input class='form-control  text-16' type='text' name='details[live]' value="{{(isset($details['live']) && !empty($details['live'])) ? $details['live'] : '' }}" id='live' size='30' placeholder='e.g. Paris, FR / Brooklyn, NY / Chicago, IL'>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-0 mt-3">
                                                <label for="user_birthdate"> 
                                                    {{trans('messages.users_profile.birth_date')}} 
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="row">
                                                    <div class="select col-sm-4 p-0 mt-4">
                                                        <select name='birthday_month' class='form-control  text-14' id='user_birthday_month'>
                                                        <option value=''>{{trans('messages.sign_up.month')}}</option>
                                                        @for($m=1; $m<=12; ++$m)
                                                        <option value="{{$m}}" {{$m == @$date_of_birth[1]? 'selected':''}}>{{date('F', mktime(0, 0, 0, $m, 1))}}</option>
                                                        @endfor
                                                        </select>
                                                    </div>

                                                    <div class="select col-sm-4 pr-0 mt-4">
                                                        <select name='birthday_day' class='form-control  text-14' id='user_birthday_day'>
                                                        <option value=''>{{trans('messages.sign_up.day')}}</option>
                                                        @for($m=1; $m<=31; ++$m)
                                                        <option value="{{$m}}" {{$m == @$date_of_birth[2]? 'selected':''}}>{{$m}}</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="select col-sm-4 pr-0 mt-4">
                                                        <select name='birthday_year' class='form-control  text-16' id='user_birthday_year'>
                                                        <option value=''>{{trans('messages.sign_up.year')}}</option>
                                                        @for($m=date('Y'); $m > date('Y')-100; $m--)
                                                        <option value="{{$m}}" {{$m == @$date_of_birth[0]? 'selected':''}}>{{$m}}</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <span class="text-danger text-13">
                                                    <label id='dobError' class="mb-0"></label>
                                                </span>
                                                @if ( $errors->has('birthday_month') || $errors->has('birthday_day') || $errors->has('birthday_year') ) <p class="error-tag mb-0">{{ $errors->has('birthday_month') ||  $errors->has('birthday_day') || $errors->has('birthday_year') }}</p> @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label  for="user_about">
                                                    {{trans('messages.users_profile.describe')}}
                                                </label>
                                                <textarea name='details[about]' class='form-control text-15' id='user_about' >{{(isset($details['about']) && !empty($details['about'])) ? $details['about'] : '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 p-0">
                                            <div class="p-4">
                                                <button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-4 pr-4 pt-3 pb-3 float-right pl-4 pr-4 mb-4" id="save_btn"><i class="spinner fa fa-spinner fa-spin d-none"></i>
                                                    <span id="save_btn-text">{{trans('messages.users_profile.save')}}</span>
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
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript"  src="{{ asset('js/intl-tel-input-13.0.0/build/js/intlTelInput.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('js/isValidPhoneNumber.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $('select').on('change', function() {
        var dobError = '';
        var day = document.getElementById("user_birthday_day").value;
        var month = document.getElementById("user_birthday_month").value;
        var y = document.getElementById("user_birthday_year").value;
        var year = parseInt(y);
        var year2 = profile_update.birthday_year;
        var age = 18;
        var setDate = new Date(year + age, month - 1, day);
        var currdate = new Date();
        if (day == '' || month == '' || y == '') {
            $('#dobError').html('<label class="text-danger">' + "{{ __('messages.jquery_validation.required') }}" + '</label>');
            year2.focus();
            return false;
        }
    
        else if (setDate > currdate) {
            $('#dobError').html('<label class="text-danger">' + "{{ __('messages.jquery_validation.age_greater_than_18') }}" + '</label>');
            year2.focus();
            return false;
        } else {
            $('#dobError').html('<span class="text-success"></span>');
            return true;
        }
    });

    function ageValidate() {
        var dobError = '';
        var day = document.getElementById("user_birthday_month").value;
        var month = document.getElementById("user_birthday_day").value;
        var y = document.getElementById("user_birthday_year").value;
        var year = parseInt(y);
        var year2 = profile_update.birthday_year;
        var age = 18;

        var setDate = new Date(year + age, month - 1, day);
        var currdate = new Date();
        if (day == '' || month == '' || y == '') {
            $('#dobError').html('<label class="text-danger">' + "{{ __('messages.jquery_validation.required') }}" + '</label>');
            year2.focus();
            return false;
        }
        //window.alert(setDate);
        else if (setDate > currdate) {
            //window.alert(setDate);
            $('#dobError').html('<label class="text-danger">' + "{{ __('messages.jquery_validation.age_greater_than_18') }}" + '</label>');
            year2.focus();
            return false;
        } else {
            $('#dobError').html('<span class="text-success"></span>');
            return true;
        }
    }
</script>

<script type="text/javascript">
    jQuery.validator.addMethod("laxEmail", function(value, element) {
        return this.optional(element) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
    }, "{{ __('messages.jquery_validation.email') }}");

    $(document).ready(function() {
        $('#profile_update').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 255
                },
                last_name: {
                    required: true,
                    maxlength: 255
                },
                phone: {
                    required: true,
                    maxlength: 255
                },
                email: {
                    required: true,
                    maxlength: 255,
                    laxEmail: true
                }
            },
            submitHandler: function(form)
            {
                $("#save_btn").on("click", function (e)
                {   
                    $("#save_btn").attr("disabled", true);
                    e.preventDefault();
                });

                $(".spinner").removeClass('d-none');
                $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
                return true;
            },
            messages: {
                first_name: {
                    required: "{{ __('messages.jquery_validation.required') }}",
                    maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },
                last_name: {
                    required: "{{ __('messages.jquery_validation.required') }}",
                    maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },
                email: {
                    required: "{{ __('messages.jquery_validation.required') }}",
                    maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
                },
            }
        });
    });

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
        errorPlacement: function(error, element) {
            $('#tel-error').html('').hide();
            error.insertAfter(element);
        }
    });

    /*
    intlTelInput
    */
    $(document).ready(function() {
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

        $("#phone").on("countrychange", function(e, countryData) {
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
                } else {
                    $('#tel-error').html('');

                    $.ajax({
                            method: "POST",
                            url: "{{url('duplicate-phone-number-check-for-existing-customer')}}",
                            dataType: "json",
                            cache: false,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'phone': $.trim($(this).val()),
                                'carrier_code': $.trim(countryData.dialCode),
                                'id': $('#user_id').val(),
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
    });
    /*
    intlTelInput
    */

  // Validate phone via Ajax
    $(document).ready(function() {
        $("input[name=phone]").on('blur keyup', function(e) {
            formattedPhone();
            if ($.trim($(this).val()) !== '') {
                if (!$(this).intlTelInput("isValidNumber") || !isValidPhoneNumber($.trim($(this).val()))) {
                    $('#tel-error').addClass('error').html('Please enter a valid International Phone Number.').css("font-weight", "bold");
                    hasPhoneError = true;
                    enableDisableButton();
                    $('#phone-error').hide();
                } else {
                    var phone = $(this).val().replace(/-|\s/g, ""); //replaces 'whitespaces', 'hyphens'
                    var phone = $(this).val().replace(/^0+/, ""); //replaces (leading zero - for BD phone number)
                    var token = "{{csrf_token()}}";
                    var customer_id = $('#user_id').val();

                    var pluginCarrierCode = $('#phone').intlTelInput('getSelectedCountryData').dialCode;
                    $.ajax({
                            url: "{{url('duplicate-phone-number-check-for-existing-customer')}}",
                            method: "POST",
                            dataType: "json",
                            data: {
                                'phone': phone,
                                'carrier_code': pluginCarrierCode,
                                '_token': "{{csrf_token()}}",
                                'id': customer_id
                            }
                        })
                        .done(function(response) {
                            if (response.status == true) {
                                if (phone.length == 0) {
                                    $('#phone-error').html('');
                                } else {
                                    $('#phone-error').addClass('error').html("The number has already been taken!").css("font-weight", "bold");
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

    function formattedPhone() {
        if ($('#phone').val != '') {
            var p = $('#phone').intlTelInput("getNumber").replace(/-|\s/g, "");
            $("#formatted_phone").val(p);
        }
    }

    /**
     * [check submit button should be disabled or not]
     * @return {void}
     */
    function enableDisableButton() {
        if (!hasPhoneError && !hasEmailError) {
            $('form').find("button[type='submit']").prop('disabled', false);
        } else {
            $('form').find("button[type='submit']").prop('disabled', true);
        }
    }
</script>
@endpush

