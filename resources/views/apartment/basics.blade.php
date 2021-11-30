@extends('layouts.master')
<title>List Your Property - Basics</title>
@section('main')
      <div class="cstom-tabs">
         <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="current"></span><span></span><span></span><span></span><span></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
         </ul>
      </div>
      <div class="tab-content container">
         <div id="property-setup" class="tab-pane active">
            <div class="place-section">
            <form class="form-horizontal" role="form" method="post" action="basics">
            {{ csrf_field() }}
               <div class="row">
                  <div class="col-lg-12">
                     <h3 class="mb-5">Property details</h3>
                  </div>
                  <div class="col-lg-6">
                     <div class="place-section-right">
                        <label class="d-block mb-3">Where can people sleep?</label>
                        <div class="d-flex bedroom-section">
                              <div class="bedroom-section-lft">
                              <div class="row">
                                 <div class="col-md-4">
                                 <label class="label-large">{{trans('messages.listing_basic.bedroom')}}</label>
                                 <select name="bedrooms" id="basics-select-bedrooms" data-saving="basics1" class="form-control">
                                       @for($i=1;$i<=10;$i++)
                                       <option value="{{ $i }}" {{ ($i == $result->bedrooms) ? 'selected' : '' }}>
                                       {{ $i}}
                                       </option>
                                       @endfor 
                                 </select>
                                 </div>
                                 <div class="col-md-4">
                                 <label class="label-large">{{trans('messages.listing_basic.bed')}}</label>
                                 <select name="beds" id="basics-select-beds" data-saving="basics1" class="form-control">
                                    @for($i=1;$i<=16;$i++)
                                       <option value="{{ $i }}" {{ ($i == $result->beds) ? 'selected' : '' }}>
                                       {{ ($i == '16') ? $i.'+' : $i }}
                                       </option>
                                    @endfor 
                                 </select>
                                 </div>
                                 <div class="col-md-4">
                                 <label class="label-large">{{trans('messages.listing_basic.bed_type')}}</label>
                                 <select id="basics-select-bed_type" name="bed_type" data-saving="basics1" class="form-control">
                                       @foreach($bed_type as $key => $value)
                                       <option value="{{ $key }}" {{ ($key == $result->bed_type) ? 'selected' : '' }}>{{ $value }}</option>
                                       @endforeach
                                 </select>
                                 </div>
                              </div>
                              </div>
                              
                        </div>
                     </div>
                     <div class="place-section-right">
                        <div class="d-flex">
                              <div class="bedroom-section-lft">
                                 <label class="d-block">How many guests can stay?</label>
                                 <div class="flter-section mb-5">
                                    <a  id="minus" ><i class="thme-btn-border fa fa-minus"></i></a>
                                    <span><input size="2" readonly name="accommodates" value="1" id="input"/></span>
                                    <a  id="plus" ><i class="thme-btn-border fa fa-plus"></i></a>
                                 </div>
                                 <label class="d-block">How many bathrooms are there</label>
                                 <div class="flter-section mb-5">
                                 <a  id="minus1" ><i class="thme-btn-border fa fa-minus"></i></a>
                                    <span><input readonly size="2" name="bathrooms" value="1" id="input1"/></span>
                                    <a  id="plus1" ><i class="thme-btn-border fa fa-plus"></i></a>
                                 </div>
                              </div>
                        </div>
                     </div>
                     <div class="place-section-right">
                        <div class="d-flex">
                              <div class="bedroom-section-lft">
                                 <h4 class="mb-3">How big is this apartment</h4>
                                 <label class="d-block">Apartment size - optional</label>
                                 <select name="space_type" data-saving="basics1" class="form-control">
                                 @foreach($space_type as $key => $value)
                                 <option value="{{ $key }}" {{ ($key == $result->space_type) ? 'selected' : '' }}>{{ $value }}</option>
                                 @endforeach
                           </select>
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
      <script>
      const minusButton = document.getElementById('minus');
      const plusButton = document.getElementById('plus');
      const inputField = document.getElementById('input');

      minusButton.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField.value) || 0;
      inputField.value = currentValue - 1;
      });

      plusButton.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField.value) || 0;
      inputField.value = currentValue + 1;
      });

      const inputField1 = document.getElementById('input1');
      const minus1Button = document.getElementById('minus1');
      const plus1Button = document.getElementById('plus1');

      minus1Button.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField1.value) || 0;
      inputField1.value = currentValue - 1;
      });

      plus1Button.addEventListener('click', event => {
      event.preventDefault();
      const currentValue = Number(inputField1.value) || 0;
      inputField1.value = currentValue + 1;
      });
      </script>
@stop