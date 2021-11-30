@extends('layouts.master')
<title>List Your Property - Pricing</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar" class="active">Pricing and calendar<div>
               <span class="fil-success"></span>
               <span class="current"></span>
               <span></span>
               <span></span>
            </div></a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
      <form class="form-horizontal" role="form" method="post" action="pricing">
                              {{ csrf_field() }}
         <div id="property-setup" class="tab-pane active">
            <div class="place-section">
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="mb-5">Price per night</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco <strong>US$ 141.88</strong>and <strong>US$ 257.31</strong> sunt in culpa qui officia deserunt mollit anim id est laborum.a <strong>US$ 227.86</strong>
                        <a href="javascript:void(0);">Learn more</a>
                     </p>
                      <hr class="mt-4">
                      <p>Did this help you decide on a price? <i class="far fa-thumbs-up mr-3"></i>
                        <i class="far fa-thumbs-down"></i>
                      </p>
                     </div>
                     
                     <div class="place-section-right">
                              <div class="bedroom-section-lft">
                                 <h4 class="mb-3">How much do you want to charge per night</h4>
                                 <label class="d-block">Price guests pay</label>
                                  <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">US$</span>
                                  </div>
                                  <input type="number" name="price" required class="form-control w-75">
                                  <p>Inculiding taxes, commission, and fee</p>
                                </div>
                              </div>
                              <hr class="mt-4 mb-3">
                              <h4 class="mb-3">Want to lower your price by 20% for your guests</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud</p>
                              <p><input type="radio" name="monthly_discount" value="20" checked class="mr-2">Yes
                        <input type="radio" name="monthly_discount" value="0" class="mr-2">No</p>
                     </div>
                      <div class="place-section-right">
                        <p>15.00% <strong>dint.com commission</strong></p>
                        <p class="text-center"><i class="fas fa-check mr-2"></i>24/7 help your language</p>
                        <p class="text-center"><i class="fas fa-check mr-2"></i>24/7 help your language</p>
                        <p class="text-center"><i class="fas fa-check mr-2"></i>24/7 help your language</p>
                        <hr class="mt-4 mb-3">
                        <p>US$ 204.00 <strong>Your earning (inculiding taxes)</strong></p>
                      </div>
                     <hr class="mt-4">
                     <div class="btn-section-artment">
                     <a onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left"></i></a>
                     <input type="submit" name="" class="btn thme-btn w-100" value="Continue">
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
@stop