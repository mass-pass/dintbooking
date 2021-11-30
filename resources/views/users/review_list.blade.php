<div class="row mt-4 border w-100 rounded">
	<div class="col-md-9 pt-0 rounded-3">
		<div class="row p-4 p-md-0 align-items-center mt-4">
			<div class="col-md-12">
				<a href="{{ url('properties/'.$row_host->property_id) }}">
					<p class="font-weight-700 mb-0">{{ $row_host->properties->name }}</p>
				</a>		
				<div class="pint_table">
					<div class="left_point">
						<ul>
							@for ($i = 0; $i < 5; $i++)
								@if($row_host->rating >$i)
									<li><i class="fa fa-star rating_active" aria-hidden="true"></i></li>
								@else
									<li><i class="fa fa-star rating" aria-hidden="true"></i></li>
								@endif
							@endfor  
						</ul>
					</div>
				</div>
				<p class="text-14 mt-2">{{ $row_host->message }}</p>
				<p class="text-14"><i class="fa fa-calendar"></i> {{ ($row_host->created_at->diffForHumans()) }}</p>
			</div>
		</div>
	</div>

	<div class="col-md-3 p-0 mt-4 mb-4">
		<div class="row justify-content-center">
			<div class='img-round '>
				<a href="{{ url('users/show/'.$row_host->sender_id) }}">
					<img class="img-70x70" src="{{ $row_host->users->profile_src }}">
				</a>	
			</div>
		</div>
		<a href="{{ url('users/show/'.$row_host->sender_id) }}">
			<p class="text-center font-weight-700 mb-0">{{ $row_host->users->first_name }}</p>
		</a>	
	</div>
</div>