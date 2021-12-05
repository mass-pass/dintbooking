
<input type="hidden" id="front_date_format_type" value="<?php echo e(Session::get('front_date_format_type')); ?>"> 
<header class="header_area home-page-header  animated fadeIn">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid container-fluid-90 ">
                <a class="navbar-brand logo_h" aria-label="logo" href="<?php echo e(env('GUEST_DOMAIN')?env('GUEST_DOMAIN'):url('')); ?>">
                  <img src="<?php echo e($logo ?? ''); ?>" alt="logo" class="img-logo">
               </a>  
				<!-- Trigger Button -->
                <span class="help-section mob_only d-block d-sm-none ml-auto mr-5">
                    <a href="<?php echo e(url('/login')); ?>" class="user_icon">
                        <i class="far fa-user-circle"></i>
                    </a>
                </span>
                
				<a href="#" aria-label="navbar" class="navbar-toggler" data-toggle="modal" data-target="#left_modal">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
                </a>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <div class="nav navbar-nav menu_nav justify-content-end align-items-center">

                        <div class="nav-item currency-section nav-item-tooltip">
                           <button type="button" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter" data-tooltip-position="bottom"  data-tooltip-text="Choose your currency">
                                <span class="currency-text" data-toggle="tooltip" data-placement="bottom" title="Choose Your Currency">
                                    <?php echo Session::get('symbol'); ?> <?php echo e(Session::get('currency')); ?>

                                </span>
                           </button>
                        </div>
                        <div class="nav-item language-section nav-item-tooltip">
                            <button type="button" data-toggle="modal" data-target="#languageModalCenter" aria-label="modalLanguge"  class="language-btn">
                                <span class="language-img" data-toggle="tooltip" data-placement="bottom" title="Choose Your Language">
                                    <img src="<?php echo e(url('images/flags/')); ?>/<?php echo e(flagsShortcodes(Session::get('language'))  ?? 'en'); ?>.png">
                                </span>
                           </button>
                           <!-- <span class="custom-tooltip">Choose your language</span> -->
                        </div>
                        <div style="  padding-top:18px;" class="nav-item help-section nav-item-tooltip">
   
                           <!-- <span class="custom-tooltip">Choose your language</span> -->
                        </div> 
                        <div class="nav-item help-section nav-item-tooltip">
                            <a data-toggle="tooltip" data-placement="bottom" title="Contact Customer Service" href="javascript:void(0)">
                                <i class="far fa-question-circle"></i>
                            </a>
                        </div>

                        <?php if(Request::segment(1) != 'help'): ?>
                            <div class="nav-item">
                                <?php if(!Auth::check()): ?>
                                    <a class="nav-link p-2" href="<?php echo e(route('partner.create-account')); ?>" aria-label="property-create">
                                        <button class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-4 pr-4">
                                            <p class="p-3 mb-0">  <?php echo e(trans('messages.header.list_space')); ?></p>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a class="nav-link p-2" href="<?php echo e(route('partner.list-property')); ?>" aria-label="property-create">
                                        <button class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-4 pr-4">
                                            <p class="p-3 mb-0">  <?php echo e(trans('messages.header.list_space')); ?></p>
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
     
                        <?php if(!Auth::check()): ?>
                            <!--<div class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('signup')); ?>" aria-label="signup"><?php echo e(trans('messages.sign_up.sign_up')); ?></a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="<?php echo e(url('login')); ?>" aria-label="login"><?php echo e(trans('messages.header.login')); ?></a>
                            </div>-->
                            <div class="nav-item help-section">
                                <a href="<?php echo e(url('/login')); ?>" class="user_icon_desk d-block">
                                    <i class="far fa-user-circle"></i>
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="d-flex">
                                <div>
                                    <div class="nav-item mr-0">
                                        <img src="<?php echo e(Auth::user()->profile_src); ?>" class="head_avatar" alt="<?php echo e(Auth::user()->first_name); ?>">
                                    </div>
                                </div>
                                <div>
                                <div class="nav-item ml-0 pl-0">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="nav-link dropdown-toggle text-15" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-label="user-profile" aria-haspopup="true" aria-expanded="false">
                                            <?php echo e(Auth::user()->first_name); ?>

                                        </a>
                                        <div class="dropdown-menu drop-down-menu-left p-0 drop-width text-14" aria-labelledby="dropdownMenuButton">
                                            <a class="vbg-default-hover border-0  font-weight-700 list-group-item vbg-default-hover border-0" href="<?php echo e(route('user_dashboard')); ?>" aria-label="dashboard"><?php echo e(trans('messages.header.dashboard')); ?></a>
                                            <a class="font-weight-700 list-group-item vbg-default-hover border-0 " href="<?php echo e(route('user_profile')); ?>" aria-label="profile"><?php echo e(trans('messages.utility.profile')); ?></a>
                                            <a class="font-weight-700 list-group-item vbg-default-hover border-0 " href="<?php echo e(url('logout')); ?>" aria-label="logout"><?php echo e(trans('messages.header.logout')); ?></a>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Modal Window -->
