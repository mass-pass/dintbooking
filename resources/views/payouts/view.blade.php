@extends('layouts.master')
@section('main')
<div class="margin-top-85">
	<div class="row m-0">
		@include('users.sidebar')

		<div class="col-lg-10 p-0">
			<div class="container-fluid min-height">
				<div class="main-panel">
					<div class="row justify-content-center mt-5">
						<div class="col-md-12">
							<nav class="navbar navbar-expand-lg navbar-light list-bacground border rounded-3 p-3">
								<ul class="navbar-nav">
									<li class="nav-item pl-4 pr-4">
										<a class="text-color text-color-hover" href="{{ url('users/payout-list') }}">{{trans('messages.sidenav.payouts')}}</a>
									</li>

									<li class="nav-item  pl-4 pr-4">
										<a class="text-color secondary-text-color font-weight-700  text-color-hover" href="{{ url('users/payout') }}">{{trans('messages.account_sidenav.account_preference')}}</a>
									</li>
								</ul>
							</nav>

							@if(Session::has('message'))
							<div class="row mt-4">
								<div class="col-md-12 text-13 alert mb-0 text-center {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
									<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
									{{ Session::get('message') }}
								</div>
							</div>
							@endif 

							@if($errors->has('email'))
							<div class="row mt-4">
								<div class="col-md-12 text-13 alert mb-0 text-center alert-danger alert-dismissable fade in opacity-1">
									<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
									{{ $errors->first('email') }}
								</div>
							</div>
							@endif 

						</div>

						<div class="col-md-12">
							<button type="button" class="btn vbtn-outline-success text-14 font-weight-700 pl-4 pr-4 pt-3 pb-3 mt-4 float-right" data-toggle="modal" data-target=".bd-example-modal-lg">
								<i class="fa fa-plus"></i> {{trans('messages.utility.payment_method')}}
							</button>
						</div>
					</div>
					@if($payouts->count() >0 )
					<div class="row mt-5">
						@foreach($payouts as $key=>$payout)
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="tile mt-4">
								<div class="wrapper border mb-5">
									<div class="banner-img text-center pt-4">
										<i class="card-2 rounded-circle p-5 far fa-credit-card text-24"></i>
									</div>

									<div class="dates">
										<div class="start">
											<strong>{{trans('messages.utility.payment_method')}}</strong> {{ $payout->payment_methods->name}}
											<hr>
										</div>
										<div class="ends">
											<strong>{{trans('messages.utility.account')}}</strong>
											@if($payout->payment_methods->name!="Bank")
											{{$payout->account_name}}<br/>
											{{$payout->email }}
											@else
											{{$payout->account_name}}
											(*****{{substr($payout->account_number,-4)}})<br/>
											{{$payout->bank_name}}
											@endif
										</div>
									</div>

									<div class="text-center pb-4 pt-4">
										<form action="{{ url('users/payout/delete-payout/'.$payout->id) }}" method="post" id="delete-payout-form">
											{{ csrf_field() }}
											@if($payout->type == 4)
											<a class="p-2 editmodal" data-toggle="modal" data-id="{{ $payout->id }}"  data-target=".edit-modal" data-obj="{{json_encode($payout->getAttributes())}}"><i class="fas fa-edit secondary-text-color"></i></a>
											@else
											<a class="p-2 editmodal2" data-toggle="modal" data-id="{{ $payout->id }}"  data-target=".edit-modal2" data-obj="{{json_encode($payout->getAttributes())}}"><i class="fas fa-edit secondary-text-color"></i></a>
											@endif
											<input type="hidden" name="id" value="{{ $payout->id }}">
											<a class="delete-confirm" data-name="{{ $payout->payment_methods->name}}"><i class="fas fa-trash text-danger" ></i></a>
										</form>
									</div>
								</div>
							</div> 
						</div>
						@endforeach

					</div>
					@else
						<div class="row jutify-content-center w-100 p-4 mt-4">
							<div class="text-center w-100">
								<img src="{{ url('img/unnamed.png')}}"   alt="notfound" class="img-fluid">
								<p class="text-center">{{trans('messages.message.no_payout_settings')}}</p>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

