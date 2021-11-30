@extends('emails.template')

@section('emails.main')
<div class="mt-20 text-left">
  <p>
    <?=$content?>
  </p>
  @if($result['status'] == 'Pending')
  <p class="mt-20 text-center">
    <a href="{{ $url.('booking/'.$result['id']) }}" target="_blank">
      <button type="button" class="learn-more"> {{trans('messages.email_template.accept/decline')}}</button>
    </a>
  </p>
  @endif
  @if($result['status'] == 'Processing')
  <p class="mt-20 text-center">
    <a href="{{ $url.('booking_payment/'.$result['id']) }}" target="_blank">
      <button type="button" class="learn-more"> Payment</button>
    </a>
  </p>
  @endif
</div>
@stop