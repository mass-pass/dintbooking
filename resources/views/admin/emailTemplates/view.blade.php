@extends('admin.template')

@section('main')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Email Templates</h1>
		@include('admin.common.breadcrumb')
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-3">
				@include('admin.common.mail_menu')
			</div>
			
			<div class="col-md-9">
			<div class="box">
				<div class="box-header with-border">
				<h3 class="box-title">
					@if($tempId == 1)
					{{"Account Information Default Update Template"}}

					@elseif($tempId == 2)
					{{"Account Information Update Template"}}
					
					@elseif($tempId == 3)
					{{"Account Information Delete Template"}}

					@elseif($tempId == 4)
					{{"Booking Template"}}
					
					@elseif($tempId == 5)
					{{"Email Confirm Template"}}
					
					@elseif($tempId == 6)
					{{"Forget Password Template"}}
					
					@elseif($tempId == 7)
					{{"Need Payment Account Template"}}
					
					@elseif($tempId == 8)
					{{"Payout Sent Template"}}

					@elseif($tempId == 9)
					{{"Booking Cancelled Template"}}

					@elseif($tempId == 10)
					{{"Booking Accepted/Declined Template"}}
							
					@endif
				</h3>
				<button class="float-right btn btn-success" id="available">Available Variable</button>
				</div>
				<div class="box-body hidden" id="variable">
					@if($tempId == 1)
					<div class="row ">
						<div class="col-md-6">
						<p>Site Name : {site_name}</p>
						<p>First Name : {first_name}</p>
						<p>Date Time : {date_time}</p>
						</div>
						
					</div>
					@elseif($tempId == 2)
					<div class="row ">
						<div class="col-md-6">
						<p>Site Name : {site_name}</p>
						<p>First Name : {first_name}</p>
						<p>Date Time : {date_time}</p>
						</div>
						
					</div>
					@elseif($tempId == 3)
					<div class="row ">
						<div class="col-md-6">
						<p>Site Name : {site_name}</p>
						<p>First Name : {first_name}</p>
						<p>Date Time : {date_time}</p>
						</div>
						
					</div>
					@elseif($tempId == 4)
					<div class="row ">
						<div class="col-md-6">
						<p>Start Date : {start_date}</p>
						<p>Total Guest : {total_guest}</p>
						<p>Message : {messages_message}</p>
						<p>Night : {night/nights}</p>
						</div>
						<div class="col-md-6">
						<p>Property Name : {property_name}</p>
						<p>Owner First Name : {owner_first_name}</p>
						<p>User First Name : {user_first_name}</p>
						<p>Total Nights : {total_night}</p>
						</div>
					</div>
					@elseif($tempId == 5)
					<div class="row ">
						<div class="col-md-6">
						<p>First Name : {first_name}</p>
						<p>Site Name : {site_name}</p>
						</div>
					</div>
					@elseif($tempId == 6)
					<div class="row ">
						<div class="col-md-6">            
						<p>First Name : {first_name}</p>
						</div>
						
					</div>
					@elseif($tempId == 7)
					<div class="row ">
						<div class="col-md-6">
							
						<p>First Name : {first_name}</p>
						<p>Currency Symbol : {currency_symbol}</p>
						<p>Payout Amount : {payout_amount}</p>
						</div>
						
					</div>
					@elseif($tempId == 8)
					<div class="row ">
						<div class="col-md-6">
						<p>Site Name : {site_name}</p>
						<p>First Name : {first_name}</p>
						<p>Currency Symbol : {currency_symbol}</p>
						</div>
						<div class="col-md-6">
						<p>Payout Amount : {payout_amount}</p>
						<p>Payment Method : {payout_payment_method}</p>
						</div>
					</div>
					@elseif($tempId == 9)
					<div class="row ">
						<<div class="col-md-6">
						<p>Accepted/Declined : {Accepted/Declined}</p>
						<p>Guest First Name : {guest_first_name}</p>
						<p>Host First Name : {host_first_name}</p>
						<p>Property Name : {property_name}</p>
						</div>
					</div>
					@elseif($tempId == 10)
					<div class="row ">
						<div class="col-md-6">
						<p>Accepted/Declined : {Accepted/Declined}</p>
						<p>Guest First Name : {guest_first_name}</p>
						<p>Host First Name : {host_first_name}</p>
						<p>Property Name : {property_name}</p>
						</div>
						
					</div>
					@endif
				
				</div>
				
				
			<form action='{{url("admin/email-template/$tempId")}}' method="post" id="myform">
			{!! csrf_field() !!}
				<!-- /.box-header -->
				<div class="box-body">
				
				<div class="form-group">
					<label for="exampleInputEmail1">Subject</label>
					<input class="form-control" name="en[subject]" type="text" value="{{$temp_Data[0]->subject}}">
						<input type="hidden" name="en[id]" value="1">
					</div>
				
				<div class="form-group">
						<textarea name="en[body]" class="form-control editor h-300">
						{{$temp_Data[0]->body}}
						</textarea>
				</div>

				<div class="box-group" id="accordion">
					<!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
					@foreach($languages as $key => $language)
					<!-- Escape the english details -->
					@php if($language->short_name == 'en'){continue;} @endphp 
					
					<div class="panel box">
					<div class="box-header with-border">
						<h4 class="box-title">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $language->short_name }}" aria-expanded="false" class="collapsed">
							{{ $language->name }}
						</a>
						</h4>
					</div>
					<div id="collapse{{ $language->short_name }}" class="panel-collapse collapse h-0" aria-expanded="false">
						<div class="box-body">

						<div class="form-group">
						<label for="exampleInputEmail1">Subject</label>
						<input class="form-control" name="{{ $language->short_name }}[subject]" type="text" value="{{isset($temp_Data[$key]->subject)?$temp_Data[$key]->subject:'Subject'}}">

						<input type="hidden" name="{{ $language->short_name }}[id]" value="{{$language->id}}">
						</div>

						<div class="form-group">
								<textarea name="{{ $language->short_name }}[body]" class="form-control editor h-300">
								{{isset($temp_Data[$key]->body)?$temp_Data[$key]->body:'Body'}}
								</textarea>
						</div>
						
						</div>
					</div>
					</div>
					@endforeach
				</div>
				
				</div>
				
				<!-- /.box-body -->
				<div class="box-footer">
				<div class="pull-right">
					<button type="submit" class="btn btn-primary btn-flat">Update</button>
				</div>
				
				</div>
				</form>
				<!-- /.box-footer -->
			</div>
			<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
	</section>
</div>
@endsection

@push('scripts')
  <script type="text/javascript">
    $(function () {
      $(".editor").wysihtml5();
    });

    $("#available").on('click', function(){
      var className = $('#variable').attr('class');
      if(className == 'box-body hidden'){
          $("#variable").removeClass('hidden');
      }else{
        $("#variable").addClass('hidden');
      }
    });
  </script>
@endpush

