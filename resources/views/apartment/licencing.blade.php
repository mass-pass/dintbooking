@extends('layouts.master')
<title>List Your Property - licencing</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li>
               <a data-toggle="tab" href="#name-and-location">Name and location</a>
            </li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li>
               <a data-toggle="tab" href="#legal-info" class="active">
                  Legal info
                  <div><span class="fil-success"></span></div>
               </a>
            </li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
            <form class="form-horizontal" role="form" method="post" action="licencing">
            {{ csrf_field() }}
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="mb-5">Please tell us your licence number</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                           quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                           consequat. Duis aute irure dolor.
                        </p>
                        <label class="mt-4">Business Tax Receipt Number</label>
                        <select class="w-100 mb-4">
                           <option>My property has a business tax recipt and resort tax registration</option>
                        </select>
                        <input type="text" name="licence_number" class="w-100" required>
                     </div>
                     <hr class="mt-4">
                     <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
                  </div>
                  <div class="col-lg-3">
                  </div>
               </div>
            </div>
         </div>
      </div>
@stop