@extends('layouts.master')
@push('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ url('css/daterangepicker.min.css')}}" />
<link  rel="stylesheet" type="text/css" href="{{ url('css/glyphicon.css') }}"/>
<link  rel="stylesheet" type="text/css"  href="{{ url('js/ninja/ninja-slider.min.css') }}" /> --}}
@endpush
@section('main')

<input type="hidden" id="front_date_format_type" value="{{ Session::get('front_date_format_type')}}">

<div class="carousel-inner" role="listbox">
	<div class="item active">
		<div class="ex-image-container" onclick="lightbox(0)" style="background-image:url({{$result->cover_photo}});">
		</div>
	</div>
</div>

<div class="container-fluid container-fluid-90">
	<div class="row" id="mainDiv">
		<div class="col-lg-8 col-xl-9">
			<div  id="sideDiv">
				<div class="d-flex border rounded-4 p-4 mt-4">
					<div class="text-center">
						<a href="{{ url('users/show/'.$result->host_id) }}" >
							<img alt="User Profile Image" class="img-fluid circle-avatar mr-4 img-90x90" src="{{ $result->users->profile_src }}" title="{{$result->users->first_name}}">
						</a>
					</div>
					
					<div class="ml-2">
						<h3 class="text-20 mt-4"><strong>{{ $result->name }}</strong></h3>
						@if ($result->property_address)
						<span class="text-14 gray-text"><i class="fas fa-map-marker-alt"></i> {{ $result->property_address->city }} @if($result->property_address->city !=''),@endif {{ $result->property_address->state}} @if($result->property_address->state !=''),@endif {{ ($result->property_address->countries) ? $result->property_address->countries->name : ''}}</span>
						@endif
						@if($result->avg_rating)
								<p>	<i class="fa fa-star secondary-text-color"></i> {{sprintf("%.1f",$result->avg_rating )}} ({{ $result->guest_review }})</p>
						@endif
					</div>
				</div>
	
				<div class="row justify-content-between mt-4 ">
					<div class="col text-center border p-4 rounded mt-3 mr-2 mr-sm-5 bg-light text-dark">
						<i class="fa fa-home fa-2x" aria-hidden="true"></i>
						<div>{{ $result->space_type_name }}</div>
					</div>
			
					<div class="col text-center border p-4 rounded mt-3 bg-light text-dark">
						<i class="fa fa-users fa-2x" aria-hidden="true"></i>
						<div> {{ $result->accommodates }} {{trans('messages.property_single.guest')}} </div>
					</div>
			
					<div class="col text-center border p-4 rounded mt-3 ml-2 ml-sm-5 bg-light text-dark">
						<i class="fa fa-bed fa-2x" aria-hidden="true"></i>
						<div>
							{{ $result->beds}} {{trans('messages.property_single.bed')}}
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-xl-3 mb-4 mt-4">
			<div id="sticky-anchor" class="d-none d-md-block"></div>
			<div class="card p-4">
				<div id="booking-price" class="panel panel-default">
					<div  class="" id="booking-banner" class="">
						<div class="secondary-bg rounded">
							<div class="col-lg-12">
								<div class="row justify-content-between p-3">
									<div class="text-white">
										@if ($result->property_price && $result->property_price->currency && $result->property_price)
											{!! moneyFormat($result->property_price->currency->symbol, $result->property_price->price) !!}
										@endif
									</div>
			
									<div class="text-white text-14">
										<div id="per_night" class="per-night">
										{{trans('messages.property_single.per_night')}}
										</div>
										<div id="per_month" class="per-month display-off">
										{{trans('messages.property_single.per_month')}}
										<i id="price-info-tooltip" class="fa fa-question hide" data-behavior="tooltip"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
	
					<div class="mt-4">
						<form accept-charset="UTF-8" method="post" action="{{ url('payments/book/'.$property_id) }}" id="booking_form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-12  p-4 single-border border-r-10 ">
									<div class="row p-2" id="daterange-btn">
										<div class="col-6 p-0">
											<label>{{trans('messages.property_single.check_in')}}</label>
											<div class="mr-2">
												<input class="form-control" id="startDate" name="checkin" value="{{ $checkin ? $checkin : onlyFormat(date('d-m-Y')) }}" placeholder="dd-mm-yyyy" type="text" required>
											</div>
										</div>
		
										<input type="hidden" id="property_id" value="{{ $property_id }}">
										<input type="hidden" id="room_blocked_dates" value="" >
										<input type="hidden" id="calendar_available_price" value="" >
										<input type="hidden" id="room_available_price" value="" >
										<input type="hidden" id="price_tooltip" value="" >
										<input type="hidden" id="url_checkin" value="{{$checkin}}" >
										<input type="hidden" id="url_checkout" value="{{$checkout }}" >
										<input type="hidden" id="url_guests" value="{{ $guests }}" >
										<input type="hidden" name="booking_type" id="booking_type" value="{{ $result->booking_type }}" >
						
										<div class="col-6 p-0">
											<label>{{trans('messages.property_single.check_out')}}</label>
											<div class="ml-2">
												<input class="form-control" id="endDate" name="checkout" value="{{ $checkout ? $checkout : onlyFormat(date('d-m-Y', time() + 86400)) }}" placeholder="dd-mm-yyyy" type="text" required>
											</div>
										</div>
									</div>
		
									<div class="row mt-4">
										<div class="col-md-12 p-0">
											<div class=" ml-2 mr-2 ">
												<label>{{trans('messages.property_single.guest')}}</label>
												<div class="">
													<select id="number_of_guests" class="form-control" name="number_of_guests">
													@for($i=1;$i<= $result->accommodates;$i++)
														<option value="{{ $i }}" <?= $guests == $i?'selected':''?>>{{ $i }}</option>
													@endfor
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						
						<div id="book_it" class="mt-4">
							<div class="js-subtotal-container booking-subtotal panel-padding-fit">
								<div id="loader" class="display-off single-load">
									<img src="{{URL::to('/')}}/front/img/green-loader.gif" alt="loader">
								</div>
								
								<table class="table table-bordered price_table" id="booking_table">
									<tbody>
									<tr>
										<td class="pl-4">
											@if ($result->property_price && $result->property_price->currency)
											{!! moneyFormat($result->property_price->currency->symbol, $result->property_price->price) !!} x <span  id="total_night_count" value="">0</span> {{trans('messages.property_single.night')}}
											@else
											N/A
											@endif

										</td>
										<td class="pl-4"><span  id="total_night_price" value=""> 0 </span> <span id="custom_price" class="fa fa-info-circle secondary-text-color" data-html="true" data-toggle="tooltip" data-placement="top" title=""></span></td> 
									</tr>

									<tr>
										<td class="pl-4">
											{{trans('messages.property_single.service_fee')}}
										</td>
										<td class="pl-4"><span  id="service_fee" value=""> 0 </span></td>
									</tr>

									<tr class ="additional_price"> 
										<td class="pl-4">
											{{trans('messages.property_single.additional_guest_fee')}}
										</td>
										<td class="pl-4">{!! ($result->property_price && $result->property_price->currency) ? $result->property_price->currency->symbol : '' !!}<span  id="additional_guest" value=""> 0 </span></td>
									</tr>

									<tr class = "security_price"> 
										<td class="pl-4">
										{{trans('messages.property_single.security_fee')}}
										</td>
										<td class="pl-4">{!! ($result->property_price && $result->property_price->currency) ? $result->property_price->currency->symbol : '' !!}<span  id="security_fee" value=""> 0 </span></td>
									</tr>

									<tr class = "cleaning_price"> 
										<td class="pl-4">
											{{trans('messages.property_single.cleaning_fee')}}
										</td>
										<td class="pl-4">{!! ($result->property_price && $result->property_price->currency) ? $result->property_price->currency->symbol : ''!!}<span  id="cleaning_fee" value=""> 0 </span></td>
									</tr>

									<tr>
										<td class="pl-4">
											Discount
										</td>
										<td class="pl-4">{!! ($result->property_price && $result->property_price->currency) ? $result->property_price->currency->symbol : '' !!} <span  id="discount" value=""> 0 </span></td>
									</tr>
			
									<tr>
										<td class="pl-4">{{trans('messages.property_single.total')}}</td>
										<td class="pl-4"><span  id="total" value=""> 0 </span></td>
									</tr>
									</tbody>
								</table>
							</div>
							<div id="book_it_disabled" class="text-center d-none">
							<p id="book_it_disabled_message" class="icon-rausch">
								{{trans('messages.property_single.date_not_available')}}
							</p>
							<a href="{{URL::to('/')}}/search?location={{ ($result->property_address) ? $result->property_address->city : '' }}" class="btn btn-large btn-block text-14" id="view_other_listings_button">
								{{trans('messages.property_single.view_other_list')}}
							</a>
							</div>

							<div class="book_btn col-md-12 text-center {{ ($result->host_id == @Auth::guard('users')->user()->id || $result->status == 'Unlisted') ? 'display-off' : '' }}">

							<button type="submit" class="btn vbtn-outline-success text-14 font-weight-700 mt-3 pl-5 pr-5 pt-3 pb-3" id="save_btn">
								<i class="spinner fa fa-spinner fa-spin d-none"></i>
								 <span class="{{ ($result->booking_type != 'instant') ? '' : 'display-off' }}">
								{{trans('messages.property_single.request_book')}}
								</span>
								<span class="{{ ($result->booking_type == 'instant') ? '' : 'display-off' }}">
								<i class="icon icon-bolt text-beach h4"></i>
								{{trans('messages.property_single.instant_book')}}
								</span>
							</button>
							</div> 
							
							<p class="col-md-12 text-center mt-3">{{trans('messages.property_single.review_of_pay')}}</p>
							
							<ul class="list-inline text-center d-flex align-items-center justify-content-center">
								<li class="list-inline-item">
									@php
										echo '<iframe src="https://www.facebook.com/plugins/share_button.php?href='.$shareLink.'&layout=button&size=large&mobile_iframe=true&width=73&height=28&appId" width="76" height="28" class="overflow-hidden border-0" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
									@endphp
								</li>

								<li class="list-inline-item">
									<a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=".$title data-size="large" aria-label="tweet">Tweet</a>
								</li>

								<li class="list-inline-item">
									<a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareLink }}&title={{ $title }}&summary={{ ($result->property_description) ? $result->property_description->summary : '' }}" aria-label="linkedin" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="shareButton">
										<i class="fab fa-linkedin-in"></i> Share
									</a>
								</li>
							</ul>
						</div>
						<input id="hosting_id" name="hosting_id" type="hidden" value="{{ $result->id }}">
						</form>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	{{-- erorr check here --}}
	<div class="row mt-4 mt-sm-0">
		<div class="col-lg-8 col-xl-9 col-sm-12">
			<div class="row  justify-content-center border rounded pb-5"  id="listMargin">
				<div class="col-md-12 mt-3 pl-4 pr-4">
					<div class="mt-3">
						<div class="row">
							<div class="col-md-12">
								<h2><strong>{{trans('messages.property_single.about_list')}}</strong> </h2>
								<p class="mt-4 text-justify" >{{ ($result->property_description) ? $result->property_description->summary : '' }}</p>
							</div>
						</div>
					</div>

					<div class="mt-3">
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18"> {{trans('messages.property_single.the_space')}}</h2>
									</div>
								</div>
							</div>

							<div class="col-md-9 col-sm-9">
								<div class="row">
								<div class="col-md-6 col-sm-6">
									@if(@$result->bed_types->name != NULL)
										<div><span  class="font-weight-600">{{trans('messages.property_single.bed_type')}}:</span> {{ @$result->bed_types->name }}</div>
									@endif
									<div><strong>{{trans('messages.property_single.property_type')}}:</strong> {{ $result->property_type_name }}</div>
									<div><strong>{{trans('messages.property_single.accommodate')}}:</strong> {{ @$result->accommodates }}</div>
								</div>
								<div class="col-md-6 col-sm-6">
									<div><strong>{{trans('messages.property_single.bedroom')}}:</strong> {{ @$result->bedrooms }}</div>

									<div><strong>{{trans('messages.property_single.bathroom')}}:</strong> {{ @$result->bathrooms }}</div>

									<div><strong>{{trans('messages.property_single.bed')}}:</strong> {{ @$result->beds }}</div>
								</div>
								</div>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18">  {{trans('messages.property_single.amenity')}}</h2>
									</div>
								</div>
							</div>
						
							<div class="col-md-9 col-sm-9">
								<div class="row">
									@php $i = 1 @endphp

									@php $count = round(count($amenities)/2) @endphp
									@foreach($amenities as $all_amenities)
										@if($i < 6)
										<div class="col-md-6 col-sm-6">
											<div>
											<i class="icon h3 icon-{{ $all_amenities->symbol }}" aria-hidden="true"></i> 
											@if($all_amenities->status == null)
												<del> 
											@endif
											{{ $all_amenities->title }}
											@if($all_amenities->status == null)
												</del> 
											@endif
											</div> 
										</div>
										@php $i++ @endphp
										@endif
									@endforeach

									<div class="col-md-6 col-sm-6" id="amenities_trigger">
										<button type="button"   class="btn btn-outline-dark btn-lg text-16 mt-4 mr-2" data-toggle="modal" data-target="#exampleModalCenter">
											+ {{trans('messages.property_single.more')}}
										</button>
									</div>

									<div class="row">
										<!-- Modal -->
										<div class="modal fade mt-5 z-index-high" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<div class="w-100 pt-3">
															<h5 class="modal-title text-20 text-center font-weight-700" id="exampleModalLongTitle">{{trans('messages.property_single.amenity')}}</h5>
														</div>
							
														<div>
															<button type="button" class="close text-28 mr-2 filter-cancel" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div> 
													</div>
							
													<div class="modal-body pb-5">
														<div class="row">
															<div class="col-sm-12">
																<div class="row">
																	@php $i = 1 @endphp
																	@foreach($amenities as $all_amenities)
																	@if($i > 6)
																		<div class="col-md-6 col-sm-6 mt-3">
																		<div>
																			<i class="icon h3 icon-{{ $all_amenities->symbol }}" aria-hidden="true"></i> 
																			@if($all_amenities->status == null)
																			<del> 
																			@endif
																			{{ $all_amenities->title }}
																			@if($all_amenities->status == null)
																			</del> 
																			@endif
																		</div> 
																		</div>
																	@endif
																	@php $i++ @endphp
																	@endforeach
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>  

						<hr>
						
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18">{{trans('messages.property_single.price')}}</h2>
									</div>
								</div>
							</div>

							<div class="col-md-9 col-sm-9">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div>{{trans('messages.property_single.extra_people')}}:
											<strong> 
												@if($result->property_price && $result->property_price->currency && $result->property_price->guest_fee !=0)                
													<span> {!! moneyFormat($result->property_price->currency->symbol, $result->property_price->guest_fee) !!} / {{trans('messages.property_single.after_night')}} {{$result->property_price->guest_after}} {{trans('messages.property_single.guests')}}</span>
												@else
													<span >{{trans('messages.property_single.no_charge')}}</span>
												@endif
											</strong>
										</div>

										<div>
											{{trans('messages.property_single.weekly_discount')}} (%): 
											@if($result->property_price && $result->property_price->currency)
												<strong> <span id="weekly_price_string">{!! moneyFormat($result->property_price->currency->symbol, $result->property_price->weekly_discount) !!}</span> /{{trans('messages.property_single.week')}}</strong>
											@else
												N/A
											@endif
										</div>
									
									</div>

									<div class="col-md-6 col-sm-6">
										<div>
											{{trans('messages.property_single.monthly_discount')}} (%):
											@if( $result->property_price && $result->property_price->currency)
												<strong> 
													<span id="weekly_price_string">{!! moneyFormat($result->property_price->currency->symbol, $result->property_price->monthly_discount) !!}</span> /{{trans('messages.property_single.month')}}
												</strong>
											@else
												<strong><span id="weekly_price_string">N/A</span> /{{trans('messages.property_single.month')}}</strong>
											@endif
										</div>

										<!-- weekend price -->
										@if($result->property_price && $result->property_price->weekend_price > 0)
											<div>
											{{trans('messages.listing_price.weekend_price')}}:
												<strong> 
													@if($result->property_price && $result->property_price->currency)
														<span id="weekly_price_string">{!! $result->property_price->currency->symbol !!} {{ $result->property_price->weekend_price }}</span> / {{trans('messages.listing_price.weekend')}}
													@endif
												</strong>
											</div>
										@endif
										<!-- end weekend price -->
									</div>
								</div>
							</div>
						</div>

						@if(count($safety_amenities) !=0)
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<div class="d-flex h-100">
										<div class="align-self-center">
											<h2 class="font-weight-700 text-18">{{trans('messages.property_single.safety_feature')}}</h2>
										</div>
									</div>
								</div>

								<div class="col-md-9 col-sm-9">
									<div class="row">
										@foreach($safety_amenities as $row_safety)
											<div class="col-md-6 col-sm-6">
												<i class="fa h3 fa-{{ $all_amenities->symbol }}" aria-hidden="true"></i> 
												@if($row_safety->status == null)
													<del> 
												@endif
													{{ $row_safety->title }}
												@if($row_safety->status == null)
													</del> 
												@endif
											</div>
										@endforeach
									</div>
								</div>
							</div>
						@endif

						<hr>
						<div class="row">
							<div class="col-md-3 col-sm-3">
								<div class="d-flex h-100">
									<div class="align-self-center">
										<h2 class="font-weight-700 text-18">{{trans('messages.property_single.avialability')}}</h2>
									</div>
								</div>
							</div>
						
							<div class="col-md-9 col-sm-9">
								<div class="row">
									<div class="col-md-6 col-sm-6">
										<div>1 {{trans('messages.property_single.night')}}</div>
									</div>

									<div class="col-md-6 col-sm-6">
										<a id="view-calendar" href="javascript:void(0)" class="text-color text-color-hover"><strong>{{trans('messages.property_single.view_calendar')}}</strong></a>
									</div>
								</div>
							</div>
						</div>

						@if(@$result->property_description->about_place !='' || @$result->property_description->place_is_great_for !='' || @$result->property_description->guest_can_access !='' || @$result->property_description->interaction_guests !='' || @$result->property_description->other || @$result->property_description->about_neighborhood || @$result->property_description->get_around) 
							<hr>
							<div class="row">
								<div class="col-md-3 col-sm-3">
									<div class="d-flex h-100">
										<div class="align-self-center">
											<h2 class="font-weight-700 text-18">{{trans('messages.property_single.description')}}</h2>
										</div>
									</div>
								</div>

								<div class="col-md-9 col-sm-9">
									@if($result->property_description->about_place)
										<strong class="font-weight-700">{{trans('messages.property_single.about_place')}}</strong>
										<p class="text-justify">{{ $result->property_description->about_place}}</p>
									@endif

									@if($result->property_description->place_is_great_for)
										<strong class="font-weight-700">{{trans('messages.property_single.place_great_for')}}</strong>
										<p  class="text-justify">{{ $result->property_description->place_is_great_for}} </p>
									@endif

									<a href="javascript:void(0)" id="description_trigger" data-rel="description" class="more-btn"><strong>+ {{trans('messages.property_single.more')}}</strong></a>
									<div class="d-none" id='description_after'>
										@if($result->property_description->interaction_guests)
											<strong class="font-weight-700">{{trans('messages.property_single.interaction_guest')}}</strong>
											<p  class="text-justify"> {{ $result->property_description->interaction_guests}}</p>
										@endif

										@if($result->property_description->about_neighborhood)
											<strong class="font-weight-700">{{trans('messages.property_single.about_neighborhood')}}</strong>
											<p  class="text-justify"> {{ $result->property_description->about_neighborhood}}</p>
										@endif

										@if($result->property_description->guest_can_access)
											<strong class="font-weight-700">{{trans('messages.property_single.guest_access')}}</strong>
											<p  class="text-justify">{{ $result->property_description->guest_can_access}}</p>
										@endif

										@if($result->property_description->get_around)
											<strong class="font-weight-700">{{trans('messages.property_single.get_around')}}</strong>
											<p  class="text-justify">{{ $result->property_description->get_around}}</p>
										@endif

										@if($result->property_description->other)
											<strong class="font-weight-700">{{trans('messages.property_single.other')}}</strong>
											<p  class="text-justify">{{ $result->property_description->other}}</p>
										@endif
										<a href="javascript:void(0)" id="description_less" data-rel="description" class="less-btn"><strong>- less</strong></a>

									</div>
								</div>
							</div>
						@endif
						<hr>

						<!--popup slider-->
						<div class="d-none" id="showSlider">
							<div id="ninja-slider">
								<div class="slider-inner">
									<ul>
										@foreach($property_photos as $row_photos)
											<li>
												<a class="ns-img" href="{{ s3Url($row_photos->photo, $property_id) }}" aria-label="photo"></a>
											</li>
										@endforeach
									</ul>
									<div id="fsBtn" class="fs-icon" title="Expand/Close"></div>
								</div>
							</div>
						</div>

						<!--popup slider end-->
						@if(count($property_photos) > 0)
							<div class="row mt-4">
								<div class="col-md-12 col-sm-12 pl-3 pr-3">
									<div class="row">
										@php $i=0 @endphp
										
										@foreach($property_photos as $row_photos)
											@if($i == 0)
												<div class="col-md-12 col-sm-12 mb-2 mt-2 p-2">
													<div class="slider-image-container" onclick="lightbox({{$i}})" style="background-image:url({{ s3Url($row_photos->photo, $property_id) }});">
													</div>
												</div>
											@elseif($i <= 4)
												@if($i==4) 
													<div class="col-md-3 col-sm-4 mt-2 p-2">
														<div class="view-all">
															<img src="{{  s3Url($row_photos->photo, $property_id) }}" alt="property-photo" class="img-fluid rounded" onclick="lightbox({{$i}})" />
															<span class="position-center cursor-pointer" onclick="lightbox({{$i}})">{{trans('messages.property_single.view_all')}}</span>
														</div>
													</div> 
													
												@else 
													<div class="col-md-3 col-sm-4 mt-2  p-2">
														<img src="{{ s3Url($row_photos->photo, $property_id) }}" alt="property-photo" class="img-fluid rounded" onclick="lightbox({{$i}})" />
													</div>
												@endif
											@else
												@php break; @endphp
											@endif
											@php $i++ @endphp
										@endforeach
									</div>
								</div>
							</div>
							<hr>
						@endif
					</div>
				
					<!--Start Reviews-->
					@if(!$result->reviews->count())
						<div class="mt-5">
							<div class="row">
								<div class="col-md-12">
									<h2><strong>{{ trans('messages.reviews.no_reviews_yet') }}</strong></h2>
								</div>

								@if($result->users->reviews->count())
								<div class="col-md-12">
									<p>{{ trans_choice('messages.reviews.review_other_properties', $result->users->guest_review, ['count'=>$result->users->guest_review]) }}</p>
									<p class="text-center mt-5 mb-4">
										<a href="{{ url('users/show/'.$result->users->id) }}" class="btn btn vbtn-outline-success text-14 font-weight-700 pl-5 pr-5 pt-3 pb-3">{{ trans('messages.reviews.view_other_reviews') }}</a>
									</p>
								</div>
								@endif
							</div>
						</div>
					@else
						<div class="mt-5">
							<div class="row">
								<div class="col-md-12">
									<div class="d-flex">
										<div>
											<h2 class="text-20"><strong> {{ trans_choice('messages.reviews.review',$result->guest_review) }}</strong></h2>
										</div>

										<div class="ml-4"> 
											<p>	<i class="fa fa-star secondary-text-color"></i> {{sprintf("%.1f",$result->avg_rating )}} ({{ $result->guest_review }})</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="mt-3">
							<div class="row">
								<div class="col-md-12">
									<h3 class="font-weight-700 text-16">{{ trans('messages.property_single.summary') }}</h3>
								</div>
	
								<div class="col-md-12">
									<div class="mt-3 p-4 pt-3 pb-3 border rounded">
										<div class="row justify-content-between">
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.accuracy') }}</h4>
													</div>
		
													<div >
														<progress max="5" value="{{$result->accuracy_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->accuracy_avg_rating)}}</span>
													</div>
												</div>
											</div>
										
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.location') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->location_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->location_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4 class="text-truncate">{{ trans('messages.reviews.communication') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->communication_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->communication_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.checkin') }}</h4>
													</div>
		
													<div>
														<progress max="5" value="{{$result->checkin_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->checkin_avg_rating)}}</span>
													</div>
												</div>
											</div>
										
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.cleanliness') }}</h4> 
													</div>
		
													<div>
														<progress max="5" value="{{$result->cleanliness_avg_rating}}">
															<div class="progress-bar">
																<span></span>
															</div>
														</progress>
														<span> {{sprintf("%.1f",$result->cleanliness_avg_rating)}}</span>
													</div>
												</div>
											</div>
		
											<div class="col-md-6 col-xl-5">
												<div class="d-flex justify-content-between">
													<div>
														<h4>{{ trans('messages.reviews.value') }}</h4>
													</div>
		
													<div>
														<ul>
															<li>
																<progress max="5" value="{{$result->value_avg_rating}}">
																	<div class="progress-bar">
																		<span></span>
																	</div>
																</progress>
																<span> {{sprintf("%.1f",$result->value_avg_rating)}}</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="mt-5">
							<div class="row">
								@foreach($result->reviews as $row_review)
									@if($row_review->reviewer == 'guest')
										<div class="col-12 mt-4 mb-2">
											<div class="d-flex">
												<div class="">
													<div class="media-photo-badge text-center">
														<a href="{{ url('users/show/'.$row_review->users->id) }}" ><img alt="{{ $row_review->users->first_name }}" class="" src="{{ $row_review->users->profile_src }}" title="{{ $row_review->users->first_name }}"></a>
													</div>
												</div>
							
												<div class="ml-2 pt-2">
													<a href="{{ url('users/show/'.$row_review->users->id) }}" >
														<h2 class="text-16 font-weight-700">{{ $row_review->users->full_name }}</h2>
													</a>
													<p class="text-14 text-muted"><i class="far fa-clock"></i> {{ dateFormat($row_review->date_fy) }}</p>
												</div>
											</div>
										</div>
	
										<div class="col-12 mt-2">
											<div class="background text-15"  >
												@for($i=1; $i <=5 ; $i++)
													@if($row_review->rating >= $i)
														<i class="fa fa-star secondary-text-color"></i>
													@else
														<i class="fa fa-star"></i>
													@endif
												@endfor
											</div>
											<p class="mt-2 text-justify pr-4">{{ $row_review->message }}</p>
										</div>
									@endif
								@endforeach
							</div>
						</div>

						<div class="mt-4">
							@if($result->users->reviews->count() - $result->reviews->count())
								<div class="row">
									
									<div class="col-md-12">
										<p class="text-center mt-2">
											<a target="blank" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5" href="{{ url('users/show/'.$result->users->id) }}">
												<span>{{ trans('messages.reviews.view_other_reviews') }}</span>
											</a>
										</p>
									</div>
								</div>
							@endif
						</div>
					@endif
					<hr>
					<!--End Reviews-->
					<div class="mt-5">
						<div class="col-md-12">
							<div class="clearfix"></div>
							<h2><strong>{{trans('messages.property_single.about_host')}}</strong></h2> 
							<div class="d-flex mt-4">
								<div class="">
									<div class="media-photo-badge text-center">
										<a href="{{ url('users/show/'.$result->host_id) }}"><img alt="{{ $result->users->first_name }}" class="circle-avatar" src="{{ $result->users->profile_src }}" title="{{ $result->users->first_name }}"></a>
									</div>
								</div>

								<div class="ml-2 pt-3">
									<a href="{{ url('users/show/'.$result->host_id) }}">
										<h2 class="text-16 font-weight-700">{{ $result->users->full_name }}</h2>
									</a>
									<p>{{trans('messages.users_show.member_since')}} {{ date('F Y', strtotime($result->users->created_at))  }}</p>
								</div>
							</div> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid container-fluid-90 mt-70">
	<div class="row mt-5">
		<div class="col-md-12">
			<div id="room-detail-map" class="single-map-w"></div>
		</div>
	</div>