{{-- Large modal --}}
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">{{trans('messages.utility.payment_method')}}</h2>
				<button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="{{url('users/payout/setting')}}" id="add_payout_setting" method="post" name="add_payout_setting" accept-charset='UTF-8'>
				{{ csrf_field() }}
				<div class="row p-4">
					<input type="hidden" name="id" id="" value="">
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.payout_method')}}</label>
							<select class="form-control" name="payout_type" id="payout_type">
								<option value="4">Bank</option>
								<option value="1">Paypal</option>
							</select>
						</div>
					</div>

					<div class="col-md-6" id="bank">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_name')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_name" id="bank_name" value="">
							@if ($errors->has('bank_name')) 
							<p class="error-tag">{{ $errors->first('bank_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="acc_holder">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_holder')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_account_holder_name" id="bank_account_holder_name" value="">
							@if ($errors->has('bank_account_holder_name')) 
							<p class="error-tag">{{ $errors->first('bank_account_holder_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_name')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_name" id="branch_name" value="">
							@if ($errors->has('branch_name')) <p class="error-tag">{{ $errors->first('branch_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="acc_number">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_account_num')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="">
							@if ($errors->has('bank_account_number')) 
							<p class="error-tag">{{ $errors->first('bank_account_number') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch_c">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_city')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_city" id="branch_city" value="">
							@if ($errors->has('branch_city')) 
							<p class="error-tag">{{ $errors->first('branch_city') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="swift">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.swift_code')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="swift_code" id="swift_code" value="">
							@if ($errors->has('swift_code')) 
							<p class="error-tag">{{ $errors->first('swift_code') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch_ad">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_address')}} <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_address" id="branch_address" value="">
							@if ($errors->has('branch_address'))
							<p class="error-tag">{{ $errors->first('branch_address') }}</p> 
							@endif
						</div>
					</div>

					

					<div class="col-md-6" id="country_id">
						<div class="form-group">
							<label for="exampleInputPassword1" class="control-label col-sm-3">{{trans('messages.payment.country')}}</label>
							<select class="form-control" name="country" id="country">
								@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->name}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-md-6 d-none" id="email_id">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.paypal_email_id')}}<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="email"  value="" required="">
							@if ($errors->has('email')) 
							<p class="error-tag">{{ $errors->first('email') }}</p> 
							@endif             
						</div>
					</div>

					<div class="col-md-12 text-right mt-4">
						<button type="button" class="btn btn-outline-danger text-14 mt-2 pl-4 pr-4 mr-2 " data-dismiss="modal">{{trans('messages.utility.close')}}</button>
						<button type="submit" class="btn vbtn-outline-success text-14 mt-2 pl-4 pr-4 ml-2" id="save_btn"> <i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="save_btn-text">{{trans('messages.utility.submit')}}</span> </button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade edit-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">{{trans('messages.account_preference.payout_method')}}</h2>
				<button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="{{url('users/payout/edit-payout')}}" id="edit_payout_setting" method="post" name="edit_payout_setting" accept-charset='UTF-8'>
				{{ csrf_field() }}
				<div class="row p-4">
					<input type="hidden" name="id" id="edit_id" value="">
					<input type="hidden" name="payout_type"   value="4">
					<div class="col-md-6">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.payout_method')}}</label>
							<select class="form-control" name="payout_type" id="payout_type" disabled="disabled">
								<option value="4">Bank</option>
							</select>
						</div>
					</div>

					<div class="col-md-6" id="bank">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_name')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_name" id="edit_bank_name" value="">
							@if ($errors->has('bank_name')) 
							<p class="error-tag">{{ $errors->first('bank_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="acc_holder">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_holder')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_account_holder_name" id="edit_acc_holder" value="">
							@if ($errors->has('bank_account_holder_name')) 
							<p class="error-tag">{{ $errors->first('bank_account_holder_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_name')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_name" id="edit_branch_name" value="">
							@if ($errors->has('branch_name')) <p class="error-tag">{{ $errors->first('branch_name') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="acc_number">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.bank_account_num')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="bank_account_number" id="edit_account_number" value="">
							@if ($errors->has('bank_account_number')) 
							<p class="error-tag">{{ $errors->first('bank_account_number') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch_c">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_name')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_city" id="edit_branch_city" value="">
							@if ($errors->has('branch_city')) 
							<p class="error-tag">{{ $errors->first('branch_city') }}</p> 
							@endif
						</div>
					</div>

					

					

					<div class="col-md-6" id="swift">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.swift_code')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="swift_code" id="edit_swift_code" value="">
							@if ($errors->has('swift_code')) 
							<p class="error-tag">{{ $errors->first('swift_code') }}</p> 
							@endif
						</div>
					</div>

					<div class="col-md-6" id="branch_ad">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.branch_address')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="branch_address" id="edit_branch_address" value="">
							@if ($errors->has('branch_address'))
							<p class="error-tag">{{ $errors->first('branch_address') }}</p> 
							@endif
						</div>
					</div>

					

					<div class="col-md-6" id="country_id">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.payment.country')}}</label>
							<select class="form-control" name="country" id="edit_country">
								@foreach($countries as $country)
								<option value="{{$country->id}}">{{$country->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="modal-footer p-4">
					<button type="button" class="btn btn-outline-danger text-14" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
					<button type="submit" class="btn vbtn-outline-success text-14" id="edit_save_btn"> <i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="edit_save_btn-text">{{trans('messages.utility.submit')}}</span> </button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade edit-modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">{{trans('messages.account_preference.payout_method')}}</h2>
				<button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<form action="{{url('users/payout/edit-payout')}}" id="edit_payout_setting2" method="post" name="edit_payout_setting2" accept-charset='UTF-8'>
				{{ csrf_field() }}
				<div class="row p-4">
					<input type="hidden" name="id" id="edit_id2" value="">
					<input type="hidden" name="payout_type"   value="1">
					<div class="col-md-12">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.payout_method')}}</label>
							<select class="form-control" name="payout_type" id="payout_type" disabled="disabled">
								<option value="1">Paypal</option>
							</select>
						</div>
					</div>

					<div class="col-md-12" id="email">
						<div class="form-group">
							<label for="exampleInputPassword1">{{trans('messages.account_preference.paypal_email_id')}}<span class="text-danger">*</span></label>
							<input type="email" class="form-control" name="email" id="edit_email" value="">
							@if ($errors->has('email')) <p class="error-tag">{{ $errors->first('email') }}</p> 
							@endif
						</div>
					</div>
				</div>

				<div class="modal-footer p-4">
					<button type="button" class="btn btn-outline-danger text-16" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
					<button type="submit" class="btn vbtn-outline-success text-16" id="edit_save_btn2"><i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="edit_save_btn-text2">{{trans('messages.utility.submit')}}</span></button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
@push('scripts')


<script src="{{ url('js/sweetalert.min.js') }}"></script>
<script src="{{ url('js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">

	$('.delete-confirm').on("click", function(event) {
		var form =  $(this).closest("form");
		var name = $(this).data("name");
		console.log(name);
		event.preventDefault();
		swal({
			title: "{{trans('messages.modal.are_you_sure')}}",
			text: "{{trans('messages.modal.delete_message')}}",
			icon: "warning",
			buttons: {
				cancel: {
				    text: "{{trans('messages.search.cancel')}}",
				    value: null,
				    visible: true,
				    className: "btn btn-outline-danger text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5",
				    closeModal: true,
				},
				confirm: {
				    text: "{{trans('messages.modal.ok')}}",
				    value: true,
				    visible: true,
				    className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
				    closeModal: true
				}
			},
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$("#delete-payout-form").trigger("submit");
			}
		});
	});


	$(document).ready(function() {

		$("select#payout_type").change(function(){
			var payout = $( "#payout_type" ).val();
			if (payout == 1) {
				$("#acc_holder").addClass("d-none");
				$("#branch").addClass("d-none");
				$("#branch_c").addClass("d-none");
				$("#acc_number").addClass("d-none");
				$("#swift").addClass("d-none");
				$("#branch_ad").addClass("d-none");
				$("#bank").addClass("d-none");
				$("#country_id").addClass("d-none");
				$("#email_id").removeClass("d-none");        
			}else{

				$("#acc_holder").removeClass("d-none");   
				$("#branch").removeClass("d-none");   
				$("#branch_c").removeClass("d-none");   
				$("#acc_number").removeClass("d-none");   
				$("#swift").removeClass("d-none");   
				$("#branch_ad").removeClass("d-none");   
				$("#bank").removeClass("d-none");   
				$("#country_id").removeClass("d-none");   
				$("#email_id").addClass("d-none");
			}
		});


		$('#add_payout_setting').validate({
			rules: {
				bank_account_holder_name: {
					required: true,
					maxlength: 255
				},   
				bank_account_number: {
					required: true,
					maxlength: 255
				},
				swift_code: {
					required: true,
					maxlength: 255
				},
				branch_city: {
					required: true,
					maxlength: 255
				},
				branch_address: {
					required: true,
					maxlength: 255
				},
				branch_name: {
					required: true,
					maxlength: 255
				},
				bank_name: {
					required: true,
					maxlength: 255
				}
			},
			submitHandler: function(form)
            {
         		$("#save_btn").on("click", function (e)
                {	
                	$("#save_btn").attr("disabled", true);
                    e.preventDefault();
                });

                $(".spinner").removeClass('d-none');
                $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
                return true;
            },

		});

		$('#add_payout_setting').validate({
			rules:{
				email:{
					required:true,
				}
			}
		});

		$(document).on('click', '.editmodal', function() {
			var obj = $(this).data("obj");
			$('#edit_id').val(obj['id']);
			$('#edit_acc_holder').val(obj['account_name']);
			$('#edit_branch_name').val(obj['bank_branch_name']);
			$('#edit_branch_address').val(obj['bank_branch_address']);
			$('#edit_bank_name').val(obj['bank_name']);
			$('#edit_swift_code').val(obj['swift_code']);
			$('#edit_branch_city').val(obj['bank_branch_city']);
			$('#edit_account_number').val(obj['account_number']);
			$('#edit_country').val(obj['country']);
			$('#edit_payout_setting').validate({
				rules: {
					bank_account_holder_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},   
					bank_account_number: {
						required: true,
						maxlength: 255,
						minlength: 3,

					},
					swift_code: {
						required: true,
						maxlength: 255,
						minlength: 3,

					},
					branch_city: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					branch_address: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					branch_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					},
					bank_name: {
						required: true,
						maxlength: 255,
						minlength: 5,

					}
				},
				submitHandler: function(form)
	            {
	         		$("#edit_save_btn").on("click", function (e)
	                {	
	                	$("#edit_save_btn").attr("disabled", true);
	                    e.preventDefault();
	                });	
	                                
	                $(".spinner").removeClass('d-none');
	                $("#edit_save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
	                return true;
	            }
			});

		});

		$(document).on('click', '.editmodal2', function() {
			var obj = $(this).data("obj");
			$('#edit_id2').val(obj['id']);
			$('#edit_email').val(obj['email']);
			console.log(obj);
			$('#edit_payout_setting2').validate({
				rules:{
					email:{
						required:true,
					}
				},
				submitHandler: function(form)
	            {
	         		$("#edit_save_btn2").on("click", function (e)
	                {	
	                	$("#edit_save_btn2").attr("disabled", true);
	                    e.preventDefault();
	                });

	                $(".spinner").removeClass('d-none');
	                $("#edit_save_btn-text2").text("{{trans('messages.users_profile.save')}} ..");
	                return true;
	            }
			});
		});
	});
</script>
@endpush

