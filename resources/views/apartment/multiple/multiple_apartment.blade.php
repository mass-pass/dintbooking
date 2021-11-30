@extends('layouts.master')
<title>List Your Property</title>
@section('main')
<div class="aparment-section">
         <div class="container">
            <div class="col-lg-5">
            <form class="form-horizontal" role="form" method="" action="/property-name">
               <div class="text-center listing-section-inner">
                  <h5>You're listing:</h5>
                  <span class="d-block">
                  <img src="images/houses.png">
                  </span>
                  <h3>Multiple Apartment in different locations where guests can book the entire place</h3>
                  <p class="mb-5">Does this sound like your property?</p>
                  <input type="submit" value="Continue" class="w-100 thme-btn mb-4">
                  <input type="button" onclick="history.back();" value="No, i need to make a change" class="w-100 thme-btn-border">
               </div>
            </div>
         </div>
      </div>
@stop