@extends('layouts.master')

	@section('main')
	<div class="margin-top-85">
		<div class="row m-0">
			<!-- sidebar start-->
			@include('users.sidebar')
			<!--sidebar end-->
			<div class="col-md-10">
				<div class="main-panel min-height mt-4">
					<div class="row justify-content-center">
						<div class="col-md-3 pl-4 pr-4">
							@include('listing.sidebar')
						</div>

						<div class="col-md-9 mt-4 mt-sm-0 pl-4 pr-4">
							<form id="lis_pricing" method="post" action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
								{{ csrf_field() }}
								<div class="form-row mt-4 border rounded pb-4 m-0">
									<div class="form-group col-md-12 main-panelbg pb-3 pt-3 pl-4">
											<h4 class="text-16 font-weight-700">{{trans('messages.listing_price.base_price')}}</h4>
									</div>

									<div class="form-group col-lg-6 pl-5 pr-5">
										<label for="listing_price_native">
											{{trans('messages.listing_price.night_price')}} 
											<span class="text-danger">*</span>
										</label>
										<div class="form-groupw-100">
											<div class="input-group-prepend ">
												<span class="input-group-text line-height-2-4 text-16">
													{!! $result->property_price->currency->org_symbol ?? '$' !!}
												</span>
												<input type="text" id="price-night" value="{{ (!is_object($result->property_price) || $result->property_price->original_price == 0) ? '' : $result->property_price->original_price }}" name="price"  class="money-input w-100 text-16" >
											</div>
											<span class="text-danger" id="price-error">{{ $errors->first('price') }}</span>
										</div>
									</div>

									<div class="form-group col-lg-6 pl-5 pr-5">
										<label for="inputPassword4">{{trans('messages.listing_price.currency')}}</label>
										<select id='price-select-currency_code' name="currency_code" class='form-control text-16 mt-2'>
											@foreach($currency as $key => $value)
												<option value="{{$key}}" {{ is_object($result->property_price) && $result->property_price->currency_code == $key?'selected':''}}>{{$value}}</option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-md-12">
										@if(!is_object($result->property_price) || ($result->property_price->weekly_discount == 0 && $result->property_price->monthly_discount == 0))
											<p id="js-set-long-term-prices" class="text-center text-muted set-long-term-prices">
											{{trans('messages.listing_price.access_offer')}}  
												<a  href="#" id="show_long_term" class="secondary-text-color">
													{{trans('messages.listing_price.week_month')}}
												</a> {{trans('messages.listing_price.price')}}.
											</p>
										@endif
									</div>
								</div>

								<div class="form-row mt-4 border rounded pb-4 m-0  {{ !is_object($result->property_price) || ($result->property_price->weekly_discount == 0 && $result->property_price->monthly_discount == 0)? 'display-off':''}}" id="long-term-div">
									<div class="form-group col-md-12 main-panelbg pb-3 pt-3 pl-4">
										<h4 class="text-16 font-weight-700">{{trans('messages.listing_price.long_term_price')}}</h4>
									</div>

									<div class="col-md-12 pl-5 pr-5">
										<label for="listing_price_native" >
											{{trans('messages.listing_price.week_price')}}
										</label>

										<div class="input-addon">
											<input type="text" data-suggested="" id="price-week" class="text-16" value="{{ $result->property_price->weekly_discount ?? '0' }}" name="weekly_discount" data-saving="long_price">
											<span class="text-danger">{{ $errors->first('weekly_discount') }}</span>
										</div>
									</div>

									<div class="col-md-12 mt-3 pl-5 pr-5">
										<label for="listing_price_native">
											{{trans('messages.listing_price.monthly_price')}}
										</label>

										<div class="input-addon">
											<input type="text" data-suggested="₹16905" id="price-month" class="money-input text-16 mt-2" value="{{ $result->property_price->monthly_discount ?? '0' }}" name="monthly_discount" data-saving="long_price">
											<span class="text-danger">
											{{ $errors->first('monthly_discount') }}
											</span>
										</div>
									</div>
								</div>


								<div class="mt-4 border rounded pb-4 m-0">
									<div class="form-group col-md-12 main-panelbg pb-3 pt-3 pl-4">
										<h4 class="text-16 font-weight-700">{{trans('messages.listing_price.additional_price')}}</h4>
									</div>
								
									<div class="col-md-12 col-xs-12 pl-3 pr-3 pl-sm-5 pr-sm-5">
										<label for="listing_cleaning_fee_native_checkbox" class="label-large label-inline">
											<input type="checkbox" data-extras="true" class="pricing_checkbox" data-rel="cleaning" {{(@$result->property_price->original_cleaning_fee == 0)?'':'checked="checked"'}}>
											{{trans('messages.listing_price.cleaning_fee')}} 
										</label>
									</div>

									<div id="cleaning" class="{{(is_object($result->property_price) && $result->property_price->original_cleaning_fee == 0)?'display-off':''}}">
										<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-3">
											<div class="input-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text text-16">
															{!! $result->property_price->currency->org_symbol ?? '$' !!}
														</span>
													</div>
													<input type="text" data-extras="true" id="price-cleaning" aria-label="Amount" value="{{ is_object($result->property_price) ? $result->property_price->original_cleaning_fee : '' }}" name="cleaning_fee" class="money-input text-16" data-saving="additional-saving" >
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12 col-xs-12 mt-4 pl-3 pr-3 pl-sm-5 pr-sm-5">
										<label for="listing_cleaning_fee_native_checkbox" class="label-large label-inline">
											<input type="checkbox" class="pricing_checkbox" data-rel="additional-guests" {{(!is_object($result->property_price) || $result->property_price->original_guest_fee == 0)?'':'checked="checked"'}}>
											{{trans('messages.listing_price.additional_guest')}} 
										</label>
									</div>

									<div id="additional-guests" class="{{(is_object($result->property_price) && $result->property_price->original_guest_fee == 0)?'display-off':''}}">
										<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-3">
											<div class="input-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text text-16">
															{!! $result->property_price->currency->org_symbol ?? '$' !!}
														</span>
													</div>
													<input type="text" data-extras="true" value="{{ $result->property_price->original_guest_fee ?? '' }}" id="price-extra_person" name="guest_fee" class="money-input text-16" data-saving="additional-saving" >
												</div>
											</div>
											
											<div class="input-group mt-3">
												<label class="label-large">{{trans('messages.listing_price.guest_after')}}</label>
											</div>

											<div class="input-group mt-3">
												<select id="price-select-guests_included" name="guest_after" data-saving="additional-saving" class="text-16">
													@for($i=1;$i<=16;$i++)
														<option value="{{ $i }}" {{ (@$result->property_price->guest_after == $i) ? 'selected' : '' }}>
														{{ ($i == '16') ? $i.'+' : $i }}
														</option>
													@endfor 
												</select>
											</div>
										</div>
									</div>

									<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-4">
										<label for="listing_cleaning_fee_native_checkbox" class="label-large label-inline">
											<input type="checkbox" class="pricing_checkbox" data-rel="security" {{(@$result->property_price->original_security_fee == 0)?'':'checked="checked"'}}>
											{{trans('messages.listing_price.security_deposit')}} 
										</label>
									</div>

									<div id="security" class="{{(!is_object($result->property_price) || $result->property_price->original_security_fee == 0)?'display-off':''}}">
										<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-4">
											<div class="input-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text text-16">{!! $result->property_price->currency->org_symbol ?? '$' !!}</span>
													</div>
													<input type="text" class="money-input text-16" data-extras="true" value="{{ $result->property_price->original_security_fee ?? '0' }}" id="price-security" name="security_fee" data-saving="additional-saving">
												</div>
											</div>
										</div>
									</div>

									<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-4">
										<label for="listing_cleaning_fee_native_checkbox" class="label-large label-inline">
											<input type="checkbox" class="pricing_checkbox" data-rel="weekend" {{(!is_object($result->property_price) || $result->property_price->original_weekend_price == 0)?'':'checked="checked"'}}>
											{{trans('messages.listing_price.weekend_price')}}
										</label>
									</div>

									<div id="weekend" class="{{(!is_object($result->property_price) || $result->property_price->original_weekend_price == 0)?'display-off':''}}">
										<div class="col-md-12 pl-3 pr-3 pl-sm-5 pr-sm-5 mt-3">
											<div class="input-group">
												<div class="input-group mb-3">
													<div class="input-group-prepend">
														<span class="input-group-text text-16">{!! $result->property_price->currency->org_symbol ?? '$' !!}</span>
													</div>
													<input type="text" data-extras="true" value="{{ $result->property_price->original_weekend_price ?? '0' }}" id="price-weekend" name="weekend_price" class="text-16" data-saving="additional-saving">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row justify-content-between mt-4 mb-5">
									<div class="mt-4">
										<a  data-prevent-default="" href="{{ url('listing/'.$result->id.'/photos') }}" class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5">
											{{trans('messages.listing_description.back')}}
										</a>
									</div>

									<div class="mt-4">
										<button type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5" id="btn_next"> <i class="spinner fa fa-spinner fa-spin d-none" ></i> <span id="btn_next-text">{{trans('messages.listing_basic.next')}}</span>
										
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@stop

	@push('scripts')
	<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
	<script type="text/javascript">
		$(document).on('change', '.pricing_checkbox', function(){
			if(this.checked){
			var name = $(this).attr('data-rel');
			$('#'+name).show();
			}else{
			var name = $(this).attr('data-rel');
			$('#'+name).hide();
			$('#price-'+name).val(0);
			}
		});

		$(document).on('click', '#show_long_term', function(){
			$('#js-set-long-term-prices').hide();
			$('#long-term-div').show();
		});

		$(document).on('change', '#price-select-currency_code', function(){
			var currency = $(this).val();
			var dataURL = '{{url("currency-symbol")}}';
			//console.log(currency);
			$.ajax({
			url: dataURL,
			data: {
					"_token": "{{ csrf_token() }}",
					'currency': currency
				},
			type: 'post',
			dataType: 'json',
			success: function (result) {
				if(result.success == 1)
				$('.pay-currency').html(result.symbol);
			},
			error: function (request, error) {
				// This callback function will trigger on unsuccessful action
				console.log(error);
			}
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#lis_pricing').validate({
				rules: {
					price: {
						required: true,
						number: true,
						min: 5
					},
					weekly_discount: {
						number: true,
						max: 99,
						min: 0
					},
					monthly_discount: {
						number: true,
						max: 99,
						min: 0
					}
				},
				errorPlacement: function (error, element) {
					console.log('dd', element.attr("name"))
					if (element.attr("name") == "price") {
						error.appendTo("#price-error");
					} else {
						error.insertAfter(element)
					}
				},

				submitHandler: function(form)
	            {	           
	                $("#btn_next").on("click", function (e)
	                {	
	                	$("#btn_next").attr("disabled", true);
	                    e.preventDefault();
	                });
	                $(".spinner").removeClass('d-none');
	                $("#btn_next-text").text("{{trans('messages.listing_basic.next')}}..");
	                return true;
	            },
				messages: {
					price: {
						required:  "{{ __('messages.jquery_validation.required') }}",
						number: "{{ __('messages.jquery_validation.number') }}",
						min: "{{ __('messages.jquery_validation.min5') }}",
					},
					weekly_discount: {
						number: "{{ __('messages.jquery_validation.number') }}",
						max: "{{ __('messages.jquery_validation.max99') }}",
						min: "{{ __('messages.jquery_validation.min0') }}",
					},
					monthly_discount: {
						number: "{{ __('messages.jquery_validation.number') }}",
						max: "{{ __('messages.jquery_validation.max99') }}",
						min: "{{ __('messages.jquery_validation.min0') }}",
					}
				}
			});

		});
	</script>
	@endpush