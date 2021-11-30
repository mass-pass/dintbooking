<header class="main-header">
	<a href="{{URL::to('admin/dashboard')}}" class="logo">
		@if (!empty($site_name))
			<span class="logo-mini"><b>{{$site_name}}</b></span>
		@endif
		
		@if (!empty($site_name))
			<span class="logo-lg"><b>{{$site_name}}</b></span>
		@endif
	</a>

	<nav class="navbar navbar-static-top header_controls">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{\Auth::guard('admin')->user()->profile_src}}" class="user-image" alt="User Image">
						<span class="hidden-xs">{{ ucfirst(Auth::guard('admin')->user()->username) }}</span>
					</a>
					
					<ul class="dropdown-menu">
						<li class="user-header">
							<img src="{{\Auth::guard('admin')->user()->profile_src}}" class="img-circle" alt="User Image">
							<p>
								{{ ucfirst(Auth::guard('admin')->user()->username) }}
								<small>Member since {{ date('M, Y', strtotime(Auth::guard('admin')->user()->created_at)) }}</small>
							</p>
						</li>
				
						<li class="user-footer">
							<div class="pull-left">
							<a href="{{URL::to('/')}}/admin/profile" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
							<a href="{{URL::to('/')}}/admin/logout" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>

<div class="flash-container">
	@if(Session::has('message'))
		<div class="alert {{ Session::get('alert-class') }} text-center mb-0" role="alert">
			{{ Session::get('message') }}
			<a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a>
		</div>
	@endif
	
	<div class="alert alert-success text-center mb-0 d-none" id="success_message_div" role="alert">
		<a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a>
		<p id="success_message"></p>
	</div>

	<div class="alert alert-danger text-center mb-0 d-none" id="error_message_div" role="alert">
		<p><a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a></p>
		<p id="error_message"></p>
	</div>
</div>