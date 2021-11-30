@extends('layouts.master')
<title>List Your Property - Breakfast</title>
@section('main')
<div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location">Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="fil-success"></span><span class="fil-success"></span><span class="current"></span><span></span><span></span></div></a></li>
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
                  <form class="form-horizontal" role="form" method="post" action="breakfast">
                  {{ csrf_field() }}
                     <h3 class="mb-5">Breakfast details</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right general-seting">
                        <h4 class="mb-4">Do you serve guests breakfast?</h4>
                        <p><input type="radio" name="breakfast" value="1" class="mr-2">Yes</p>
                        <p><input type="radio" name="breakfast" checked value="0" class="mr-2">No</p>
                        <div id="multi"></div>
                     </div>
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
@stop
@push('scripts')
<script  type="text/javascript">
   $(document).ready(function() {
    $('input[type=radio]').click(function(){
      selected_value = $("input[name='breakfast']:checked").val();
      if ($(this).val() == '1') {
         $("#multi").html(`
               <h4 class="mb-4 mt-5">Is breakfast Included in the price guests pay?</h4>
               <p><input type="radio" name="price-included" class="mr-2">Yes,it's included</p>
               <p><input type="radio" name="price-included" checked class="mr-2">No, it costs extra</p> 
         `);
         
        } else {
         $("#multi").html(``);
        }
    });
   });
</script>
@endpush
