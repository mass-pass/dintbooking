<?php
    $default_language = App\Models\Language::first();
?>

<footer class="main-panel card border footer-bg p-4" id="footer">
    <div class="container-fluid container-fluid-90">
        <div class="row">
            <div class="col-6 col-sm-3 mt-4">
                <h2 class="font-weight-700"><?php echo e(trans('messages.static_pages.hosting')); ?></h2>
                <div class="row">
                    <div class="col p-0">
                        <ul class="mt-1">
                            <?php if(isset($footer_first)): ?>
                            <?php $__currentLoopData = $footer_first; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="pt-3 text-16">
                                <a href="<?php echo e(url($ff->url)); ?>"><?php echo e($ff->name); ?></a>
                            </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?> 
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-3 mt-4">
                <h2 class="font-weight-700"><?php echo e(trans('messages.static_pages.company')); ?></h2>
                <div class="row">
                    <div class="col p-0">
                        <ul class="mt-1">
                            <?php if(isset($footer_second)): ?>
                            <?php $__currentLoopData = $footer_second; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="pt-3 text-16">
                                <a href="<?php echo e(url($fs->url)); ?>"><?php echo e($fs->name); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>                                
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-3 mt-4">
                <h2 class="font-weight-700"><?php echo e(trans('messages.home.top_destination')); ?></h2>
                <div class="row">
                    <div class="col p-0">
                        <ul class="mt-1">
                            <?php if(isset($popular_cities)): ?>
                            <?php $__currentLoopData = $popular_cities->slice(0, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="pt-3 text-16">
                                <a href="<?php echo e(URL::to('/')); ?>/search?location=<?php echo e($pc->name); ?>&checkin=<?php echo e(date('d-m-Y')); ?>&checkout=<?php echo e(date('d-m-Y')); ?>&guest=1"><?php echo e($pc->name); ?></a>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-6 col-sm-3 mt-5">
                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <a href="<?php echo e(url('/')); ?>"><img src="<?php echo e($logo ?? ''); ?>" class="img-logo" alt="logo"></a>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="social mt-4">
                        <ul class="list-inline text-center">
                            <?php if(isset($join_us)): ?>
                            <?php for($i=0; $i<count($join_us); $i++): ?>
                                <?php if(!empty($join_us[$i]->value) && trim($join_us[$i]->value) != '#'): ?>
                                    <li class="list-inline-item">
                                    <a class="social-icon  text-color text-18" target="_blank" href="<?php echo e($join_us[$i]->value); ?>" aria-label="<?php echo e($join_us[$i]->name); ?>"><i class="fab fa-<?php echo e(str_replace('_','-',$join_us[$i]->name)); ?>"></i></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php endif; ?>  
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <p class="text-center text-underline">
                            <a href="#" aria-label="modalLanguge" data-toggle="modal" data-target="#languageModalCenter"> <i class="fa fa-globe"></i> <?php echo e(Session::get('language_name')  ?? $default_language->name); ?> </a>
                            <a href="#" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter"> <span class="ml-4"><?php echo Session::get('symbol'); ?> - <u><?php echo e(Session::get('currency')); ?></u> </span></a>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <div class="border-top p-0 mt-4">
        <div class="row  justify-content-between p-2">
            <p class="col-lg-12 col-sm-12 mb-0 mt-4 text-14 text-center">
            © <?php echo e(date('Y')); ?> <?php echo e($site_name ?? ''); ?>. <?php echo e(trans('messages.home.all_rights_reserved')); ?></p>
        </div>
    </div>
</footer>




<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/common/footer.blade.php ENDPATH**/ ?>