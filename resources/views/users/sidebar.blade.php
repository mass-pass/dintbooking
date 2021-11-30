<div class="col-lg-2 p-0 border-right d-none d-lg-block overflow-hidden mt-m-30">
	<div class="main-panel mt-5 h-100">
		<div class="mt-2">
			<ul class="list-group list-group-flush pl-3">
				<a class="text-color font-weight-500 mt-1" href="{{ route('user_dashboard') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('dashboard')) ? 'active-sidebar' : '' }}">
						<i class="fa fa-tachometer-alt mr-3 text-18 align-middle"></i>
						{{trans('messages.header.dashboard')}}
					</li>
				</a>

				<a class="text-color font-weight-500 mt-1" href="{{ route('user_inbox') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('inbox')) ? 'active-sidebar' : '' }}">
						<i class="fas fa-inbox mr-3 text-18 align-middle"></i>
						{{trans('messages.header.inbox')}}
					</li>
				</a>

				@if(auth()->user()->isHost())

				@if(auth()->user()->hasProperties())
				<a class="text-color font-weight-500 mt-1" href="{{ route('user_properties') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('properties')) ? 'active-sidebar' : '' }}">
						<i class="far fa-list-alt mr-3 text-18 align-middle"></i>
						{{trans('messages.header.your_listing')}}
					</li>
				</a>
				@endif

				@if(auth()->user()->hasBoats())
				<a class="text-color font-weight-500 mt-1" href="{{ route('boats::my_boats') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('my-boats')) ? 'active-sidebar' : '' }}">
						<i class="far fa-list-alt mr-3 text-18 align-middle"></i>
						{{__('My Boats')}}
					</li>
				</a>
				@endif

				<a class="text-color font-weight-500 mt-1" href="{{ route('user_bookings') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('my-bookings')) ? 'active-sidebar' : '' }}">
						<i class="fa fa-bookmark mr-3 text-18 align-middle" aria-hidden="true"></i>
						{{trans('messages.booking_my.booking')}}
					</li>
				</a>
				@endif

				<a class="text-color font-weight-500 mt-1" href="{{ route('user_trips') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('trips/active')) ? 'active-sidebar' : '' }}">
						<i class="fa fa-suitcase mr-3 text-18" aria-hidden="true"></i>
						{{trans('messages.users_dashboard.my_trips')}}
					</li>
				</a>
				<a class="text-color font-weight-500 mt-1" href="{{ route('user_rewards') }}">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4  {{ (request()->is('users/rewards')) ? 'active-sidebar' : '' }}">
						<i class="fa fa-star mr-3 text-18" aria-hidden="true"></i>
						{{trans('messages.users_dashboard.rewards')}}
					</li>
				</a>

				<a class="text-color font-weight-500 mt-1" href="{{ route('user_payouts') }}">
					<li
						class="list-group-item vbg-default-hover pl-25  border-0 text-15 p-4 {{ (request()->is('users/payout-list' ) || request()->is('users/payout')) ? 'active-sidebar' : '' }}">
						<i class="far fa-credit-card mr-3 text-18 align-middle"></i>
						{{trans('messages.sidenav.payouts')}}
					</li>
				</a>

				@if(auth()->user()->isHost())
				<a class="text-color font-weight-500 mt-1" href="{{ route('user_transaction_history') }}">
					<li
						class="list-group-item vbg-default-hover pl-25  border-0 text-15 p-4 {{ (request()->is('users/transaction-history')) ? 'active-sidebar' : '' }}">
						<i class="fas fa-money-check-alt mr-3 text-16 align-middle"></i>
						{{trans('messages.account_transaction.transaction')}}
					</li>
				</a>
				@endif

				<a class="text-color font-weight-500 mt-1" href="{{ route('user_profile') }}">
					<li
						class="list-group-item vbg-default-hover pl-25  border-0 text-15 p-4 {{ (request()->is('users/profile') || request()->is('users/profile/media') || request()->is('users/edit-verification') || request()->is('users/security')) ? 'active-sidebar' : '' }}">
						<i class="far fa-user-circle mr-3 text-18 align-middle"></i>
						{{trans('messages.utility.profile')}}
					</li>
				</a>

				<a class="text-color font-weight-500" data-toggle="collapse" href="#collapseReviews" role="button"
					aria-expanded="true" aria-controls="collapseReviews" id="reviewIcon">
					<li
						class="list-group-item vbg-default-hover pl-25 border-0 text-15 p-4 {{ (request()->is('users/reviews'))  || (request()->is('users/reviews_by_you')) || (request()->is('reviews/edit/*'))  ? 'active-sidebar' : '' }}">

						<div class="d-flex justify-content-between">
							<div>
								<span>
									<i class="fas fa-user-edit mr-3 text-18"></i>
									{{trans('messages.sidenav.reviews')}}
								</span>
							</div>
							<div>
								<span class="text-right pr-4">
									@if((request()->is('users/reviews')) || (request()->is('reviews/edit/*')) ||
									(request()->is('reviews/details/*')) || (request()->is('users/reviews_by_you')))
									<i class="fas fa-angle-down" id="reviewArrow"></i>
									@else
									<i class="fas fa-angle-right" id="reviewArrow"></i>
									@endif
								</span>
							</div>
						</div>

					</li>
				</a>

				<div class="collapse {{ (request()->is('users/reviews')) || (request()->is('reviews/edit/*')) || (request()->is('reviews/details/*'))  || (request()->is('users/reviews_by_you'))  ? 'show' : '' }}"
					id="collapseReviews">
					<ul class="pl-5">
						<a class="text-color font-weight-500" href="{{ route('user_reviews') }}">
							<li
								class="list-group-item vbg-default-hover pl-5  border-0 text-15 pt-3 pb-3 {{ (request()->is('users/reviews')) || (request()->is('reviews/details/*')) ? 'secondary-text-color' : '' }}">
								{{trans('messages.reviews.reviews_about_you')}}
							</li>
						</a>

						<a class="text-color font-weight-500" href="{{ route('user_reviews_by_you') }}">
							<li
								class="list-group-item vbg-default-hover pl-5 border-0 text-15 pt-3 pb-3 {{ (request()->is('users/reviews_by_you')) || (request()->is('reviews/edit/*')) ? 'secondary-text-color' : '' }}">
								{{trans('messages.reviews.reviews_by_you')}}
							</li>
						</a>
					</ul>
				</div>

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