</div>

	<div class="container-fluid container-fluid-90 mt-70 mb-5">
		@if(count($similar)!= 0)
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-center-sm text-20 font-weight-700">{{trans('messages.property_single.similar_list')}}</h2>
				</div>
			</div>

			<div class="row m-0 mt-5 mb-5">
				@foreach($similar->slice(0, 8) as $row_similar)
					<div class="col-md-6 col-lg-4 col-xl-3 p-2 mt-4 pl-4 pr-4">
						<div class="card h-100 border card-1">
							<div class="grid">
								<a href="{{ route('property.show',$row_similar->slug) }}">
									<figure class="effect-milo">
										<img src="{{ $row_similar->cover_photo }}" alt="img11"/>
										<figcaption>
										</figcaption>     
									</figure>        
								</a>
							</div>

							<div class="card-body p-0 pl-1 pr-1">
								<div class="d-flex">
									<div>
										<div class="profile-img pl-2 pr-1">
											<a href="{{ url('users/show/'.$row_similar->host_id) }}"><img src="{{ $row_similar->users->profile_src }}" alt="profile-photo"></a>
										</div>
									</div>
			
									<div class="p-2 text">
										<a class="text-color text-color-hover" href="{{ route('property.show',$row_similar->slug) }}">
											<h4 class="text-16 font-weight-700 text"> {{ $row_similar->name}}</h4>
										</a>
										<p class="text-14 mt-2 mb-0 text"><i class="fas fa-map-marker-alt"></i> {{($row_similar && $row_similar->property_address) ? $row_similar->property_address->city : ''}}</p>
									</div>
								</div> 
			
								<div class="review-0 p-3">
									<div class="d-flex justify-content-between">
										
										<div>
											<span><i class="fa fa-star text-14 secondary-text-color"></i> 
												@if( $row_similar->reviews_count)
													{{ $row_similar->avg_rating }}
												@else
													0
												@endif
												({{ $row_similar->reviews_count }})</span>
										</div>
			
			
										<div>
											<span class="font-weight-700">{!! moneyFormat( $row_similar->property_price->currency->symbol, $row_similar->property_price->price) !!}</span> / {{trans('messages.property_single.night')}}
										</div>
									</div>
								</div>
			
								<div class="card-footer text-muted p-0 border-0">
									<div class="d-flex bg-white justify-content-between pl-2 pr-2 pt-2 mb-3">
										<div>
										<ul class="list-inline">
											<li class="list-inline-item  pl-4 pr-4 border rounded-3 mt-4 bg-light text-dark">
												<div class="vtooltip"> <i class="fas fa-user-friends"></i> {{ $row_similar->accommodates }}
												<span class="vtooltiptext text-14">{{ $row_similar->accommodates }} {{trans('messages.property_single.guest')}}</span>
											</div>
										</li>
			
											<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-4 bg-light text-dark">
											<div class="vtooltip"> <i class="fas fa-bed"></i> {{ $row_similar->bedrooms }}
												<span class="vtooltiptext  text-14">{{ $row_similar->bedrooms }} {{trans('messages.property_single.bedroom')}}</span>
											</div>
											</li>
			
											<li class="list-inline-item pl-4 pr-4 border rounded-3 mt-4 bg-light text-dark">
											<div class="vtooltip"> <i class="fas fa-bath"></i> {{ $row_similar->bathrooms }}
												<span class="vtooltiptext  text-14 p-2">{{ $row_similar->bathrooms }} {{trans('messages.property_single.bathroom')}}</span>
											</div>
											</li>
										</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endif
	</div>
