<div class="box box-info box_info">
	<div class="panel-body">
		<h4 class="all_settings">Manage Settings</h4>
		<ul class="nav navbar-pills nav-tabs nav-stacked no-margin" role="tablist">
			@if(Permission::has_permission(Auth::guard('admin')->user()->id, 'general_setting'))
				<li class="{{ (Route::current()->uri() == 'admin/settings') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings') }}" data-group="profile">General</a>
				</li>
			@endif
			
			@if(Permission::has_permission(Auth::guard('admin')->user()->id, 'preference'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/preferences') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/preferences') }}" data-group="profile">Preferences</a>
				</li>
			@endif

			@if(Permission::has_permission(Auth::guard('admin')->user()->id, 'manage_sms'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/sms') ? 'active' : ''  }}">
						<a href="{{ url('admin/settings/sms') }}" data-group="sms">SMS Settings</a>
				</li>
			@endif

			@if(Permission::has_permission(Auth::guard('admin')->user()->id, 'manage_banners'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/banners') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/banners') }}" data-group="profile">Banners</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'starting_cities_settings'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/starting-cities') || (Route::current()->uri() == 'admin/settings/add-starting_cities') || (Route::current()->uri() == 'admin/settings/edit-starting-cities/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/starting-cities') }}" data-group="home_cities">Starting Cities</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_property_type'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/property-type' || Route::current()->uri() == 'admin/settings/add-property-type' || Route::current()->uri() == 'admin/settings/edit-property-type/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/property-type') }}" data-group="property_type">Property Type</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'space_type_setting'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/space-type' || Route::current()->uri() == 'admin/settings/add-space-type' || Route::current()->uri() == 'admin/settings/edit-space-type/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/space-type') }}" data-group="space_type">Space Type</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_bed_type'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/bed-type' || Route::current()->uri() == 'admin/settings/add-bed-type'|| Route::current()->uri() == 'admin/settings/edit-bed-type/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/bed-type') }}" data-group="bed_type">Bed Type</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_currency'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/currency' || Route::current()->uri() == 'admin/settings/add-currency' || Route::current()->uri() == 'admin/settings/edit-currency/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/currency') }}" data-group="currency">Currency</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_country'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/country' || Route::current()->uri() == 'admin/settings/add-country' || Route::current()->uri() == 'admin/settings/edit-country/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/country') }}">Country</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_amenities_type'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/amenities-type' || Route::current()->uri() == 'admin/settings/add-amenities-type' || Route::current()->uri() == 'admin/settings/edit-amenities-type/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/amenities-type') }}">Amenities Type</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'email_settings'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/email') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/email') }}">Email Settings</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_fees'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/fees') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/fees') }}">Fees</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_language'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/language' || Route::current()->uri() == 'admin/settings/add-language' || Route::current()->uri() == 'admin/settings/edit-language/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/language') }}" data-group="language">Language</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_metas'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/metas' || Route::current()->uri() == 'admin/settings/edit_meta/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/metas') }}" data-group="metas">Metas</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'api_informations'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/api-informations') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/api-informations') }}" data-group="api_informations">Api Credentials</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'payment_settings'))

				<li class="{{ (Route::current()->uri() == 'admin/settings/payment-methods') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/payment-methods') }}" data-group="payment_methods">Payment Methods</a>
				</li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'social_links'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/social-links') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/social-links') }}" data-group="social_links">Social Links</a>
				</li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_roles'))
				<li class="{{ (Route::current()->uri() == 'admin/settings/roles' || Route::current()->uri() == 'admin/permissions' || Route::current()->uri() == 'admin/settings/add-role' || Route::current()->uri() == 'admin/settings/edit-role/{id}') ? 'active' : ''  }}">
					<a href="{{ url('admin/settings/roles') }}"><span>Roles & Permissions</span></a>
				</li>
			@endif

			<li class="{{ (Route::current()->uri() == 'admin/settings/domains') ? 'active' : ''  }}">
				<a href="{{ url('admin/settings/domains') }}"><span>Domians</span></a>
			</li>
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'database_backup'))
			<li class="{{ (Route::current()->uri() == 'admin/backup') ? 'active' : ''  }}">
				<a href="{{ url('admin/settings/backup') }}"><span>Database Backups</span></a>
			</li>
			@endif
		</ul>
	</div>
</div>