@php 
	$breadcrumb = Route::current()->uri();
	$breadcrumbs = array(
						'admin/dashboard' => array( 'admin/dashboard' => 'Dashboard' ),
						'admin/profile' => array( 'admin/profile' => 'Profile' ),
						'admin/users' => array( 'admin/users' => 'Users' ),
						'admin/add_user' => array( 'admin/users' => 'Users', 'admin/add_user' => 'Add User'),
						'admin/edit_user' => array( 'admin/users' => 'Users', 'admin/edit_user' => 'Edit User'),
					);
		
	$breadcrumb = isset($breadcrumbs[$breadcrumb])? $breadcrumbs[$breadcrumb]:'';
@endphp
<ol class="breadcrumb">
	<li><a href="{{URL::to('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
	@if(is_array($breadcrumb))
		@php $i=1; $cnt = count($breadcrumb); @endphp
		@foreach($breadcrumb as $key => $value)
			@if($cnt==$i)
				<li class="active">{{$value}}</li>
			@else
				<li><a href="{{URL::to($key)}}">{{$value}}</a></li>
			@endif
			@php $i++; @endphp
		@endforeach
	@endif
</ol>