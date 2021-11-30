@extends('layouts.master')
<title>List Your Property - Credit-card</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos" >Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar" class="active">Pricing and calendar<div>
               <span class="current"></span>
               <span></span>
               <span></span>
               <span></span>
            </div></a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="property-setup" class="tab-pane active">
            <div class="place-section brkfst-details">
               <div class="row">
                  <div class="col-lg-12">
                  <form class="form-horizontal" role="form" method="post" action="credit-card">
                  {{ csrf_field() }}
                     <h3 class="mb-5">Guest payment options</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right general-seting">
                        <h4 class="mb-4">Can you charge credit cards at your property?</h4>
                        <p><input type="radio" name="creditcard" value="allowed" checked class="mr-2">Yes</p>
                        <p><input type="radio" name="creditcard" value="not-allowed" class="mr-2">No</p>
                        <p id="multi"></p>
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
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script>
   $(document).ready(function() {
    $('input[type=radio]').change(function(){
      selected_value = $("input[name='creditcard']:checked").val();
      if ($(this).val() == 'allowed') {
         $("#multi").html(`
         <hr class="mt-5 mb-5">
         <h4 >No problem! let guests pay online</h4>
         <p class="mb-4 text-secondary">You can guests pay via payments by Dint.com</p>  
         `);
         
        } else {
         $("#multi").html(``);
        }
    });
   });
</script>
@stop
