@extends('layouts.master')
<title>List Your Property - Reviews</title>
@section('main')
<div class="cstom-tabs">
<form class="form-horizontal" role="form" method="post" action="review">
            {{ csrf_field() }}
         <ul class="nav nav-tabs">
            <li>
               <a data-toggle="tab" href="#name-and-location">Name and location</a>
            </li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info" >Legal info</a></li>
            <li>
               <a data-toggle="tab" href="#reviews-and-complete" class="active">
                  Reviews and complete
                  <div><span class="fil-success"></span></div>
               </a>
            </li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="property-setup" class="tab-pane active">
            <div class="place-section">
               <div class="row">
                  <div class="col-lg-12">
                  </div>
                  <div class="col-lg-6">
                     <h3 class="mb-5">That's it! you've done everything you need to before your first guest stays</h3>
                     <div class="place-section-right">
                        <p>Some important into before listing your proerty on Dint.com</p>
                        <div class="d-flex mb-4">
                           <div><i class="fas fa-users fa-2x mr-2"></i></div>
                           <div>
                              <h4>Can i decide when i get booking?</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et .
                              </p>
                           </div>
                        </div>
                        <div class="d-flex mb-4">
                           <div><i class="fas fa-users fa-2x mr-2"></i></div>
                           <div>
                              <h4>Can i decide when i get booking?</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et .
                              </p>
                           </div>
                        </div>
                        <div class="d-flex mb-4">
                           <div><i class="fas fa-users fa-2x mr-2"></i></div>
                           <div>
                              <h4>Can i decide when i get booking?</h4>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et .
                              </p>
                           </div>
                        </div>
                        <div class="d-flex mb-4">
                           <div>
                              <input type="checkbox" checked name="">
                           </div>
                           <div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                 quis nostrud exercitation ullamco .
                              </p>
                           </div>
                        </div>
                        <div class="d-flex mb-4">
                           <div>
                              <input type="checkbox" checked name="">
                           </div>
                           <div>
                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                                 <a href="javascript:void(0);">General | Delivery Terms.</a>
                              </p>
                              <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna <a href="javascript:void(0);">Stripe Services Agreement </a> and
                              <a href="javascript:void(0);">Stripe Privacy Policy</a>
                              </small>
                           </div>
                        </div>
                     </div>
                     <hr class="mt-4">
                     <div class="btn-section-artment">
                        <a onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left"></i></a>
                        <input type="submit" name="" class="btn thme-btn w-100" value="Continue">
                     </div>
                  </div>
                  <div class="col-lg-3">
                  </div>
               </div>
            </div>
         </div>
      </div>
@stop