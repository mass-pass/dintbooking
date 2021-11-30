<div class="box">
	<div class="panel-body">
		<div class="nav-tabs-custom">
			<ul class="cus nav nav-tabs" role="tablist">
				<li  class="{{ isset($customer_edit_tab) ? $customer_edit_tab : '' }}">
					<a href='{{url("admin/edit-customer")}}/{{@$user->id}}' >Edit Customer</a>
				</li>
				<li  class="{{ isset($properties_tab) ? $properties_tab : '' }}">
					<a href='{{url("admin/customer/properties")}}/{{@$user->id}}' >Properties</a>
				</li>
				<li class="{{ isset($bookings_tab) ? $bookings_tab : '' }}">
					<a href='{{url("admin/customer/bookings")}}/{{@$user->id}}'>Bookings</a>
				</li>
				<li class="{{ isset($payouts_tab) ? $payouts_tab : '' }}">
					<a href='{{url("admin/customer/payouts")}}/{{@$user->id}}'>Payouts</a>
				</li>
				<li class="{{ isset($payment_methods_tab) ? $payment_methods_tab : '' }}">
					<a href='{{url("admin/customer/payment-methods")}}/{{@$user->id}}' >Payment Methods</a>
				</li>
				<li class="{{ isset($wallet) ? $wallet : '' }}">
					<a href='{{ url("admin/customer/wallet") }}/{{@$user->id}}' >Wallet</a>
				</li>
				<li class="{{ isset($rewards_tab) ? $rewards_tab : '' }}">
					<a href='{{ url("admin/customer/rewards") }}/{{@$user->id}}' >Rewards</a>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
</div> 
<h3>{{ @$user->first_name." ".@$user->last_name }}</h3>