                       @if($tab!=4)
										<div class="table-header">
											<div class="tab-links">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item" role="presentation">
														<a class="nav-link active" id="todayTable-tab" data-toggle="tab" href="#todayTable" role="tab" aria-controls="todayTable" aria-selected="true">Today</a>
													</li>
													<li class="nav-item" role="presentation">
														<a class="nav-link" id="tomTable-tab" data-toggle="tab" href="#tomTable" role="tab" aria-controls="tomTable" aria-selected="false">Tomorrow</a>
													</li>
												</ul>
											</div>
											
										</div>
										<div class="table-body">
											<div class="tab-content">
												<div class="tab-pane active fade show" id="todayTable">
													<table class="table ">
														<thead class="thead-light">
															<tr>
																<th>
																	Guest <i class="float-right fa fa-sort  pt-1 "></i>
																</th>
																<th>
																	Conf <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																	Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
																</th>
																<th>
																	Status <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																</th>
															</tr>
														</thead>
														<tbody>
                                                            @if(count($bookingsToday)==0)
                                                            <tr>
                                                                <td colspan="4" class="text-center">
                                                                    None Available
                                                                </td>
                                                            </tr>
                                                            @else
                                                            @foreach($bookingsToday as $t)
															<tr>
																<td>
																	{{$t->first_name}}
																</td>
																<td>
                                                                {{$t->code}}
																</td>
																<td>
                                                                {{$t->total_night}}
																</td>
																<td>
																	@if($tab==1) Arrival @elseif($tab==2) Depature @else In-House @endif
																</td>
																<td>
																	<ul class="list-inline mb-0">
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-sign-out-alt"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-print"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																	</ul>
																</td>
															</tr>
                                                            @endforeach
								                            @endif
														</tbody>
													</table>
												</div>
												<div class="tab-pane  fade" id="tomTable">
													<table class="table ">
														<thead class="thead-light">
															<tr>
																<th>
																	Guest <i class="float-right fa fa-sort  pt-1 "></i>
																</th>
																<th>
																	Conf <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																	Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
																</th>
																<th>
																	Status <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																</th>
															</tr>
														</thead>
														<tbody>
                                                        @if(count($bookingsTomorrow)==0)
                                                        <tr>
														<td colspan="5" class="text-center">
															None Available
														</td>
													    </tr>
                                                            @else
                                                            @foreach($bookingsTomorrow as $t)
															<tr>
                                                                <td>
																	{{$t->first_name}}
																</td>
																<td>
                                                                {{$t->code}}
																</td>
																<td>
                                                                {{$t->total_night}}
																</td>
																<td>
																	@if($tab==1) Arrival @elseif($tab==2) Depature @else In-House @endif
																</td>
																<td>
																	<ul class="list-inline mb-0">
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-sign-out-alt"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-print"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																	</ul>
																</td>
															</tr>
                                                            @endforeach
								                            @endif
															
														</tbody>
													</table>
												</div>
											</div>
										</div>
				@else
                <div class="table-header-wrapper">
											<div class="w-100">
                                         
                                                <div class="row">
                                                <div class="col-md-4">
														<div class="today-item">
															<span class="count">0</span>
															<span class="title">Guests</span>
														</div>
													</div>
													<div class="col-md-4">
														<div class="today-item">
															<span class="count">0</span>
															<span class="title">Adults</span>
														</div>
													</div>
                                                    <div class="col-md-4">
														<div class="today-item">
															<span class="count">0</span>
															<span class="title">Children</span>
														</div>
													</div>
												</div>
                                                
											</div>
										</div>

                                        <div class="table-body">
											<table class="table ">
												<thead class="thead-light">
													<tr>
                                                    <tr>
																<th>
																	Guest <i class="float-right fa fa-sort  pt-1 "></i>
																</th>
																<th>
																	Conf <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																	Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
																</th>
																<th>
																	Status <i class="float-right fa fa-sort pt-1 "></i>
																</th>
																<th>
																</th>
															</tr>

													</tr>
												</thead>
												<tbody>
                                                    @if(count($list)==0)
													<tr>
														<td colspan="5" class="text-center">
															None Available
														</td>
													</tr>
                                                    @else
                                                    @foreach($list as $l)
                                                    <tr>
                                                                <td>
																	{{$t->first_name}}
																</td>
																<td>
                                                                {{$t->code}}
																</td>
																<td>
                                                                {{$t->total_night}}
																</td>
																<td>
																	@if($tab==1) Arrival @elseif($tab==2) Depature @else In-House @endif
																</td>
																<td>
																	<ul class="list-inline mb-0">
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-sign-out-alt"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																		<li class="list-inline-item dropdown">
																			<button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
																				<i class="fas fa-print"></i>
																			</button>
																			<div class="dropdown-menu">
																				<a class="dropdown-item" href="#">Action 01</a>
																				<a class="dropdown-item" href="#">Action 02</a>
																			</div>
																		</li>
																	</ul>
																</td>
															</tr>
                                                    @endforeach
                                                    @endif
												</tbody>
											</table>
										</div>
                @endif
                                   