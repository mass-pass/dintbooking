@extends('layouts.master')
<title>List Your Property - Smoking Permission</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="fil-success"></span><span class="fil-success"></span><span class="fil-success"></span><span class="fil-success"></span><span class="current"></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="property-setup" class="tab-pane active">
            <div class="place-section brkfst-details">
               <div class="row">
                  <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="post" action="check-ins">
                   {{ csrf_field() }}
                     <h3 class="mb-5">Houses Rules</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right general-seting">
                        
                        <div class="cstm-row">
                           <div class="col-lg-12">
                              <h5 class="mt-5">Check-In</h5>
                           </div>
                           <div class="col-lg-6">
                              <label>From</label>
                              <input type="time" name="check_in" required class="form-control">
                           </div>
                           <div class="col-lg-6">
                              <label>Until</label>
                              <input type="time" name="check_in1" required class="form-control">
                           </div>
                           <div class="col-lg-12">
                              <h5 class="mt-5">Check-out</h5>
                           </div>
                           <div class="col-lg-6">
                              <label>From</label>
                              <input type="time" name="check_out" required class="form-control">
                           </div>
                           <div class="col-lg-6">
                              <label>Until</label>
                              <input type="time" name="check_out1" required class="form-control">
                           </div>
                        </div>
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