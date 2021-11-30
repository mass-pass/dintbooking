@extends('emails.template')

@section('emails.main')
  <h3 style="text-align:center;font-weight: bold;">{{ $site_name }}</h3>
  <p>Hi {{ $first_name }},</p>
  <h1>
    Respond to {{ $result['users']['first_name'] }}’s Inquiry
  </h1>
  <p>
    {{ $result['total_night'] }} night{{ ($result['total_night'] > 1) ? 's' : '' }} at {{ $result['properties']['name'] }}
  </p>
  <p>
    {{ $result['messages']['message'] }}
  </p>
  <p>
    Property Name: {{ $result['properties']['name'] }}
  </p>
  <p>
    Number of Guest: {{ $result['guest'] }} guest{{ ($result['guest'] > 1) ? 's' :'' }}
  </p>
  <p>
    Number of Night: {{ $result['nights'] }} night{{ ($result['nights'] > 1) ? 's' :'' }}
  </p>
  <p>
    Checkin Time: {!! $checkinDate !!} 
  </p>
  <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
    <tbody>
      <tr>
        <td align="center">
          <table border="0" cellpadding="0" cellspacing="0">
            <tbody>
              <tr>
                <td> <a href="{{ $url.('booking/'.$result['id']) }}" target="_blank">Accept / Decline</a> </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
@stop