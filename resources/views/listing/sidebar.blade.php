<ul class="list-group customlisting">
	<li>
		<a class="btn  text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'basics'?'vbtn-outline-success active-side':'btn-outline-secondary'}} {{ isset($missed['basics']) && ($missed['basics'] == 1) ? '' : 'step-inactive'  }} " href="{{$result->status != ""? url("listing/$result->id/basics"):"#"}}">{{trans('messages.listing_sidebar.basic')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'description'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ isset($missed['description']) && ($missed['description'] == 1) ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/description"):"#"}}">{{trans('messages.listing_sidebar.description')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'location'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ isset($missed['location']) && ($missed['location'] == 1) ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/location"):"#"}}"> {{trans('messages.listing_sidebar.location')}}</a>
	</li>
	
	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'amenities'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ $result->amenities == null ? 'step-inactive' : ''  }}" href="{{$result->status != ""? url("listing/$result->id/amenities"):"#"}}"> {{trans('messages.listing_sidebar.amenities')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'photos'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ isset($missed['photos']) && ($missed['photos'] == 1) ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/photos"):"#"}}"> {{trans('messages.listing_sidebar.photos')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'pricing'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ isset($missed['pricing']) && ($missed['pricing'] == 1) ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/pricing"):"#"}}"> {{trans('messages.listing_sidebar.price')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'booking'?'vbtn-outline-success active-side':' btn-outline-secondary'}} {{ isset($missed['booking']) && ($missed['booking'] == 1) ? '' : 'step-inactive'  }}" href="{{$result->status != ""? url("listing/$result->id/booking"):"#"}}"> {{trans('messages.listing_sidebar.booking')}}</a>
	</li>

	<li>
		<a class="btn text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 rounded-3 {{ Request::segment(3) == 'calendar'?'vbtn-outline-success active-side':' btn-outline-secondary'}}" href="{{$result->status != ""? url("listing/$result->id/calendar"):"#"}}">{{trans('messages.listing_sidebar.calender')}}</a>
	</li>
</ul>