@extends('emails.template')

@section('emails.main')
<div class="mt-20 text-left">
  <p>
    <?=$content?>
  </p>
  
  <p class="mt-20 text-center">
    <a href="{{ $url.('users/confirm_email?code='.$token) }}" target="_blank">
      <button type="button" class="learn-more">{{trans('messages.email_template.confirm_email')}}</button>
    </a>
  </p>
</div>
@stop
