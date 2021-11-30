<div class="col-lg-2 p-0 border-right d-none d-lg-block overflow-hidden mt-m-30">
	<div class="main-panel mt-5 h-100">
		<div class="mt-2">
			<ul class="list-group list-group-flush pl-3">
				<a class="text-color font-weight-500 mt-1"
					href="{{ route('boats::dashboard') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4 {{(!isset($selected) || $selected=='dashboard') ? 'active-sidebar' : ''}}">
						<i class="fa fa-tachometer-alt mr-3 text-18 align-middle"></i>
						{{trans('messages.header.dashboard')}}
					</li>
				</a>

				<a class="text-color font-weight-500 mt-1" href="{{ url('boats') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4 {{(isset($selected) && $selected=='boats') ? 'active-sidebar' : ''}}">
						<i class="fas fa-inbox mr-3 text-18 align-middle"></i>
						{{__('My Boats')}}
					</li>
				</a>

				<a class="text-color font-weight-500 mt-1" href="{{ url('logout') }}">
					<li class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4">
						<i class="fas fa-sign-out-alt mr-3 text-18 align-middle"></i>
						{{trans('messages.header.logout')}}
					</li>
				</a>
			</ul>
		</div>
	</div>
</div>