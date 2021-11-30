<ul class="nav nav-tabs">
	<li class="{{isset($tab) && ( $tab=='profile' ) ? 'active' : ''}}"><a  href="{{ URL::to('/').'/admin/edit_member/'.$member_id }}">Profile</a></li>
	<li class="{{isset($tab) && ( $tab=='photos' ) ? 'active' : ''}}"><a href="{{ URL::to('/').'/admin/member_photos/'.$member_id }}">Photos</a></li>
	<li class="{{isset($tab) && ( $tab=='payments' ) ? 'active' : ''}}"><a href="{{ URL::to('/').'/admin/member_payments/'.$member_id }}">Payments</a></li>
</ul>