@push('scripts')

<script type="text/javascript">

	var checkin = $('#startDate').val();
	var checkout = $('#endDate').val();
	var page = 'single'

	dateRangeBtn(checkin, checkout, page);
		
<script type="text/javascript">
$("#view-calendar").on("click", function() {
	return $("#startDate").trigger("select");
})

$( window ).resize(function() {
	if ($(window).width() < 760) {
		$("#listMargin").css({"margin-top": "0px"});
	} else {
		sticky_relocate();
	}
});

function sticky_relocate() {
	var window_top = $(window).scrollTop();
	var list_div = $("#listMargin").height();

	var div_top = $('#sticky-anchor').offset().top;
	if (window_top > div_top && $(window).width() > 992) {
		$('#booking-price').addClass('stick');
		$('#sticky-anchor').height($('#sticky').outerHeight());
		$("#listMargin").addClass('mt-25');
		$("#listMargin").css({"margin-top": "25px"});
		divAdjust();
	} else {
		$('#booking-price').removeClass('stick');
		$('#sticky-anchor').height(0);
		divAdjust();
	}
	if(window_top > list_div){
		$('#booking-price').addClass('d-none');
	}else{
		$('#booking-price').removeClass('d-none');
	}
}

function divAdjust() {
	if ($(window).width() > 992) {
		var mainDiv = $("#mainDiv").height();
		var sideDiv = $("#sideDiv").height();
		var listMargin = (mainDiv - sideDiv)-40;
		$("#listMargin").css({"margin-top": "-"+listMargin +"px"});
	}
	else {
			// More than 960
	}
}

