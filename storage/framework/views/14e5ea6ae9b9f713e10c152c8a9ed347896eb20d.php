<script type="text/javascript" src='https://maps.google.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAP_API_KEY')); ?>&libraries=places'></script>
<script src="<?php echo e(mix('/js/manifest.js')); ?>"></script>
<script src="<?php echo e(mix('/js/vendor.js')); ?>"></script>
<script src="<?php echo e(mix('/js/app.js')); ?>"></script>

<?php echo $__env->yieldPushContent('scripts'); ?>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/common/foot.blade.php ENDPATH**/ ?>