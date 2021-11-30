@extends('admin.template')

@section('main')
<div class="content-wrapper">
	<section class="content-header">
		<h1>Message<small>host message</small></h1>
		@include('admin.common.breadcrumb')
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<div class="container">
							<div class="container margin-top30 mb30">
								<div class="col-md-9 col-sm-9 col-xs-12">
									@if($messages[0]->type_id == 4)
										<div class="dialogbox text-center">
											<div class="body">
												<div class="message padding-top10 padding-bottom10">
													<h4>{{ trans('messages.message.request_sent') }}</h4>
													<h5>{{ trans('messages.message.booking_is_not_confirmed') }}</h5>
												</div>
											</div>
										</div>
									@endif

									@if($messages[0]->type_id == 5)
										<div class="dialogbox text-center">
											<div class="body">
												<div class="message padding-top10 padding-bottom10">
													<h4>{{ trans('messages.message.booking_confirmed_place') }} {{ ($messages[0]->bookings->properties->property_address) ? $messages[0]->bookings->properties->property_address->city : '' }}, {{ $messages[0]->bookings->properties->property_address ? $messages[0]->bookings->properties->property_address->country_name : '' }}</h4>
												</div>
											</div>
										</div>
									@endif

									@if($messages[0]->type_id == 6)
										<div class="dialogbox text-center">
											<div class="body">
												<div class="message padding-top10 padding-bottom10">
													<h4>{{ trans('messages.message.request_declined') }}</h4>
													<h5>{{ trans('messages.message.more_places_available') }}</h5>
													<span><a href="{{ url('/') }}/search?location={{ $messages[0]->bookings->properties->property_address ? $messages[0]->bookings->properties->property_address->city : ''}}" class="btn ex-btn navbar-btn topbar-btn">{{ trans('messages.message.keep_searching') }}</a></span>
												</div>
											</div>
										</div>
									@endif

									<div class="col-lg-12 row ml-0">
										<form action="{{url('admin/reply/'.$messages[0]->booking_id )}}" method="post" id="msg_reply">
											{{ csrf_field() }}
											<input type="hidden" value="{{ $messages[0]->booking_id }}" name="booking_id">
											<input type="hidden" name="property_id" value="{{ $messages[0]->bookings->property_id }}">
											<input type="hidden" name="start_date" value="{{ $messages[0]->bookings->start_date }}">
											<input type="hidden" name="end_date" value="{{ $messages[0]->bookings->end_date }}">
											<input type="hidden" name="price" value="{{ $messages[0]->bookings->total }}">
											<textarea rows="3" placeholder="" class="form-control" id="message_text" name="message"></textarea>
											<span class="pull-right"><input type="submit" class="btn ex-btn navbar-btn topbar-btn btn-success" id="reply_message" value="{{ trans('messages.booking_my.send_message') }}"></span>
										</form>
										@if ($errors->has('message')) <p class="error-tag">{{ $errors->first('message') }}</p> @endif
										<div class="clearfix"></div>
									</div>

									<div id="message-list">
										@for($i=0; $i<count($messages); $i++)
											@if($messages[$i]->sender_id ==$messages[0]->bookings->host_id)
												<div class="col-lg-12 row">
													<div class="col-md-2 col-sm-2 col-xs-3">
														<div class="media-photo-badgeSMS text-center">
															<a href="{{ url('admin/edit-customer/'.$messages[$i]->bookings->host_id )}}" ><img class="" src="{{ $messages[$i]->bookings->properties->users->profile_src }}"></a>
														</div>
													</div>

													<div class="col-md-10 col-sm-10 col-xs-9">
														<div class="dialogbox">
															<div class="body">
																<span class="tip tip-left"></span>
																<div class="message">
																	<span>{{ $messages[$i]->message }}</span><br/>
																	<span>{{ dateFormat($messages[$i]->created_time) }}</span>
																</div>
															</div>
														</div>
													</div>
												</div>
											@endif

											@if($messages[$i]->sender_id != $messages[0]->bookings->host_id)
												@if($messages[$i]->type_id == 4)
													<div class="col-lg-12 row">
														<div class="col-md-10 col-sm-10 col-xs-9">
															<div class="dialogbox">
																<div class="body">
																	<div class="h5">
																		{{ trans('messages.message.inquiry_about') }} <a locale="en" data-popup="true" href="{{ url('/') }}/properties/{{ $messages[$i]->bookings->property_id }}">{{ $messages[$i]->bookings->properties->name }}</a>
																	</div>
																	
																	<p class="text-muted">
																		{{ $messages[$i]->bookings->date_range }}
																		·
																		{{ $messages[$i]->bookings->guest }} {{ trans('messages.header.guest') }}{{ ($messages[$i]->bookings->guest > 1) ? 's' : '' }}
																		<br>
																		{{ trans('messages.message.you_will_get') }} {{ $messages[$i]->bookings->currency->symbol.$messages[$i]->bookings->host_payout }}
																	</p>
																</div>
															</div>
														</div>
													</div>
												@endif

												@if(($messages[$i]->bookings->users->profile_image !='') && ($messages[$i]->bookings->users->profile_image != NULL))
													<div class="col-lg-12 row">
														<div class="col-md-10 col-sm-10 col-xs-9">
															<div class="dialogbox">
																<div class="body">
																	<span class="tip tip-right"></span>
																	<div class="message">
																		<span>{{ $messages[$i]->message }}</span><br/>
																		<span>{{ dateFormat($messages[$i]->created_time) }}</span>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-md-2 col-sm-2 col-xs-3">
															<div class="media-photo-badgeSMS text-center">
																<a href="{{ url('admin/edit-customer/'.$messages[$i]->bookings->user_id) }}" ><img src="{{ $messages[$i]->bookings->users->profile_src }}"></a>
															</div>
														</div>
													</div>
												@else
													<div class="col-lg-12 row">
														<div class="col-md-10 col-sm-10 col-xs-9">
															<div class="dialogbox">
																<div class="body">
																<span class="tip tip-right"></span>
																<div class="message">
																	<span>{{ $messages[$i]->message }}</span><br/>
																	<span>{{ dateFormat($messages[$i]->created_time) }}</span>
																</div>
																</div>
															</div>
														</div>

														<div class="col-md-2 col-sm-2 col-xs-3">
															<div class="media-photo-badgeSMS text-center">
																<a href="{{ url('admin/edit-customer/'.$messages[$i]->bookings->user_id) }}" > <img src="{{ $messages[0]->bookings->users->profile_src }}"></a>
															</div>
														</div>
													</div>
												@endif
											@endif
										@endfor
									</div>
								</div>

								<div class="col-md-2 col-sm-2 col-xs-12">
									<div class="panel panel-default row-space-4">
										<div class="mini-profile va-container media panel-body row">
										<div class="va-top">
											<a class="media-photo" href="{{url('admin/edit-customer/'.$messages[0]->bookings->user_id) }}">
											<img width="158" height="100" class="center" alt="{{ $messages[0]->bookings->users->first_name }}" src="{{ $messages[0]->bookings->users->profile_src }}">
											</a>
										</div>

										<div class="va-middle">
											<div class="h4">
											<center><a class="text-normal" href="{{ url('admin/edit-customer/'.$messages[0]->bookings->user_id) }}">{{ $messages[0]->bookings->users->first_name.' '. $messages[0]->bookings->users->last_name }}</a></center>
											&nbsp;<!-- <i data-tooltip-sticky="true" data-tooltip-position="bottom" data-tooltip-el="#verifications-tooltip" class="icon icon-verified-id icon-lima" id="verified-id-icon"></i> -->
											<br>
											<small>
											<center> {{ trans('messages.booking_detail.member_since') }} {{ date('Y',strtotime($messages[0]->bookings->users->created_at)) }}</center>
											</small>
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
	</section>
</div>
@push('scripts')
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('submit', 'form', function() {
			$('#reply_message').attr('disabled', 'disabled');
		});
	});

	$(document).ready(function () {
			$('#msg_reply').validate({
				rules: {
					message: {
						required: true,
					},            
				}
				});
		});
</script>
@endpush
@stop