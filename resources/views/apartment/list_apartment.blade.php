@extends('layouts.master')
<title>List Your Property</title>
@section('main')
<div class="aparment-section">
   <div class="container">
      <h3>How many apartments are you listing?</h3>
      <div class="row">
         <div class="col-lg-5">
         <form class="form-horizontal" role="form" method="post" action="apartment">
         {{ csrf_field() }}
            <div class="aparment-section-inner">
               <div class="aprtment-details">
                  <input type="radio" name="apartment" value="single" checked>
                  <div class="d-flex aparment-checkbox align-items-center">
                     <img src="images/Homes.png">
                     <p>One apartments</p>
                  </div>
               </div>
               <div class="aprtment-details">
                  <input type="radio" name="apartment" value="multiple">
                  <div class="d-flex aparment-checkbox align-items-center">
                     <img src="images/houses.png">
                     <p>Multiple apartments</p>
                  </div>
               </div>
               <p id="multi"></p>
               <div class="btn-section-artment">
                  <a type="button" onclick="history.back();" class="thme-btn-border mr-3"><i class="fa fa-chevron-left"></i></a>
                  <button type="submit" name="" id="btn_next" class="btn thme-btn w-100" value="Continue"><i class="spinner fa fa-spinner fa-spin d-none" ></i>
                        <span id="btn_next-text">Continue</span>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
   $(document).ready(function() {
    $('input[type=radio]').change(function(){
      selected_value = $("input[name='apartment']:checked").val();
      if ($(this).val() == 'single') {
         $("#multi").html(``);
        } else {
         $("#multi").html(`
         <h4 class="mt-3">Are these proprties at the same address or bulding </h4>
            <div class="aprtment-details">
               <input type="radio" name="apartment_location" value="false" >
               <div class="d-flex aparment-checkbox align-items-center">
                  <img src="images/maps.png">
                  <p>Yes, these apartments are at the same address or building</p>
               </div>
            </div>
            <div class="aprtment-details">
               <input type="radio" name="apartment_location" value="true">
               <div class="d-flex aparment-checkbox align-items-center">
                  <img src="images/maps-and-flags.png">
                  <p>No, these apartments are at different address or building</p>
               </div>
            </div>
            <label class="mb-3 d-block mt-5">Number of properties</label>
            <input type="number" name="count" required class="w-25 prp-box">
         </div>
    `    );
        }
    });
   });
</script>
@stop