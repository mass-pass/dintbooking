@extends('layouts.master')

@section('main')
<div class="container mb-4 margin-top-85 min-height">
	<div class="d-flex justify-content-center">
		<div class="p-5 mt-5 mb-5 border w-450">
			<div class="row">
				<h4 class="font-weight-700 text-18">{{trans('messages.forgot_pass.reset_pass')}}</h4>
			</div>
				@if(Session::has('message'))
					<div class="row mt-5">
						<div class="col-md-12 text-13  alert {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
							<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('message') }}
						</div>
					</div>
				@endif 

			<form id="forgot_password_form" method="post" action="{{url('forgot_password')}}" class='signup-form login-form mt-3' accept-charset='UTF-8'>  
				{{ csrf_field() }}
				<div class="col-sm-12">
						<p>{{trans('messages.forgot_pass.please_enter_email')}}</p>
					</div>

					<div class="col-sm-12">
						<input type="text" id="email" class="form-control" name="email" placeholder = "Email">
						@if ($errors->has('email'))<label class="text-danger email-error">{{ $errors->first('email') }}</label>@endif
					</div>
				
					<div class="col-sm-12 mt-4">
						<button id="reset_btn" class="btn pb-3 pt-3 text-15 button-reactangular vbtn-success w-100 rounded" type="submit" > <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text">{{trans('messages.forgot_pass.reset_pass')}}</span>
							
						</button>
					</div>
			</form>
		</div>
	</div>
</div>
@stop

@push('scripts')
<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script type="text/javascript">
	jQuery.validator.addMethod("laxEmail", function(value, element) {
			// allow any non-whitespace characters as the host part
			return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
		}, "{{ __('messages.jquery_validation.email') }}" );

	$(document).ready(function () {
		
	$("#reset_btn").on("click", function (e)
    {	
    	$(".email-error").hide();
    });

    $('#forgot_password_form').validate({
        rules: {
			email: {
				required: true,
				maxlength: 255,
				laxEmail: true
			}
        },
        submitHandler: function(form)
        {
     		$("#reset_btn").on("click", function (e)
            {	
            	$("#reset_btn").attr("disabled", true);
                e.preventDefault();
            });
            
            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("{{trans('messages.forgot_pass.reset_link')}}..");
            return true;
        },
        messages: {
		email: {
				required:  "{{ __('messages.jquery_validation.required') }}",
				maxlength: "{{ __('messages.jquery_validation.maxlength255') }}",
            }
        }
    });
});
</script>
@endpush