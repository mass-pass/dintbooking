@extends('emails.template')

@section('emails.main')
<h3 style="text-align:center;font-weight: bold;">{{ $site_name }}</h3>
<p>Hi {{ $first_name }},</p>
<p>
    We've issued you a payout of {{ $result['currency']['symbol'] }}{{ $payout_amount }} via PayPal.
    This payout should arrive in your account, taking into consideration weekends and holidays.
</p>
  
<table border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <th>
        Date
      </th>
      <th>
        Detail
      </th>
      <th>
        Amount
      </th>
    </tr>
    <tr>
      <td>
        {{ $result['checkin_mdy'] }} - {{ $result['checkout_mdy'] }}
      </td>
      <td>
        {{ $result['code'] }} - {{ $full_name }} - {{ $result['properties']['name'] }}
      </td>
      <td>
        {{ $result['currency']['symbol'] }}{{ $payout_amount }}
      </td>
    </tr>
  </tbody>
</table>

<br/>
<p>
    You can view the status of your payouts in your <a href="{{ $url.('users/transaction-history') }}" target="_blank">transaction history</a>.
      If you have any questions, please contact us.
</p>
@stop