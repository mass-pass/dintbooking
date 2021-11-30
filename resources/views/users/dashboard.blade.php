@extends('layouts.master')
@section('main')
<div class="margin-top-85">
	<div class="row m-0">
		{{-- sidebar start--}}
		@include('users.sidebar')
		{{--sidebar end--}}
		<div class="col-lg-10 p-0">
			<div class="container-fluid min-height">
				@if(auth()->user()->isHost())
				<div class="row mt-4">

					@if(auth()->user()->hasBoats())
                    <div class="col-md-3">
                        <div class="card card-default p-3 mt-3">
                            <div class="card-body">
                                <p class="text-center font-weight-bold m-0"><i
                                        class="far fa-list-alt mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success"></i>
                                    {{ __('My Boats') }}</p>
                                <a href="{{ route('boats::my_boats') }}">
                                    <p class="text-center font-weight-bold m-0">{{ auth()->user()->boats()->count() }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
					@endif

					@if(auth()->user()->hasProperties())
					<div class="col-md-3">
						<div class="card card-default p-3 mt-3">
							<div class="card-body">
								<p class="text-center font-weight-bold m-0"><i class="far fa-list-alt mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success"></i> {{trans('messages.users_dashboard.my_lists')}}</p>
								<a href="{{ route('user_properties') }}">
									<p class="text-center font-weight-bold m-0">
										{{ auth()->user()->properties()->count() }}
									</p>
								</a>
							</div>
						</div>
					</div>
					@endif
				</div>
				@endif

				<div class="row mt-4">
					<div class="col-md-3">
						<div class="card card-default p-3 mt-3">
							<div class="card-body">
								<p class="text-center font-weight-bold m-0"><i class="fa fa-suitcase mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success" aria-hidden="true"></i>{{trans('messages.users_dashboard.my_trips')}}</p>
								<a href="{{ url('/') }}/trips/active"><p class="text-center font-weight-bold m-0">{{ $trip }}</p></a>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-default p-3 mt-3">
							<div class="card-body">
								<p class="text-center font-weight-bold m-0"><i class="fas fa-wallet mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success"></i> {{trans('messages.users_dashboard.my_wallet')}}</p>
								<p class="text-center font-weight-bold m-0">  {!! moneyFormat( $wallet->currency->symbol, $wallet->total) !!}  </p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-default p-3 mt-3">
							<div class="card-body">
								<p class="text-center font-weight-bold m-0"><i class="fas fa-star mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success"></i> {{trans('messages.users_dashboard.rewards')}}</p>
								<p class="text-center font-weight-bold m-0">  {!! $points !!}  </p>
							</div>
						</div>
					</div>
				</div>

				@if(auth()->user()->isHost())
					<div class="row mb-5">
						<!-- Content Column -->
						<div class="col-lg-5 mb-4 mt-5">
							<!-- Project Card Example -->
							<div class="card card-default">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-700 text-18"><i class="fa fa-bookmark  mr-1" aria-hidden="true"></i> {{trans('messages.users_dashboard.latest_bookings')}}</h6>
								</div>
								<div class="card-body">
									<div class="widget">
										<ul>
											@forelse($bookings as $booking)
											@if($loop->index < 4)
											<li>
												<div class="sidebar-thumb">
													<a href="{{ url('/') }}/properties/{{ $booking->property_id}}"><img class="animated rollIn" src="{{ $booking->properties->cover_photo}} " alt="coverphoto" /></a>
													
												</div>

												<div>
													<h4 class="animated bounceInRight text-16 font-weight-700">
														<a href="{{ url('/') }}/properties/{{ $booking->property_id}}">{{ $booking->properties->name}} 			
														</a><br/>
														
													</h4>
												</div>

												<div class="d-flex justify-content-between">
													<div>
														<div>
															<span class="text-14 font-weight-400">
																<i class="fa fa-calendar" aria-hidden="true"></i> {{ $booking->date_range}}</span>
															<div class="sidebar-meta">
																<a href="{{ url('/') }}/users/show/{{ $booking->user_id}}" class="text-14 font-weight-400">{{ $booking->users->full_name}}</a>
															</div>
														</div>
												
													</div>

													<div class="align-self-center pr-4"> 
														<span class="badge vbadge-success text-14 mt-3 p-2 {{ $booking->status}}">{{ $booking->status}}</span>
													</div>
												</div>
											</li>
											@endif
											@empty
											<div class="row jutify-content-center w-100 p-4 mt-4">
												<div class="text-center w-100">
												<p class="text-center">{{trans('messages.booking_my.no_booking')}}</p>
												</div>
											</div>
											@endforelse
										</ul>
									</div>

									@if($bookings->count()>4)
										<div class="more-btn text-right">
											<a class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-3 pr-3" href="{{ url('/') }}/my-bookings">
												<p class="p-2 mb-0">{{trans('messages.property_single.more')}}</p>
											</a>
										</div>
									@endif
								</div>
								
								
							</div>
						</div>

						<div class="col-lg-7 mb-4 mt-5">
							<!-- Illustrations -->
							<div class="card card-default h-100">
								<div class="card-header py-3">
									<h6 class="m-0 font-weight-700 text-18"><i class="fas fa-exchange-alt mr-2"></i>{{trans('messages.users_dashboard.latest_transactions')}}</h6>
								</div>

								<div class="card-body text-16 p-0">
									<div class="panel-footer">
										<div class="panel">
											<div class="panel-body" class="p-0">
												<div class="row">
													<div class="table-responsive">
														<table class="table table-striped table-hover table-header text-center">
															@if($transactions->count()>0)
																<thead>
																	<tr class="bg-secondary text-white">
																		<th>{{trans('messages.account_transaction.type')}}</th>
																		<th>{{trans('messages.utility.payment_method')}}</th>
																		<th>{{trans('messages.account_transaction.amount')}}</th>
																		<th>{{trans('messages.account_transaction.date')}}</th>
																	</tr>
																</thead>
															@endif
																<tbody id="transaction-table-body1">
																	@forelse($transactions as $transaction)
																		<tr>
																			<td>{{ is_numeric($transaction->currency_id) ? 'Payout': 'Booking'}}</td>
																			<td>{{ $transaction->payment_methods->name}}   </td>
																			<td> {!! is_numeric($transaction->currency_id) ? $transaction->currency->org_symbol : codeToSymbol($transaction->currency_id) !!} {{ $transaction->per_night ?  number_format($transaction->per_night, 2, '.', ''): $transaction->amount  }} </td>
																			<td>{{ date('d-m-Y', strtotime($transaction->created_at))}}</td>
																		</tr>                              
																	@empty

																	<div class="row jutify-content-center w-100 p-4 mt-4">
																		<div class="text-center w-100">
																		<p class="text-center">{{trans('messages.listing_description.no')}} {{trans('messages.account_sidenav.transaction_history')}}.</p>
																		</div>
																	</div>		
																	@endforelse
																</tbody>
														</table>
														@if( $transactions->count() >= 9 )
															<div class="more-btn text-right mb-4 pr-4">
																<a class="btn vbtn-outline-success text-14 font-weight-700 p-0 mt-2 pl-3 pr-3" href="{{ url('/') }}/users/transaction-history">
																	<p class="p-2 mb-0">{{trans('messages.property_single.more')}}</p>
																</a>
															</div>
														@endif
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@stop    