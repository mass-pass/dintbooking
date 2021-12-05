

<?php $__env->startSection('main'); ?>
    <div class="container-fluid container-fluid-90 min-height margin-top-85 mb-5">
      <div class="error_width " >
        <div class="notfound position-center">
            <div class="notfound-404">
              <h3><?php echo e(trans('messages.error.oops')); ?> <?php echo e(trans('messages.error.unauthorized_action')); ?></h3>
              <h1><span>4</span><span>0</span><span>4</span></h1>
            </div>
            <h2 class="text-center"><?php echo e(trans('messages.error.error_data_1')); ?>  <?php echo e(trans('messages.error.error_data_2')); ?></h2>
          </div>
      </div>
    </div>  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/errors/404.blade.php ENDPATH**/ ?>