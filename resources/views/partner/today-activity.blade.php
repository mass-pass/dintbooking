<div class="table-header-wrapper">
											<div class="w-100">
                                                @if($tab==1)
												<div class="row">
													<div class="col-md-4">
														<div class="today-item">
															<span class="count">{{$today_booked}}</span>
															<span class="title">Booked Today</span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="today-item">
															<span class="count">{{$total_nights}}</span>
															<span class="title">Room nights</span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="today-item">
															<span class="count">{{$total_revenue}}</span>
															<span class="title">Revenue</span>
														</div>
													</div>
												</div>
                                                @elseif($tab==2)
                                                <div class="row">
													<div class="col-md-6">
														<div class="today-item">
															<span class="count">{{$today_booked}}</span>
															<span class="title">Cancellation</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="today-item">
															<span class="count">${{$total_revenue}}</span>
															<span class="title">Lost</span>
														</div>
													</div>
													
												</div>
                                                @else
                                                <div class="row">
                                                <div class="col-md-6">
														<div class="today-item">
															<span class="count">0</span>
															<span class="title">Booking List</span>
														</div>
													</div>
													<div class="col-md-6">
														<div class="today-item">
															<span class="count">0</span>
															<span class="title">Over Booking List</span>
														</div>
													</div>
												</div>
                                                @endif
											</div>
										</div>

                                        <div class="table-body">
											<table class="table ">
												<thead class="thead-light">
													<tr>
														<th>
															Guest <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
														</th>
														<th>
															Revenue <i class="float-right fa fa-sort pt-1 "></i>
														</th>
														<th>
															Check-in <i class="float-right fa fa-sort pt-1 "></i>
														</th>
														<th>
															Nights <i class="float-right fa fa-sort pt-1 "></i>
														</th>

													</tr>
												</thead>
												<tbody>
                                                    @if(count($list)==0)
													<tr>
														<td colspan="4" class="text-center">
															None Available
														</td>
													</tr>
                                                    @else
                                                    @foreach($list as $l)
                                                    <tr>
																<td>
																	{{$l->first_name}}
																</td>
																<td>
																	${{number_format($l->base_price,2)}}
																</td>
																<td>
																	{{$l->start_date}}
																</td>
																<td>
																	{{$l->total_night}}
																</td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
												</tbody>
											</table>
										</div>