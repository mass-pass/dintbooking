


<?php $__env->startSection('main'); ?>
	<input type="hidden" id="front_date_format_type" value="<?php echo e(Session::get('front_date_format_type')); ?>">
	<?php if(Request::is('/')): ?>
	<section class="hero-banner magic-ball">
		<div class="main-banner" <?php if(!$banners->isEmpty()): ?>
		<?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> style="background-image: url('<?php echo e($banner->image_url); ?>');"  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php endif; ?>>
		<div class="container pt-5">
				<div class="custom-tabs-section pt-5 bg-white rounded-top">
					<div class="container">
						<ul class="custom-tabs nav nav-tabs ">
							<li><a data-toggle="tab" href="#stays-tab" class="active"><i class="fas fa-bed"></i>Stays</a></li>
							<li><a data-toggle="tab" href="#boats-tab"><i class="fas fa-ship"></i>Boats</a></li>

						</ul>
					</div>
				</div>
				
				<div class="tab-content">
					<div id="stays-tab" class="tab-pane  active">
						<div class="custom-tabs-inner">
							<h2><?php echo e(trans('messages.home.make_your_reservation')); ?></h2>
							<p><?php echo e(trans('messages.home.make_your_reservation_sub')); ?></p>
							<form id="stay-search-form" method="GET" action="<?php echo e(url('search')); ?>" class="custom-tabs-inner-form">
							
							<div class="form-details where-section">
								<i class="fas fa-bed"></i>
								<input id="userInfoIp" type="hidden" name="visitor_info" value="">
								<input id="stayCity" type="hidden" name="city" value="">
								<input type="text" name="location" style="font-size:1.6rem;" placeholder="<?php echo e(trans('messages.home.where_want_to_go')); ?>" class="key_cls" id="front-search-field" autocomplete="off" required>
							</div>
							<div class="form-details calendar-section">
								<i class="fas fa-calendar"></i>
								<div class="d-flex" id="daterange-btn">
									<div class="input-group mr-1">
										<input class="form-control checkinout" name="checkin" id="startDate" type="text" placeholder="<?php echo e(trans('messages.header.check_in')); ?>" autocomplete="off" readonly="readonly" required="">
									</div>
									<div class="input-group ml-1">
										<input class="form-control checkinout" name="checkout" id="endDate" placeholder="<?php echo e(trans('messages.header.check_out')); ?>" type="text" autocomplete="off" readonly="readonly" required="">
									</div>
								</div>
							</div>
							<div class="form-details adult-section stay-adult-sec">
								<i class="fas fa-user"></i>
								<div class="dropdown-btn">
									<span class='spnAdults'>0 <?php echo e(trans('messages.home.adults')); ?></span> -
									<span class='spnChildren'>0 <?php echo e(trans('messages.home.children')); ?></span> -
									<span class='spnRoom'>0 <?php echo e(trans('messages.home.room')); ?></span>
									<input type='hidden' id='hdnAdults' name='adults' value='0' />
									<input type='hidden' id='hdnChildren' name='children' value='0' />
									<input type='hidden' id='hdnRoom' name='room' value='0' />
									<i class="fas fa-angle-up"></i>
									<i class="fas fa-angle-down"></i>
								</div>
								<ul class="adult">
									<li class="d-flex justify-content-between align-items-center">
										<div>
										<h6><?php echo e(trans('messages.home.adults')); ?></h6>
										</div>
										<div>
										<a onclick="bookingSegments.decrease(this);" data-target='Adults' class="desbled"><i class="fas fa-minus"></i></a>
										<span class="value-room">0</span>
										<a onclick="bookingSegments.increase(this);" data-target='Adults'><i class="fas fa-plus"></i></a>
										</div>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<div>
										<h6><?php echo e(trans('messages.home.children')); ?></h6>
										<p>Ages 0 – 17</p>
										</div>
										<div>
										<a onclick="bookingSegments.decrease(this);" data-target='Children' class="desbled"><i class="fas fa-minus"></i></a>
										<span class="value-room">0</span>
										<a onclick="bookingSegments.increase(this);" data-target='Children'><i class="fas fa-plus"></i></a>
										</div>
									</li>
									<li class="d-flex justify-content-between align-items-center">
										<div>
										<h6><?php echo e(trans('messages.home.room')); ?></h6>
										</div>
										<div>
										<a onclick="bookingSegments.decrease(this);" data-target='Room' class="desbled"><i class="fas fa-minus"></i></a>
										<span class="value-room">0</span>
										<a onclick="bookingSegments.increase(this);" data-target='Room'><i class="fas fa-plus"></i></a>
										</div>
									</li>
								</ul>
							</div>
							<input type="submit" name="" value="<?php echo e(trans('messages.home.search')); ?>" class="submit-btnn">
							<input type="hidden" name="traveling" id="traveling" value="">
							</form>
							<div class="mt-4"><input type="checkbox" onclick="bookingSegments.setTraveling(this.checked);">
							<label for="traveling"> I'm traveling for work</label>
							</div>
						</div>
					</div>
					<div id="boats-tab" class="tab-pane fade">
						<div class="custom-tabs-inner">
							<h2>The best solution for your yatch charter</h2>
							<p>More than 40,000 private yatch rentals and bareboat charters near me and worlwide for your next boating trip</p>
							<form id="boats-search-form" method="GET" action="<?php echo e(url('boat/search')); ?>" class="custom-tabs-inner-form">
								<?php echo csrf_field(); ?>
								
								<input id="boatCity" type="hidden" name="city" value="">
								<div class="custom-tabs-inner-form" style="border: 1px;">
								<div class="form-details where-section">
									<i class="fas fa-ship"></i>
									<input type="text" name="location" placeholder="City Of Departure" class="key_cls" id="boat-location" autocomplete="off" required>
									
								</div>
								<div class="form-details calendar-section">
									<i class="fas fa-calendar"></i>
									<div class="d-flex" id="boat-daterange-btn">
										<div class="input-group mr-1">
											<input class="form-control" name="boat_date" id="boat_date" type="text" placeholder="Date" autocomplete="off" readonly="readonly" required="">
										</div>
										
									</div>
								</div>
								<div class="form-details adult-section boat-type-sec">
									<i class="fas fa-ship"></i>
									<div class="boat-type-sec-btn">
										<span id="boat_types">Boat Type</span>
										<i class="fas fa-angle-down"></i>
									</div>
									<ul class="boat-type-dropdn">
										<li ><label for="Motorboat"><input type="checkbox" name="boatTypes[]" id="Motorboat" value="Motorboat">Motorboat</label></li>
										<li><label for="Sailboat"><input type="checkbox" name="boatTypes[]" id="Sailboat" value="Sailboat">Sailboat</label></li>
										<li><label for="RIB"><input type="checkbox" name="boatTypes[]" id="RIB" value="RIB">RIB</label></li>
										<li><label for="Catamaran"><input type="checkbox" name="boatTypes[]" id="Catamaran" value="Catamaran">Catamaran</label></li>
										<li><label for="Houseboat"><input type="checkbox" name="boatTypes[]" id="Houseboat" value="Houseboat">Houseboat</label></li>
										<li><label for="Jetski"><input type="checkbox" name="boatTypes[]" id="Jetski" value="Jetski">Jet ski</label></li>
										<li><label for="Yacht"><input type="checkbox" name="boatTypes[]" id="Yacht" value="Yacht">Yacht</label></li>
									</ul>
								</div>
								<input type="submit" name="" value="Search" class="submit-btnn">
								</div>
							</form>
						</div>
					</div>
					<!-- cars -->
					<div id="cars-tab" class="tab-pane fade">
						<div class="custom-tabs-inner">
							<h2>Car hire for your trip</h2>
							<p>More than 40,000 private cars rentals nearby for your trip</p>
							<div class="custom-tabs-inner-form">
							<div class="form-details where-section">
								<i class="fas fa-ship"></i>
								<input type="text" name="" placeholder="City, airport, address or hotel" class="key_cls" id="front-search-field">
								
							</div>
							<div class="form-details calendar-section">
								<i class="fas fa-calendar"></i>
								<div class="d-flex" id="daterange-btn">
									<div class="input-group mr-1">
										<input class="form-control checkinout" name="checkin" id="startDate" type="text" placeholder="From" autocomplete="off" readonly="readonly" required="">
									</div>
									<div class="input-group ml-1">
										<input class="form-control checkinout" name="checkout" id="endDate" placeholder="Time" type="text" readonly="readonly" required="">
									</div>
								</div>
							</div>
							<div class="form-details adult-section boat-type-sec">
								<i class="fas fa-calendar"></i>
								<div class="d-flex" id="daterange-btn">
									<div class="input-group mr-1">
										<input class="form-control checkinout" name="checkin" id="startDate" type="text" placeholder="Until" autocomplete="off" readonly="readonly" required="">
									</div>
									<div class="input-group ml-1">
										<input class="form-control checkinout" name="checkout" id="endDate" placeholder="Time" type="text" readonly="readonly" required="">
									</div>
								</div>
							</div>
							<input type="submit" name="" value="Search" class="submit-btnn">
							</div>
						</div>
					</div>
					<!-- cars end -->
					<!-- service -->
					<div id="services-tab" class="tab-pane fade">
						<div class="d-flex align-items-center flex-column justify-content-center h-100">
							<div class="custom-tabs-inner">
								<h2 class="mb-4">Choose a service to get started</h2>
								<div class="custom-tabs-inner-form">
									<div class="form-services-details where-section">
										<input type="text" name="" placeholder="Home cleaning" class="key_cls" id="front-search-field" style="width: 100% !important;">
									</div>
									<input type="submit" name="" value="Search" class="submit-btnn">
								</div>
							</div>
						</div>
					</div>
					<!-- cars end -->

					
				</div>
			</div>

		</div>
	</section>
	<?php endif; ?>

	<?php if(!$starting_cities->isEmpty()): ?>
	<section class="bg-gray mt-70 pb-2">
		<div class="container-fluid container-fluid-90">
			<div class="row">
				<div class="section-intro text-center">
					<p class="item animated fadeIn text-24 font-weight-700 m-0 text-capitalize"><?php echo e(trans('messages.home.top_destination')); ?></p>
					<p class="mt-3"><?php echo e(trans('messages.home.destination_slogan')); ?> </p>
				</div>
			</div>

			<div class="row mt-2 mb-2">
				<?php $__currentLoopData = $starting_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-4 mt-5">
				<a href="<?php echo e(URL::to('/')); ?>/search?location=<?php echo e($city->name); ?>&checkin=&checkout=&guest=1">
						<div class="grid item animated zoomIn">
							<figure class="effect-ming">
								<img src="<?php echo e($city->image_url); ?>" alt="city"/>
									<figcaption>
										<p class="text-18 font-weight-700 position-center"><?php echo e($city->name); ?></p>
									</figcaption>     
							</figure>
						</div>
					</a>
				</div>   
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if(!$properties->isEmpty()): ?>
		<section class="recommandedbg bg-gray mt-4 magic-ball magic-ball-about pb-5">
			<div class="container-fluid container-fluid-90">
				<div class="row">
					<div class="recommandedhead section-intro text-center mt-70">
						<p class="item animated fadeIn text-24 font-weight-700 m-0"><?php echo e(trans('messages.home.recommended_home')); ?></p>
						<p class="mt-2"><?php echo e(trans('messages.home.recommended_slogan')); ?></p>
					</div>
				</div>

				<div class="row mt-5">
					<?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-6 col-lg-4 col-xl-3 pl-3 pr-3 pb-3 mt-4">
						<div class="card h-100 card-shadow card-1">
							<div class="grid">
								<?php if($property->slug!=''): ?>
								<a href="<?php echo e(route('property.show',$property->slug)); ?>" aria-label="<?php echo e($property->name); ?>">
									<figure class="effect-milo">
										<img src="<?php echo e($property->cover_photo); ?>" class="img-fluid" alt="<?php echo e($property->name); ?>"/>
										<figcaption>
										</figcaption>     
									</figure>        
								</a>
								<?php endif; ?>
							</div>

							<div class="card-body p-0 pl-1 pr-1">
								<div class="d-flex">
									<div>
										<div class="profile-img px-2">
											<a href="<?php echo e(url('users/show/'.$property->host_id)); ?>"><img src="<?php echo e($property->users->profile_src); ?>" alt="<?php echo e($property->name); ?>" class=""></a>
										</div>
									</div>

									<div class="p-2 text">
										<?php if($property->slug!=''): ?>
										<a class="text-color text-color-hover" href="<?php echo e(route('property.show',$property->slug)); ?>">
											<p class="text-16 font-weight-700 text"> <?php echo e($property->name); ?></p>
										</a>
										<?php endif; ?>
										<p class="text-13 mt-2 mb-0 text"><i class="fas fa-map-marker-alt"></i> <?php echo e(($property && $property->property_address) ? $property->property_address->city : ''); ?></p>
									</div>
								</div>

								<div class="review-0 p-3">
									<div class="d-flex justify-content-between">
										
										<div>
											<span><i class="fa fa-star text-14 secondary-text-color"></i> 
												<?php if( $property->guest_review): ?>
													<?php echo e($property->avg_rating); ?>

												<?php else: ?>
													0
												<?php endif; ?>
												(<?php echo e($property->guest_review); ?>)</span>
										</div>


										<div>
											<span class="font-weight-700"><?php echo moneyFormat( $property->property_price->currency->symbol, $property->property_price->price); ?></span> / <?php echo e(trans('messages.property_single.night')); ?>

										</div>
									</div>
								</div>

								<div class="card-footer text-muted p-0 border-0">
									<div class="d-flex bg-white justify-content-between pl-2 pr-2 pt-2 mb-3">
										<div>
											<ul class="list-inline">
												<li class="list-inline-item  pl-4 pr-4 border rounded-3 mt-2 bg-light text-dark">
														<div class="vtooltip"> <i class="fas fa-user-friends"></i> <?php echo e($property->accommodates); ?>

														<span class="vtooltiptext text-14"><?php echo e($property->accommodates); ?> <?php echo e(trans('messages.property_single.guest')); ?></span>
													</div>
												</li>

												<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-2 bg-light">
													<div class="vtooltip"> <i class="fas fa-bed"></i> <?php echo e($property->bedrooms); ?>

														<span class="vtooltiptext  text-14"><?php echo e($property->bedrooms); ?> <?php echo e(trans('messages.property_single.bedroom')); ?></span>
													</div>
												</li>

												<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-2 bg-light">
													<div class="vtooltip"> <i class="fas fa-bath"></i> <?php echo e($property->bathrooms); ?>

														<span class="vtooltiptext  text-14 p-2"><?php echo e($property->bathrooms); ?> <?php echo e(trans('messages.property_single.bathroom')); ?></span>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php if(!$testimonials->isEmpty()): ?>
	<section class="testimonialbg pb-70">
		<div class="testimonials">
			<div class="container">
				<div class="row">
					<div class="recommandedhead section-intro text-center mt-70">
						<p class="animated fadeIn text-24 text-color font-weight-700 m-0"><?php echo e(trans('messages.home.say_about_us')); ?></p>
						<p class="mt-2"><?php echo e(trans('messages.home.people_say')); ?></p>
					</div>
				</div>

				<div class="row mt-5">
					<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php $i = 0; ?>
						<div class="col-md-4 mt-4">
							<div class="item h-100 card-1">
								<img src="<?php echo e($testimonial->image_url); ?>" alt="<?php echo e($testimonial->name); ?>">
								<div class="name"><?php echo e($testimonial->name); ?></div>
									<small class="desig"><?php echo e($testimonial->designation); ?></small>
									<p class="details"><?php echo e(substr($testimonial->description, 0, 50)); ?> </p>
									<ul>
										<?php for($i = 0; $i < 5; $i++): ?>
											<?php if($testimonial->review >$i): ?>
												<li><i class="fa fa-star secondary-text-color" aria-hidden="true"></i></li>
											<?php else: ?>
												<li><i class="fa fa-star rating" aria-hidden="true"></i></li>
											<?php endif; ?>
										<?php endfor; ?>                  
									</ul>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>  
		</div>
	</section>
	<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/dint/resources/views/home/home.blade.php ENDPATH**/ ?>