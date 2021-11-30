@extends('layouts.master')
<title>List Your Property - Language</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup <div><span class="fil-success"></span><span class="fil-success"></span><span class="fil-success"></span><span class="current"></span><span></span></div></a></li>
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
                  <form class="form-horizontal" role="form" method="post" action="language">
                  {{ csrf_field() }}
                     <h3 class="mb-5">What languages do you or your staff speak?</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right general-seting">
                        <h4 class="mb-4">Select languages</h4>
                        @foreach($lang as $name)
                        <p><input type="radio" name="language" required value="{{ $name }}" checked class="mr-2">{{$name}}</p>
                        @endforeach
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