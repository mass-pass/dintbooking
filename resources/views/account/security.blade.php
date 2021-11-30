@extends('layouts.master')
@section('main')
<div class="mb-4 margin-top-85">
	<div class="row m-0">
		@include('users.sidebar')
		<div class="col-md-10">
			<div class="main-panel">
				<div class="container-fluid min-height">
					@if(Session::has('message'))
						<div class="row mt-3">
							<div class="col-md-12 text-13 alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
								<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
								{{ Session::get('message') }}
							</div>
						</div>
					@endif 

					<div class="row">
						<div class="col-md-12 p-0 mt-5 mb-3">
							@include('users.profile_nav')
						</div>

						<div class="col-md-12 p-0 mt-4">
							<form id="change_pass" class="{{ (Auth::guard('users')->user()->password) ? 'show' : 'hide' }}" method='post' action="{{url('users/security')}}">
								{{ csrf_field() }}
								<div class="form-group row">
									<input id="id" name="id" type="hidden" value="33661974">
									<input id="redirect_on_error" name="redirect_on_error" type="hidden" value="/users/security">
									<input id="user_password_ok" name="user[password_ok]" type="hidden" value="true">
								</div>

								<div class="col-md-6">
                                    <div class="form-group mt-3">
										<label for="user_first_name">{{ trans('messages.account_security.old_password') }} <span class="text-danger">*</span></label>
										<input class="form-control text-16" id="old_password" name="old_password" type="password">
										@if ($errors->has('old_password')) <p class="help-block text-danger">{{ $errors->first('old_password') }}</p> @endif
                                    </div>
								</div>
								
								<div class="col-md-6">
                                    <div class="form-group mt-3">
										<label for="user_first_name">{{ trans('messages.account_security.new_password') }} <span class="text-danger">*</span></label>
										<input class="form-control text-16" data-hook="new_password" id="new_password" name="new_password" size="30" type="password">
										@if ($errors->has('new_password')) <p class="help-block text-danger">{{ $errors->first('new_password') }}</p> @endif
                                    </div>
								</div>
								
								<div class="col-md-6">
                                    <div class="form-group mt-3">
										<label for="user_first_name"> {{ trans('messages.account_security.confirm_pass') }} <span class="text-danger">*</span></label>
										<input class="form-control text-16" id="user_password_confirmation" name="password_confirmation" size="30" type="password">
										@if ($errors->has('password_confirmation')) <p class="help-block text-danger">{{ $errors->first('password_confirmation') }}</p> @endif
                                    </div>
                                </div>

								<div class="form-group row">
									<div class="col-md-6">
										<button type="submit" class="btn vbtn-outline-success pl-4 pr-4 pt-3 pb-3 text-16 mt-5" id="save_btn">
											<i class="spinner fa fa-spinner fa-spin d-none"></i>
											<span id="save_btn-text">{{ trans('messages.account_security.update_pass') }}</span>
										</button>
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
@stop

@section('validation_script')
<script  type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	jQuery.validator.addMethod("notEqual", function(value, element, param) {
	return this.optional(element) || value != $(param).val();
	}, "{{ __('messages.jquery_validation.old_password_different') }}" );

	$(document).ready(function () {
		$('#change_pass').validate({
			rules: {
				old_password: {
					required: true
				},
				new_password: {
					required: true,                  
					minlength: 6,
					maxlength: 30,
					notEqual: "#old_password"
				},
				password_confirmation: {
					required: true,
					equalTo: "#new_password",
					notEqual: "#old_password"
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
                $("#save_btn-text").text("{{ trans('messages.account_security.update_pass') }} ..");
                return true;
            },
			messages: {
				old_password: {
					required:  "{{ __('messages.jquery_validation.required') }}",
				},
				new_password: {
					required:  "{{ __('messages.jquery_validation.required') }}",
					minlength: "{{ __('messages.jquery_validation.minlength6') }}",
					maxlength: "{{ __('messages.jquery_validation.maxlength30') }}",
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
@endsection