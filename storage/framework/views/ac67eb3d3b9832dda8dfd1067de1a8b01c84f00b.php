		<!-- Required meta tags -->
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Metas For sharing property in social media -->
		<meta property="og:url" content="<?php echo e(isset($shareLink) ? $shareLink : url('/')); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="<?php echo e(isset($title) ? $title : ''); ?>" />
		<meta property="og:description"
			content="<?php echo e(isset($result->property_description->summary) ? $result->property_description->summary : ''); ?>" />
		<meta property="og:image"
			content="<?php echo e((isset($property_id) && !empty($property_id && isset($property_photos[0]->photo) )) ? s3Url($property_photos[0]->photo, $property_id) : 'BANNER_URL'); ?>" />
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<?php if(!empty($favicon)): ?>
		<link rel="shortcut icon" href="<?php echo e($favicon); ?>">
		<?php endif; ?>

		<title><?php echo e($title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title')); ?>

			<?php echo e($additional_title ?? ''); ?></title>
		<meta name="description"
			content="<?php echo e($description ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'description')); ?> <?php echo e($additional_description ?? ''); ?>">

		<?php echo $__env->yieldPushContent('css'); ?>

		<!-- CSS start-->
		<link rel="stylesheet" href="<?php echo e(asset('css/vendor.css')); ?>">
		<link rel="stylesheet" href="<?php echo e(asset('css/main.css')); ?>">
		<!--CSS end-->
		
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

		<?php echo $__env->yieldPushContent('after-css'); ?>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		
		<script type="text/javascript"> 
		var APP_URL = "<?php echo e((url('/'))); ?>";
		var sessionDate = '<?php echo Session::get('date_format_type'); ?>';
		</script><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/common/head.blade.php ENDPATH**/ ?>