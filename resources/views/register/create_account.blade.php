@extends('layouts.master')
@section('main')
   <div class="container contct-frm-detls inner-page-top-section">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8">
            <form class="contct-frm-detls-iner" name="create_account" id="create_account" role="form" method="POST" action="{{ route('partner.create-account') }}">
                {{ csrf_field() }}
               <div class="contct-frm-header">
                  <h3>{{trans('messages.partner.create_partner_account')}}</h3>
                  <p>{{trans('messages.partner.create_partner_account_to_list_manage_property')}}</p>
               </div>
               
               <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">{{ __('messages.login.email_address') }}<span class="text-13 text-danger">*</span></label>
                  <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                  @if ($errors->has('email'))
                     <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                  @endif
               </div>
               <button id="create_account_btn" type="submit" class="btn thme-btn d-block w-100">
                  {{ __('messages.general.continue') }}
               </button>
               <hr>
               <p class="text-center">
                  {!! __('messages.partner.questions_about_your_property_or_the_extranet', [
                     'partnerHelpUrl'=>'javascript:void(0);',
                     'partnerForumUrl'=>'javascript:void(0);'
                     ]) 
                  !!}
               </p>
               <a href="{{ url('login') }}" class="btn thme-btn-border d-block w-100">
                  {{ __('messages.login.sign_in') }}
               </a>
               <hr>
               <p class="text-center">
                  {!! __('messages.general.signing_agreement_text', ['termsUrl' => url('terms'), 'privacyUrl' => url('privacy')]) !!}
               </p>
               <hr>
               <p class="text-center">
                  <a href="javascript:void(0);">
                     {{ __('messages.partner.do_not_sale_my_personal_info') }}
                  </a>
               </p>
               <hr>
               <p class="text-center mb-0">
                  {{ __('messages.general.all_rights_reserved') }}
                  <br>{{ __('messages.general.copyright') }} ({{ date('Y') }}) Dint.com</p>
               
            </form>
         </div>
      </div>
   </div>
@stop

@section('validation_script')
   <script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
   <script type="text/javascript">
      jQuery.validator.addMethod("laxEmail", function(value, element) {
         // allow any non-whitespace characters as the host part
         return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
      }, "{{ __('messages.jquery_validation.email') }}" );

      $(document).ready(function () {
         $('#create_account').validate({
            rules: {
               email: {
                  required: true,
                  maxlength: 255,
                  laxEmail: true
               }
            },
            submitHandler: function(form) {
               $("#create_account_btn").on("click", function (e) {  
                  $("#create_account_btn").attr("disabled", true);
                  e.preventDefault();
               });
               $(".spinner").removeClass('d-none');
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
@endsection