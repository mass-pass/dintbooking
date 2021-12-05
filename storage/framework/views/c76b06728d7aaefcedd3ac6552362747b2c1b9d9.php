<?php $__env->startSection('main'); ?>
   <div class="container contct-frm-detls inner-page-top-section">
      <div class="row justify-content-center">
         <div class="col-lg-5 col-md-8">
            <form class="contct-frm-detls-iner" name="create_account" id="create_account" role="form" method="POST" action="<?php echo e(route('partner.create-account')); ?>">
                <?php echo e(csrf_field()); ?>

               <div class="contct-frm-header">
                  <h3><?php echo e(trans('messages.partner.create_partner_account')); ?></h3>
                  <p><?php echo e(trans('messages.partner.create_partner_account_to_list_manage_property')); ?></p>
               </div>
               
               <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                  <label for="email"><?php echo e(__('messages.login.email_address')); ?><span class="text-13 text-danger">*</span></label>
                  <input type="text" id="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required autofocus>
                  <?php if($errors->has('email')): ?>
                     <label id="email-error" class="error" for="email"><?php echo e($errors->first('email')); ?></label>
                  <?php endif; ?>
               </div>
               <button id="create_account_btn" type="submit" class="btn thme-btn d-block w-100">
                  <?php echo e(__('messages.general.continue')); ?>

               </button>
               <hr>
               <p class="text-center">
                  <?php echo __('messages.partner.questions_about_your_property_or_the_extranet', [
                     'partnerHelpUrl'=>'javascript:void(0);',
                     'partnerForumUrl'=>'javascript:void(0);'
                     ]); ?>

               </p>
               <a href="<?php echo e(url('login')); ?>" class="btn thme-btn-border d-block w-100">
                  <?php echo e(__('messages.login.sign_in')); ?>

               </a>
               <hr>
               <p class="text-center">
                  <?php echo __('messages.general.signing_agreement_text', ['termsUrl' => url('terms'), 'privacyUrl' => url('privacy')]); ?>

               </p>
               <hr>
               <p class="text-center">
                  <a href="javascript:void(0);">
                     <?php echo e(__('messages.partner.do_not_sale_my_personal_info')); ?>

                  </a>
               </p>
               <hr>
               <p class="text-center mb-0">
                  <?php echo e(__('messages.general.all_rights_reserved')); ?>

                  <br><?php echo e(__('messages.general.copyright')); ?> (<?php echo e(date('Y')); ?>) Dint.com</p>
               
            </form>
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
         $('#create_account').validate({
            rules: {
               email: {
                  required: true,
                  maxlength: 255,
                  laxEmail: true
               }
            },
            submitHandler: function(form) {
               $("#create_account_btn").on("click", function (e) {  
                  $("#create_account_btn").attr("disabled", true);
                  e.preventDefault();
               });
               $(".spinner").removeClass('d-none');
               return true;
            },
            messages: {
               email: {
                  required:  "<?php echo e(__('messages.jquery_validation.required')); ?>",
                  maxlength: "<?php echo e(__('messages.jquery_validation.maxlength255')); ?>",
               }
            }
         });
      });
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/register/create_account.blade.php ENDPATH**/ ?>