$(function(){
	var checkin     = $('#url_checkin').val();
	var checkout    = $('#url_checkout').val();
	var guest       = $('#url_guests').val();
	price_calculation(checkin, checkout, guest);
});

$('#number_of_guests').on('change', function(){
	price_calculation('', '', '');
});

function price_calculation(checkin, checkout, guest){
	var checkin = checkin != ''? checkin:$('#startDate').val();
	var checkout = checkout != ''? checkout:$('#endDate').val();
	var guest = guest != ''? guest:$('#number_of_guests').val();
	if(checkin != '' && checkout != '' &&  guest != ''){
	var property_id     = $('#property_id').val();
	var dataURL = '{{url("property/get-price")}}';
		$.ajax({
			url: dataURL,
			data: {
				"_token": "{{ csrf_token() }}",
				'checkin': checkin,
				'checkout': checkout,
				'guest_count': guest, 
				'property_id': property_id,
			},
			type: 'post',
			dataType: 'json',
			beforeSend: function (){
				$('.price_table').addClass('d-none');
				show_loader();
			},
			success: function (result) {
				if(result.status == 'Not available'){
				$('.book_btn').addClass('d-none');
				$('.booking-subtotal').addClass('d-none');
				$('#book_it_disabled').removeClass('d-none');
				}else{

				//showing custom price in info icon
				if(!jQuery.isEmptyObject(result.different_price_dates)){
					var output = "{{trans('messages.listing_price.custom_price')}} <br/>";
					for (var ical_date in result.different_price_dates) {
						output += "{{__('messages.account_transaction.date')}}: "+ical_date+" | {{__('messages.utility.price')}}: "+"{{($result->property_price && $result->property_price->currency) ? $result->property_price->currency->symbol : ''}}"+ result.different_price_dates[ical_date]+" <br>";
					}
					
					$("#custom_price").attr("data-original-title", output);
					$('#custom_price').tooltip({ 'placement': 'top' });   
					$('#custom_price').show();

				}else{
					$('#custom_price').addClass('d-none');
				}

				$('.additional_price').removeClass('d-none');
				$('.security_price').removeClass('d-none');
				$('.cleaning_price').removeClass('d-none');
				$("#total_night_count").html(result.total_nights);
				$('#total_night_price').html(result.total_night_price_with_symbol);
				$('#service_fee').html(result.service_fee_with_symbol);
				$('#discount').html(result.discount);

				if(result.additional_guest != 0) $('#additional_guest').html(result.additional_guest);
				else $('.additional_price').addClass('d-none');
				if(result.security_fee != 0) $('#security_fee').html(result.security_fee);
				else $('.security_price').removeClass('d-none');
				if(result.cleaning_fee != 0) $('#cleaning_fee').html(result.cleaning_fee);
				else $('.cleaning_price').addClass('d-none');
				$('#total').html(result.total_with_symbol);
				//$('#total_night_price').html(result.total_night_price);

				$('.booking-subtotal').removeClass('d-none');
				$('#book_it_disabled').addClass('d-none');
				$('.book_btn').removeClass('d-none');
				}

				var host = "{{ ($result->host_id == @Auth::guard('users')->user()->id) ? '1' : '' }}";
				if(host == '1') $('.book_btn').addClass('d-none');
			},
			error: function (request, error) {
				// This callback function will trigger on unsuccessful action
				console.log(error);
			},
			complete: function(){
				$('.price_table').removeClass('d-none');
				hide_loader();
			}
		});
	}
}

