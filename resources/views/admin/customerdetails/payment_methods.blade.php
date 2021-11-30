@extends('admin.template')

@section('main')
<div class="content-wrapper">
	<section class="content">
		@include('admin.customerdetails.customer_menu')
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">{{ "Payment methods" }}</h3>
					</div>

					<div class="panel panel-default">
						<div class="panel-footer">
							<div class="panel">
								<div class="panel-body">
									<div class="row">
										<div class="table-responsive">
											<table class="table table-striped" id="payout_methods">
												@if(count($payouts))
													<thead>
														<tr class="text-truncate">
															<th>Methods</th>
															<th>Details/Account</th>
															<th>Status</th>
														</tr>
													</thead>

													<tbody>
														@foreach($payouts as $row)
															<tr>
																<td>
																	{{ $row->payment_methods->name }} 
																	@if($row->selected == 'Yes')
																	<span class="label label-info">Default</span>
																	@endif
																</td>

																<td>
																	{{ $row->account }} ({{ $row->currency_code }})
																</td>
																
																<td>
																	{{"Ready"}}
																</td>
															</tr>
														@endforeach
													</tbody>
												@else
													<tr><span>No data available</span></tr>
												@endif
											</table>
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
@endsection