

<?php $__env->startSection('main'); ?>
<div class="container mb-4 margin-top-85 min-height">
	<div class="d-flex justify-content-center">
		<div class="p-5 mt-5 mb-5 border w-450" >
			<?php if(Session::has('message')): ?>
				<div class="row mt-3">
					<div class="col-md-12 p-2 text-center text-14 alert <?php echo e(Session::get('alert-class')); ?> alert-dismissable fade in opacity-1">
						<a href="#"  class="close text-18" data-dismiss="alert" aria-label="close">&times;</a>
						<?php echo e(Session::get('message')); ?>

					</div>
				</div>
			<?php endif; ?> 

			<a href="<?php echo e(isset($facebook_url) ? $facebook_url:URL::to('facebookLogin')); ?>">
				<button class="btn btn-outline-primary pt-3 pb-3 text-16 w-100">
					<span><i class="fab fa-facebook-f mr-2 text-16"></i> <?php echo e(trans('messages.sign_up.sign_up_with_facebook')); ?></span>
				</button>
			</a>

			<a href="<?php echo e(URL::to('googleLogin')); ?>">
				<button class="btn btn-outline-danger pt-3 pb-3 text-16 w-100 mt-3">
				<span><i class="fab fa-google-plus-g  mr-2 text-16"></i>  <?php echo e(trans('messages.sign_up.sign_up_with_google')); ?></span>
				</button>
			</a>
			
			<p class="text-center font-weight-700 mt-1"><?php echo e(trans('messages.login.or')); ?></p>
			<form id="login_form" method="post" action="<?php echo e(url('authenticate')); ?>"  accept-charset='UTF-8'>  
				<?php echo e(csrf_field()); ?>

				<div class="form-group col-sm-12 p-0">
					<?php if($errors->has('email')): ?>
						<p class="error"><?php echo e($errors->first('email')); ?></p> 
					<?php endif; ?>
					<input type="email" class="form-control text-14" value="<?php echo e(old('email')); ?>" name="email" placeholder = "<?php echo e(trans('messages.login.email')); ?>">
				</div>

				<div class="form-group col-sm-12 p-0">
					<?php if($errors->has('password')): ?> 
						<p class="error"><?php echo e($errors->first('password')); ?></p> 
					<?php endif; ?>
					<input type="password" class="form-control text-14" value="" name="password" placeholder = "<?php echo e(trans('messages.login.password')); ?>">
				</div>

				<div class="form-group col-sm-12 p-0 mt-3" >
					<div class="d-flex justify-content-between">
						<div class="m-3 text-14">
							<input type="checkbox" class='remember_me' id="remember_me2" name="remember_me" value="1">
							<?php echo e(trans('messages.login.remember_me')); ?>

						</div>
						
						<div class="m-3 text-14">
							<a href="<?php echo e(URL::to('/')); ?>/forgot_password" class="forgot-password text-right"><?php echo e(trans('messages.login.forgot_pwd')); ?></a>
						</div>
					</div>
				</div>

				<div class="form-group col-sm-12 p-0" >
					<button type='submit' id="btn" class="btn pb-3 pt-3  button-reactangular text-15 vbtn-dark w-100 rounded"> <i class="spinner fa fa-spinner fa-spin d-none" ></i>
							<span id="btn_next-text"><?php echo e(trans('messages.login.login')); ?></span>
					</button>
				</div>
			</form>
			
			<div class="mt-3 text-14">
				<?php echo e(trans('messages.login.do_not_have_an_account')); ?>

				<a href="<?php echo e(URL::to('/')); ?>/signup" >
				<?php echo e(trans('messages.login.register')); ?>

				</a>
			</div>  
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('validation_script'); ?>
<script type="text/javascript" src="<?php echo e(url('js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript">
jQuery.validator.addMethod("laxEmail", function(value, element) {
	// allow any non-whitespace characters as the host part
	return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
}, "<?php echo e(__('messages.jquery_validation.email')); ?>" );

$(document).ready(function () {
	$('#login_form').validate({
		rules: {
			email: {
				required: true,
				maxlength: 255,
				laxEmail: true
			},

			password: {
				required: true
			}
		},
		submitHandler: function(form)
        {
 			$("#btn").on("click", function (e)
            {	
            	$("#btn").attr("disabled", true);
                e.preventDefault();
            });


            $(".spinner").removeClass('d-none');
            $("#btn_next-text").text("<?php echo e(trans('messages.login.login')); ?>..");
            return true;
        },
		messages: {
			email: {
				required:  "<?php echo e(__('messages.jquery_validation.required')); ?>",
				maxlength: "<?php echo e(__('messages.jquery_validation.maxlength255')); ?>",
			},

			password: {
				required: "<?php echo e(__('messages.jquery_validation.required')); ?>",
			}
		}
	});
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/login/view.blade.php ENDPATH**/ ?>