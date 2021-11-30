@extends('layouts.master')

@section('main')
	<?php
		$apartment = $property_types->where('name','Apartment')->first();
		$vacation = $property_types->where('name','Vacation Home')->first();
	?>
	<div class="container list-property-section inner-page-top-section  min-height">
        <div class="list-property-section-header">
		    <h4>List your propert on Dint.com and start welcoming guests in no time?</h4>
		    <p>To get started, select the type of property you want to list on Dint.com</p>
        </div>
		<div class="row justify-content-center">
		    <div class="col-lg-3 col-md-6">
		       <div class="list-property-section-inner">
		          <img src="{{ url('images/Homes.png') }}">
		          <h5>Vacation Home</h5>
		          <p>Properties like apartments,vacation home, villas, etc.</p>
		          <a href="{{route('partner.property.vacationHome')}}?property_type_id={{($vacation)?$vacation->id:''}}&property_type=Vacation Home" class="btn thme-btn w-100 d-block">List Your property</a>
		       </div>
		    </div>
	
		    <div class="col-lg-3 col-md-6">
		       <div class="list-property-section-inner">
		          <img src="{{ url('images/Alternative Place.png') }}">
		          <h5>Boats</h5>
		          <p>Properties like boats, campgrounds, luxury tents, etc.</p>
		          <a href="/boats/register" class="btn thme-btn w-100 d-block">List Your property</a>
		       </div>
		    </div>
		    </div>
		  
		 </div>
	</div>
@stop