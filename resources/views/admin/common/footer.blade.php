<!-- FOOTER ADMIN -->
<footer class="main-footer">
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0.0
	</div>
	@if (!empty($site_name))
		<strong>Copyright &copy; {{date('Y')}} <a href="#">{{ $site_name}}</a>.</strong> All rights reserved.
	@endif
</footer>

<!-- Modal -->
<div class="modal fade z-index-medium" id="delete-warning-modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content w-100-p h-100-p">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Confirm Delete</h4>
			</div>

			<div class="modal-body">
				<p>You are about to delete one track, this procedure is irreversible.</p>
				<p>Do you want to proceed?</p>
			</div>

			<div class="modal-footer">
				<a class="btn btn-danger" id="delete-modal-yes" href="javascript:void(0)">Yes</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>
@push('scripts')
<script type="text/javascript">
$(document).on('click', '.delete-warning', function(e){
	e.preventDefault();
	var url = $(this).attr('href');
	$('#delete-modal-yes').attr('href', url)
	$('#delete-warning-modal').modal('show');
});

$(window).bind('load change',function(){
var emailProtocol = $('#driver').val();
var emailStatus   = $('.email_status_check').val();
if(emailProtocol=='sendmail'){
	$('.host').css('display','none');
	$('.port').css('display','none');
	$('.from_address').css('display','none');
	$('.from_name').css('display','none');
	$('.encryption').css('display','none');
	$('.username').css('display','none');
	$('.password').css('display','none');
	$('.email_status').hide();
	$('.error_email_settings').hide();
}else if(emailProtocol=='smtp'){
	$('.host').css('display','block');
	$('.port').css('display','block');
	$('.from_address').css('display','block');
	$('.from_name').css('display','block');
	$('.encryption').css('display','block');
	$('.username').css('display','block');
	$('.password').css('display','block');
	if(emailStatus==1){
		$('.email_status').show();
		$('.error_email_settings').hide();
	}else{
		$('.error_email_settings').show();
		$('.email_status').hide();
	}
}else{
		$('.email_status').hide();
		$('.error_email_settings').hide();
}
});
$(".flash-container").fadeTo(20000, 500).slideUp(500, function(){
	$(".flash-container").slideUp(500);
});
</script>
@endpush

<!-- END FOOTER -->