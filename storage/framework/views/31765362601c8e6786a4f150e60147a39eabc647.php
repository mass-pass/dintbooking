<?php 
    $lang = Session::get('language');
?>

<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
	
<head>
    <?php echo $__env->make('common.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
<!--Universal header -->

<?php echo $__env->make('common.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<!-- Main -->
<?php echo $__env->yieldContent('main'); ?>


<!-- Footer conditions -->
<?php if(Route::currentRouteName() !== 'create-account' && 
Route::currentRouteName() !== 'contact-details'  && 
Route::currentRouteName() !== 'partner.create-account'): ?>
<?php echo $__env->make('common.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('common.foot', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/layouts/master.blade.php ENDPATH**/ ?>