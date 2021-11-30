	@if($reviewDetails->reviewer == 'host')
		<div class="col-md-12 p-0">
			<div class="container-fluid min-height">  
				<div class="col-md-12  p-0">
					<div class="main-panel">
						<div class="row">
							<div class="col-md-12">    
								<div class="review-div">
									<div class="form-group">
										<label for="message" class="font-weight-700">{{ trans('messages.reviews.describe_your_exp') }} <span class="text-danger"></span></label>
										<p class="text-15">{{ $reviewDetails->message }}</p>
									</div>

									<div class="form-group">
										<label for="message" class="font-weight-700">{{ trans('messages.reviews.private_guest_feedback') }}</label>
										<p class="text-15">{{$reviewDetails->secret_feedback}}</p>
									</div>

									<div class="form-group">
										<label for="message" class="font-weight-700">{{ trans('messages.reviews.cleanliness_host_desc') }}</label>
										<div class="background   text-15"  >
											@for($i=1; $i <=5 ; $i++)
												@if($reviewDetails->cleanliness >= $i)
													<i class="fa fa-star icon-beach"></i>
												@else
													<i class="fa fa-star"></i>
												@endif
											@endfor
										</div>
										<p class="text-15">{{ $reviewDetails->cleanliness_message }}</p>
									</div>

									<div class="form-group">
										<label for="message" class="font-weight-700">{{ trans('messages.reviews.communication_host_desc') }}</label>
										<div class="background mb20 text-15"  >
											@for($i=1; $i <=5 ; $i++)
												@if($reviewDetails->communication >= $i)
													<i class="fa fa-star icon-beach"></i>
												@else
													<i class="fa fa-star"></i>
												@endif
											@endfor   
										</div>
										<p class="text-15">{{ $reviewDetails->communication_message }}</p>
									</div>

									<div class="form-group">
										<label for="message" class="font-weight-700">{{ trans('messages.reviews.observance_house_rules_desc') }}</label>
										<div class="background text-15"  >
											@for($i=1; $i <=5 ; $i++)
												@if($reviewDetails->house_rules >= $i)
													<i class="fa fa-star icon-beach"></i>
												@else
													<i class="fa fa-star"></i>
												@endif
											@endfor   
										</div> 
									</div>
								</div>             
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
	<div class="col-md-12 p-0">
		<div class="container-fluid">
			<div class="col-md-12  p-0">
				<div class="main-panel">
					<div class="row">
						<div class="col-md-6">    
							<div class="review-div">
								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.describe_your_exp') }} <span class="text-danger"></span></label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
										@if($reviewDetails->rating >= $i)
										<i class="fa fa-star icon-beach"></i>
										@else
										<i class="fa fa-star"></i>
										@endif
										@endfor
									</div>
									<p class="text-15">{{$reviewDetails->message}}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.communication_comments') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->communication >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{ $reviewDetails->communication_message }}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.accuracy_desc1') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->accuracy >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{$reviewDetails->accuracy_message}}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.location_desc1') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->location >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{$reviewDetails->location_message}}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.private_guest_feedback') }}</label>
									<p class="text-15">{{ $reviewDetails->secret_feedback }}</p>
								</div>
							</div>             
						</div>

						<div class="col-md-6">
							<div class="review-div">
								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.checkin') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->checkin >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{$reviewDetails->checkin_message}}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.amenities_desc1') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->amenities >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{ $reviewDetails->amenities_message }}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.cleanliness_comments') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->cleanliness >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{$reviewDetails->value_message}}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.value_desc1') }}</label>
									<div class="background text-15"  >
										@for($i=1; $i <=5 ; $i++)
											@if($reviewDetails->value >= $i)
												<i class="fa fa-star icon-beach"></i>
											@else
												<i class="fa fa-star"></i>
											@endif
										@endfor
									</div>
									<p class="text-15">{{ $reviewDetails->cleanliness_message }}</p>
								</div>

								<div class="form-group">
									<label for="message" class="font-weight-700">{{ trans('messages.reviews.how_host_improve') }}</label>
									<p class="text-15">{{ $reviewDetails->improve_message }}</p>
								</div>
							</div>  
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endif


