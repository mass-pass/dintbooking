@extends('layouts.master')
<title>List Your Property - Locate</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" class="active">Name and location <span class="fil-success"></span><span class="fil-success"></span><span class="current"></span></a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
               <div class="row">
                  <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="post" action="location">
                      {{ csrf_field() }}
                     <h3 class="mb-5">Pin the location of your Property</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114964.53925910071!2d-80.29949906059734!3d25.78239073313235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d9b0a20ec8c111%3A0xff96f271ddad4f65!2sMiami%2C%20FL%2C%20USA!5e0!3m2!1sen!2sin!4v1624554473526!5m2!1sen!2sin" width="100%" height="600" style="border:0;" allowfullscreen="" ></iframe>
                     </div>
                     <hr class="mt-4">
                     <div class="btn-section-artment mt-2">
                        <a type="button" onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @stop
      