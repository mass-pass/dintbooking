@extends('layouts.master')
<title>List Your Property - Booking</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li>
               <a data-toggle="tab" href="#property-setup" class="active">Property Setup</a>
            </li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li>
               <a data-toggle="tab" href="#pricing-and-calendar" class="active">
                  Pricing and calendar
                  <div>
                     <span class="fil-success"></span>
                     <span class="fil-success"></span>
                     <span class="fil-success"></span>
                     <span class="current"></span>
                  </div>
               </a>
            </li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
      <form class="form-horizontal" role="form" method="post" action="booking">
            {{ csrf_field() }}
         <div id="property-setup" class="tab-pane active">
            <div class="place-section">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="mb-5">Availiability</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <h4 class="mb-4">What's the first date when guests can check-in?</h4>
                        <p><input type="radio" name="booking_type" value="instant" checked class="mr-2">As soon as possible 
                           <input type="radio" name="booking_type" value="request" class="mr-2">on specific date
                        </p>
                     </div>
                     
                     <hr class="mt-4">
                     <div class="btn-section-artment">
                        <a onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left"></i></a>
                        <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@stop