$(function() {
	$(window).scroll(sticky_relocate);
	sticky_relocate();
});

document.addEventListener('readystatechange', event => { 
	if (event.target.readyState === "complete") {
			setTimeout(function() { 
				sticky_relocate();
			}, 1000);
	}
});



$(document).ready(function() {
    $('#booking_form').validate({        
        submitHandler: function(form)
        {

     		$("#save_btn").on("click", function (e)
            {	
            	$("#save_btn").attr("disabled", true);
                e.preventDefault();
            });
            
            $(".spinner").removeClass('d-none');
            $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
            return true;
        }
    });
});

$('.more-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').addClass('d-none');
	$('#'+name+'_after').removeClass('d-none');
});

$('.less-btn').on('click', function(){
	var name = $(this).attr('data-rel');
	$('#'+name+'_trigger').removeClass('d-none');
	$('#'+name+'_after').addClass('d-none');
});

$('#room-detail-map').locationpicker({
	location: {
		latitude: "{{$result->property_address->latitude}}",
		longitude: "{{ $result->property_address->longitude }}"
	},
	radius: 0,
	addressFormat: "",
	markerVisible: false,
	markerInCenter: true,
	enableAutocomplete: true,
	scrollwheel: false,
	oninitialized: function (component) {
		setCircle($(component).locationpicker('map').map);
	}
});

