<div class="box">
	<div class="box-body no-padding d-block">
		<ul class="nav nav-pills nav-stacked">
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-1' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/1")}}">Account Info Default Update</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-2' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/2")}}">Account Info Update</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-3' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/3")}}">Account Info Delete</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-4' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/4")}}">Booking</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-5' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/5")}}">Email Confirm</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-6' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/6")}}">Forget Password</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-7' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/7")}}">Need Payment Account</a></li>
			@endif
			
			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-8' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/8")}}">Payout Sent</a></li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
			<li {{ isset($list_menu) &&  $list_menu == 'menu-9' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/9")}}">Booking Cancelled</a></li>
			@endif

			@if(Helpers::has_permission(Auth::guard('admin')->user()->id, 'manage_email_template'))
				<li {{ isset($list_menu) &&  $list_menu == 'menu-10' ? 'class=active' : ''}}><a href="{{ URL::to("admin/email-template/10")}}">Booking Accepted/Declined</a></li>
			@endif
		</ul>
	</div>
</div>