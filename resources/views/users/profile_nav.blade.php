<nav class="navbar navbar-expand-lg navbar-light list-bacground border rounded-3 p-3">
	<ul class="list-inline">
		<li class="list-inline-item p-2">
			<a class="text-color {{ (request()->is('users/profile')) ? 'secondary-text-color font-weight-700' : '' }} text-color-hover" href="{{ url('users/profile') }}">
				{{trans('messages.sidenav.edit_profile')}}
			</a>
		</li>

		<li class="list-inline-item p-2">
			<a class="text-color {{ (request()->is('users/profile/media')) ? 'secondary-text-color font-weight-700' : '' }} text-color-hover" href="{{ url('users/profile/media') }}">
				{{trans('messages.sidenav.photo')}}
			</a>
		</li>

		<li class="list-inline-item p-2">
			<a class="text-color {{ (request()->is('users/edit-verification')) ? 'secondary-text-color font-weight-700' : '' }} text-color-hover" href="{{ url('users/edit-verification') }}">
				{{trans('messages.sidenav.verification')}}
			</a>
		</li>

		<li class="list-inline-item p-2">
			<a class="text-color {{ (request()->is('users/security')) ? 'secondary-text-color font-weight-700' : '' }}   text-color-hover" href="{{ url('users/security') }}">
				{{trans('messages.account_sidenav.security')}}  

			</a>
		</li>
	</ul>
</nav>