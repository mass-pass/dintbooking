@extends('layouts.master')
@section('main')
<div class="container mb-4 margin-top-85 min-height">
    <div class="d-flex justify-content-center">
		<div class="p-5 mt-5 mb-5 border w-450">
				<div class="row">
					<h4 class="font-weight-700 text-18">{{trans('messages.forgot_pass.reset_password')}}</h4>
				</div>
				
				@if(Session::has('message'))
					<div class="row mt-5">
							<div class="col-md-12 text-13  alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
								<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
								{{ Session::get('message') }}
							</div>
					</div>
				@endif 

				<form method="post" action="{{url('users/reset_password')}}" id='password-form' class='signup-form login-form' accept-charset='UTF-8'>  
					{{ csrf_field() }}
					<input id="id" name="id" type="hidden" value="{{ $result->id }}">
					<input id="token" name="token" type="hidden" value="{{ $token }}">
					<div class="col-sm-12 mt-4">
						<input type="password" class="form-control" id='new_password' name="password" placeholder = "{{trans('messages.forgot_pass.new_pass')}}">
						@if ($errors->has('password')) <p class="error-tag">{{ $errors->first('password') }}</p> @endif
					</div>

					<div class="col-sm-12 mt-4">
						<input type="password" class="form-control" id='password_confirmation' name="password_confirmation" placeholder = "{{trans('messages.forgot_pass.confirm_pass')}}">
						@if ($errors->has('password_confirmation')) <p class="error-tag">{{ $errors->first('password_confirmation') }}</p> @endif
					</div>

					<div class="col-sm-12 mt-4">
						<button class="dint-button button-reactangular w-100 vbtn-success" type="submit">
						{{trans('messages.forgot_pass.reset_pass')}}
						</button>
					</div>
				</form>
		</div>
    </div>
</div>
@stop

@push('css')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#password-form').validate({
        rules: {
			password: {
				required: true,
				minlength: 6,
			},

			password_confirmation: {
				required: true,
				minlength: 6,
				equalTo: "#new_password"
			}
        },

        messages: {
            password: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
            },

            password_confirmation: {
                required:  "{{ __('messages.jquery_validation.required') }}",
                minlength: "{{ __('messages.jquery_validation.minlength6') }}",
                equalTo:   "{{ __('messages.jquery_validation.equalTo') }}",
            }
        }
    });
});
</script>
@endpush