function setCircle(map){
	var citymap = {
	loccenter: {
		center: {lat: 41.878, lng: -87.629},
		population: 240
	},
	};

	var cityCircle = new google.maps.Circle({
		strokeColor: '#329793',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#329793',
		fillOpacity: 0.35,
		map: map,
		center: {lat: {{($result->property_address) ? $result->property_address->latitude : ''}}, lng: {{ ($result->property_address) ? $result->property_address->longitude : '' }} },
		radius: citymap['loccenter'].population
	});
}

function lightbox(idx) {
	//show the slider's wrapper: this is required when the transitionType has been set to "slide" in the ninja-slider.js
	$('#showSlider').removeClass("d-none");
	nslider.init(idx);
	$("#ninja-slider").addClass("fullscreen");
}

function fsIconClick(isFullscreen) { //fsIconClick is the default event handler of the fullscreen button
	if (isFullscreen) {
		$('#showSlider').addClass("d-none");
	}
}

function show_loader(){
	$('#loader').removeClass('d-none');
	$('#pagination').addClass('d-none');
}

function hide_loader(){
	$('#loader').addClass('d-none');
	$('#pagination').removeClass('d-none');
}

window.twttr = (function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
	if (d.getElementById(id)) return t;
	js = d.createElement(s);
	js.id = id;
	js.src = "https://platform.twitter.com/widgets.js";
	fjs.parentNode.insertBefore(js, fjs);
	t._e = [];
	t.ready = function(f) {
		t._e.push(f);
	};

	return t;
	}(document, "script", "twitter-wjs"));
</script>
@endpush 
@stop

<!-- Start of LiveChat (www.livechatinc.com) code -->
<script>
    // window.__lc = window.__lc || {};
    // window.__lc.license = 12872328;
    // ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechatinc.com/chat-with/12872328/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