<div class="modal left fade" id="left_modal" tabindex="-1" role="dialog" aria-labelledby="left_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 secondary-bg"> 
                <?php if(Auth::check()): ?>
                    <div class="row justify-content-center">
                        <div>
                            <img src="<?php echo e(Auth::user()->profile_src); ?>" class="head_avatar" alt="<?php echo e(Auth::user()->first_name); ?>">
                        </div>

                        <div>
                            <p  class="text-white mt-4"> <?php echo e(Auth::user()->first_name); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			
            <div class="modal-body">
                <ul class="mobile-side">
                    <?php if(Auth::check()): ?>
                        <li><a style="height:auto;" href="<?php echo e(url('dashboard')); ?>"><i class="fa fa-tachometer-alt mr-3"></i><?php echo e(trans('messages.header.dashboard')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('inbox')); ?>"><i class="fas fa-inbox mr-3"></i><?php echo e(trans('messages.header.inbox')); ?></a></li>
                        <li><a style="height:auto;" style="height:auto;" href="<?php echo e(url('properties')); ?>"><i class="far fa-list-alt mr-3"></i><?php echo e(trans('messages.header.your_listing')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('my-bookings')); ?>"><i class="fa fa-bookmark mr-3"></i><?php echo e(trans('messages.booking_my.booking')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('trips/active')); ?>"><i class="fa fa-suitcase mr-3"></i> <?php echo e(trans('messages.header.your_trip')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('users/payout-list')); ?>"><i class="far fa-credit-card mr-3"></i> <?php echo e(trans('messages.sidenav.payouts')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('users/transaction-history')); ?>"><i class="fas fa-money-check-alt mr-3 text-14"></i> <?php echo e(trans('messages.account_transaction.transaction')); ?></a></li>
                        <li><a style="height:auto;" href="<?php echo e(url('users/profile')); ?>"><i class="far fa-user-circle mr-3"></i><?php echo e(trans('messages.utility.profile')); ?></a></li>
                        <a style="height:auto;" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <li><i class="fas fa-user-edit mr-3"></i><?php echo e(trans('messages.sidenav.reviews')); ?></li>
                        </a>
                    
                        <div class="collapse" id="collapseExample">
                            <ul class="ml-4">
                                <li><a style="height:auto;" href="<?php echo e(url('users/reviews')); ?>" class="text-14"><?php echo e(trans('messages.reviews.reviews_about_you')); ?></a></li>
                                <li><a style="height:auto;" href="<?php echo e(url('users/reviews_by_you')); ?>" class="text-14"><?php echo e(trans('messages.reviews.reviews_by_you')); ?></a></li>
                            </ul>
                        </div>
                        <li><a style="height:auto;" href="<?php echo e(url('logout')); ?>"><i class="fas fa-sign-out-alt mr-3"></i><?php echo e(trans('messages.header.logout')); ?></a></li>
                    <?php else: ?>
                    <span class="mob_flex">
                         <div class="nav-item currency-section curr_mob nav-item-tooltip">
                            <button type="button" aria-label="modalCurrency" data-toggle="modal" data-target="#currencyModalCenter" data-tooltip-position="bottom"  data-tooltip-text="Choose your currency">
                                <span class="currency-text" ><?php echo Session::get('symbol'); ?> <?php echo e(Session::get('currency')); ?></span>
                                <!-- <span class="currency-country">text</span> -->
                            </button>
                            
                           <!-- <span class="custom-tooltip">Choose your language</span> -->
                        </div>
                   
                        <div class="nav-item language-section nav-item-tooltip">
                      
                            <button type="button" data-toggle="modal" data-target="#languageModalCenter" aria-label="modalLanguge"  class="language-btn">
                            <span class="language-img"><img src="<?php echo e(url('images/flags/')); ?>/<?php echo e(flagsShortcodes(Session::get('language'))  ?? 'en'); ?>.png"></span>
                            <!-- <span class="language-text">India</span> -->
                            </button>
                            <!-- <span class="custom-tooltip">Choose your language</span> -->
                        </div>
                    </span>
                    <?php endif; ?>

                    <?php if(Request::segment(1) != 'help'): ?>
                        <a style="height:auto;" href="<?php echo e(route('partner.create-account')); ?>">
                            <button class="btn vbtn-outline-success text-14 font-weight-700 pl-5 pr-5 pt-3 pb-3">
                                    <?php echo e(trans('messages.header.list_space')); ?>

                            </button>
                        </a>
                    <?php endif; ?>
                   
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">
    
    <div class="modal custom-modal fade mt-5 z-index-high" id="languageModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
        <div  class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 pt-3">
                        <h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle"><?php echo e(trans('messages.home.choose_language')); ?></h5>
                    </div>

                    <div>
                        <button type="button" class="close text-28 mr-2 filter-cancel" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                </div>

                <div class="modal-body  pb-5">
                    <div class="row">
                    <div class="col-md-12 mt-4">
                    <ul class="country-list">

                        <?php $__currentLoopData = getLanguages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <li>
                                <a href="#" class="language_footer <?php echo e((Session::get('language') == $key) ? 'active' : ''); ?>" data-lang="<?php echo e($key); ?>">
                                    <img src="<?php echo e(url('images/flags')); ?>/<?php echo e($key); ?>.png"> <?php echo e($value); ?>

                                </a>
                           </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade mt-5 z-index-high" id="currencyModalCenter" tabindex="-1" role="dialog" aria-labelledby="languageModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="w-100 pt-3">
                        <h5 class="modal-title text-20 text-center font-weight-700" id="languageModalLongTitle"><?php echo e(trans('messages.home.choose_currency')); ?></h5>
                    </div>
                        
                    <div>
                        <button type="button" class="close text-28 mr-2 filter-cancel font-weight-500" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                </div>

                <div class="modal-body pb-5">
                    <div class="row">
                        <?php $__currentLoopData = getCurrencies(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-sm-3 p-3">
                            <div class="currency pl-3 pr-3 text-16 <?php echo e((Session::get('currency') == $value->code) ? 'border border-success rounded-5 currency-active' : ''); ?>">
                                <a href="javascript:void(0)" class="currency_footer " data-curr="<?php echo e($value->code); ?>">
                                    <p class="m-0 mt-2  text-16"><?php echo e($value->name); ?></p>
                                    <p class="m-0 text-muted text-16"><?php echo e($value->code); ?> - <?php echo $value->org_symbol; ?> </p> 
                                </a>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/common/header.blade.php ENDPATH**/ ?>