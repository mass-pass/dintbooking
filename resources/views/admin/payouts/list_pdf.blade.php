<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Payouts List Pdf</title>
</head>
<style>
body {
        font-family: "DeJaVu Sans", Helvetica, sans-serif;
        color: #121212;
        line-height: 15px;
    }
    table {
        text-align:center; font-size:12px;
        width:100%; border-radius:2px;  border-collapse: collapse;
    }
    table, tr, td {
        
        padding: 6px 10px;
        border: 1px solid black;
    }
</style>
<body>
<div style="width:100%; margin:0px auto;">
    <div style="height:70px; margin-bottom: 5px">
        <div style="width:90%; float:left; font-size:15px; color:#383838; font-weight:400;">
            <div style="font-size:20px;"><strong>Payout List</strong></div>
            <br>
            <div>Print Date : {{onlyFormat(date('d-m-Y'))}}</div> 
            @if(isset($date_range))
                <div>Date : {{ $date_range }}</div> 
            @endif
        </div>
        <div style="width:10%; float:left;font-size:15px; color:#383838; font-weight:400;">
            <div>
                @if (!empty($companyLogo))
                    @if (isset($logo_flag))
                        <img src='{{url("front/images/default-error-image.png")}}' max-width="120" max-height="80"> 
                    @else
                        <img src='{{url("front/images/logos/$companyLogo->value")}}' max-width="120" max-height="80">   
                    @endif    
                @endif
            </div>   
        </div>
    </div>
    <div>
 <table>
       <thead>
            <tr style="background-color:#f0f0f0;">
                <td style="font-weight:bold;">No</td>
                <td style="font-weight:bold;">Name</td>
                <td style="font-weight:bold;">Payouts Account</td>
                <td style="font-weight:bold;">Amount</td>
                <td style="font-weight:bold;">Status</td>
                <td style="font-weight:bold;">Date</td>
            </tr>
        </thead> 
        <tbody> 
            @php
                $counter = 1;
            @endphp
            @foreach($payoutList as $payouts) 
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $payouts->user_id }}</td>
                    <td>{{ $payouts->payment_method_id }}</td>
                    <td>{{ $payouts->amount }}</td>
                    <td>{{ $payouts->status }}</td>
                    <td>{{ dateFormat($payouts->created_at) }}</td>
                </tr> 
            @endforeach  
        </tbody>
      </table>
    </div>
</div>
</body>
</html>