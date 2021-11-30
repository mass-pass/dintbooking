@extends('emails.template')

@section('emails.main')
<h3 style="text-align:center;font-weight: bold;">{{ $site_name }}</h3>
<p>Hi {{ $first_name }},</p>
@if($type == 'update')
  <p>
    Your {{ $site_name }} payout information was updated on {{ $updated_time }}.
  </p>
@endif
  @if($type == 'delete')
    <p>
      Your {{ $site_name }} payout information was deleted on {{ $deleted_time }}.
    </p>
  @endif

  @if($type == 'default_update')
    <p>
        We hope this message finds you well. Your {{ $site_name }} payout account information was recently changed on {{ $updated_date }}. To help keep your account secure, we wanted to reach out to confirm that you made this change. Feel free to disregard this message if you updated your payout account information on {{ $updated_date }}.
    </p>
    <p>
        If you did not make this change to your account, please contact us.
    </p>
  @endif
@stop