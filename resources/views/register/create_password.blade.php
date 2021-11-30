@extends('layouts.master')

@section('main')
   <div class="container contct-frm-detls inner-page-top-section">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8">
            <form class="contct-frm-detls-iner" name="create_password" id="create_password" role="form" method="POST" action="{{ route('partner.create-password') }}">
                  {{ csrf_field() }}
                  <div class="contct-frm-header">
                     <h3>Create password</h3>
                     <p>Use a minimum of 10 characters, including uppercase letters, lowercase letters, and number</p>
                  </div>
                  
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name='password' id='password' placeholder='{{ trans('messages.login.password') }}' class="form-control">
                     
                     @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                     @endif
                  </div>

                  <div class="form-group">
                     <label>Confirm password</label>
                     <input type="password" name='password_confirmation' id='password_confirmation' placeholder='{{ trans('messages.login.confirm_password') }}' class="form-control">
                  </div>

                  <button id="create_password_btn" class="btn thme-btn d-block w-100">Create account</button>
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
   <script type="text/javascript">
      $(document).ready(function () {
         $('#create_password').validate({
            rules: {
               password : {
                  required: true,
                  minlength : 6
               },
               password_confirmation : {
                  required: true,
                  minlength : 6,
                  equalTo : "#password"
               }
            },
            submitHandler: function(form)
              {
               $("#create_password_btn").on("click", function (e)
                  {  
                     $("#create_password_btn").attr("disabled", true);
                      e.preventDefault();
                  });
                  $(".spinner").removeClass('d-none');
                  return true;
              },
            messages: {
               password: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
               },
               confirm_password: {
                  required:  "{{ __('messages.jquery_validation.required') }}",
                  equalTo:  "{{ __('messages.jquery_validation.equalTo') }}",
                  maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
               }
            }
         });
      });
   </script>
@endsection