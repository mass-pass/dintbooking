	@extends('admin.template')

	@section('main')
	<div class="content-wrapper">
		<section class="content-header">
			<h1>Update message form<small>Update message</small></h1>
			@include('admin.common.breadcrumb')
		</section>

		<section class="content">
			<div class="row">
				<div class="col-md-12">
					<div class="box">
						<div class="box-header with-border">
							<h3 class="box-title">Update message form</h3>
						</div>
						<form class="form-horizontal" action="{{url('admin/send-message-email/'.$messages->id)}}" id="send_email" method="post" name="add_customer" accept-charset='UTF-8' {{-- onsubmit="return contentValidate();" --}}>
							{{ csrf_field() }}
							<input type="hidden" name="message_id" value="{{$messages->id}}">
							<div class="box-body">
								<div class="form-group">
									<div class="col-sm-6">
										<input type="hidden" class="form-control" value="{{$messages->receiver_id}}" name="receiver_id" placeholder="">
									</div>
								</div>
						
								<div class="form-group">
									<label for="inputEmail3" class="col-sm-3 control-label">Message<span class="text-danger">*</span></label>  
									<div class="col-sm-6">
										<textarea id="content" name="content" placeholder="" class="form-control col-md-12"> {{$messages->message}} </textarea>
										<span id="content-validation-error"></span>
									</div>
								</div>

								<div class="form-group">
									<input type="hidden" class="form-control" value="{{$messages->type_id}}" name="admin_email" placeholder="">
									<div class="col-sm-6">
										<input type="hidden" class="form-control" value="{{$messages->sender->email}}" name="admin_email" placeholder="">
									</div>
								</div>
							</div>

							<div class="box-footer">
								<button type="submit" class="btn btn-info" id="submitBtn">Update</button>
								<a href="{{url('admin/messages')}}" class="btn btn-danger btn-sm">
									Cancel
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection

	@push('scripts')
	<script>
	$(document).ready(function() {
		$(document).on('submit', 'form', function() {
		$('button').attr('disabled', 'disabled');
		});
	});
	</script>

	<script type="text/javascript">
	$(document).ready(function () {
			$('#send_email').validate({
				rules: {
					content: {
					required: true,
				}
			}
		});
	});
	</script>
	@endpush

