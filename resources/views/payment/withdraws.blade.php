@extends('layouts.master')

@section('main')
<div class="controls" style="min-height:400px;">
	<div class="col-md-12" style="padding-left:30px;padding-right:30px">
		<div class="col-lg-1" style="float: none;margin:0 auto;padding-top:20px;padding-bottom:20px"><button class="btn btn-pinkbg" data-toggle="modal" data-target="#withdrawModal">{{ trans('messages.withdraw.withdraw_balance') }}</button></div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>
						<h5>{{ trans('messages.withdraw.date_of_request') }}</h5>
					</th>
					<th>
						<h5>{{ trans('messages.withdraw.status') }}</h5>
					</th>
					<th>
						<h5>{{ trans('messages.withdraw.amount') }}</h5>
					</th>
				</tr>
			</thead>
			<tbody>
			@foreach($results as $result)
				<tr>
					<td>
						<h5>{{ date('d F Y',strtotime($result->created_at)) }}</h5>
					</td>
					<td>
						<h5>{{ $result->status }}</h5>
					</td>
					<td>
						<h5>{{ Session::get('symbol').' '.$result->amount }}</h5>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</able>
	
</div><!--controls end-->	
<div class="container">
	<div class="clearfix"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="withdrawModal" role="dialog" style="z-index:1060;">
    <div class="modal-dialog" >
      <!-- Modal content-->
      <div class="modal-content" style="width:100%;height:100%">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{ trans('messages.withdraw.do_withdraw_request') }}</h4>
        </div>
        <div class="modal-body">
          <h4 style="text-align:center;color:red" id="error-message"></h4>
          <p>Your balance is {{ Session::get('symbol').$total }}</p>
          @if(isset($details['paypal_email']) && $details['paypal_email'] != '')
          <div class="form-group">
		    <label for="email">{{ trans('messages.withdraw.withdraw_amount') }}</label>
		    <input type="text" class="form-control" name="amount" id="amount">
		  </div>
		  @else
		  	<p>{{ trans('messages.withdraw.please_provide') }} <a style="color:#e7358d;" target="_blank" href="{{url('settings/payment')}}"><b>{{ trans('messages.withdraw.payment_account') }}</b></a> {{ trans('messages.withdraw.information_withdraw') }}.</p>
		  @endif
        </div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-pinkbg" id="withdraw_submit">{{ trans('messages.utility.submit') }}</button>
        	<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('messages.utility.close') }}</button>
        </div>
      </div>
    </div>
</div>
@push('scripts')
 <script type="text/javascript">	
	$(document).on('click', '#withdraw_submit', function(){
		var dataURL = APP_URL+'/withdraws';
		var amount = $('#amount').val();
	   	if(amount == '0' || amount =="") $('#error-message').html('Inappropriate amount request');
        else{
        	$.ajax({
			    url: dataURL,
			    data: {
					"_token": "{{ csrf_token() }}",
			    	'amount': amount,
			    },
			    type: 'post',
			    dataType: 'json',
			    success: function (res) {
			    	if(res.success){
			    		window.location.href = "{{url('withdraws')}}";
			    	}else{
			    		$('#error-message').html(res.message);
			    	}
			    },
			    error: function (request, error) {
			      
			    }
			});  
        }
	});
 </script>
@endpush
@endsection