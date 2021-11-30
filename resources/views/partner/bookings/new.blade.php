@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
<div class="loading d-none">
      <div class='uil-ring-css' style='transform:scale(0.79);'>
        <div></div>
      </div>
    </div>

<section>
        <div class="content-wrapper" style="margin-top:120px;">
            <div class="">
                <div class="bs-stepper" id="reservation-stepper">
                    <div class="container">
                        <div class="bs-stepper-header" role="tablist">
                            <h4 class=" mr-auto">New Reservation</h4>
                          <!-- your steps here -->
                          <div class="step" data-target="#availability-content">
                            <button type="button" class="step-trigger" role="tab" aria-controls="availability-content" id="availability-content-trigger">
                              <span class="bs-stepper-circle">1</span>
                              <span class="bs-stepper-label">Availability</span>
                            </button>
                          </div>
                          
                          <div class="step" data-target="#guests-content">
                            <button type="button" class="step-trigger" role="tab" aria-controls="guests-content" id="guests-content-trigger">
                              <span class="bs-stepper-circle">2</span>
                              <span class="bs-stepper-label">Guests</span>
                            </button>
                          </div>
                          <div class="step" data-target="#confirmation-content">
                            <button type="button" class="step-trigger" role="tab" aria-controls="confirmation-content" id="confirmation-content-trigger">
                              <span class="bs-stepper-circle">3</span>
                              <span class="bs-stepper-label">Confirmation</span>
                            </button>
                          </div>
                          
                        </div>
                    </div>
                    
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="availability-content" class="content" role="tabpanel" aria-labelledby="availability-content-trigger">
                          <div class="container-fluid">
                                <!-- Content starts here -->
                                <div class="reservation-form-top">
                                    <form action="#">
                                        <div class="card border rounded-0 my-3 bg-light">
                                            
                                            <div class="card-body pb-2">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Select Source*</label>
                                                            <select name="source" class="form-control" id="search_source">
                                                                <option value="Website/Booking Engine">Website/Booking Engine</option>
                                                                <option value="Walk-In">Walk-In</option>
                                                                <option value="Phone">Phone</option>
                                                                <option value="Email">Email</option>
                                                            </select>
                                                        </div>
                                                    </div>                                                
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Check in Date</label>
                                                            <input type="text" name="start_date" class="form-control datepicker" id="search_start_date">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Check out Date</label>
                                                            <input type="text" name="end_date" class="form-control datepicker" id="search_end_date">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Promo Code</label>
                                                            <input type="text" name="" id="" placeholder="Enter promo code" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">&nbsp;</label>
                                                            <a href="javascript:void(0)" id="btn-search-availability" class="btn  btn-block btn-primary">
                                                            <i class="fa fa-search text-uppercase"></i>&nbsp; Search    
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="reservation-accomodations-wrapper" style="margin-bottom:100px;">
                                    <div class="accomodation-left">
                                        <div class="card">
                                            <div class="card-header bg-dark text-white">
                                            <h5 class="text-uppercase mb-0">accomodations</h5>
                                            </div>
                                            <div class="card-body bg-light">
                                                <div class="hide-when-zero" id="property-layouts-selected-container"></div>
                                                <div class="manage-placeholder hide-when-non-zero" id="property-layouts-selected-container">
                                                    <span class="icon">
                                                        <i class="fa fa-male"></i>  
                                                    </span> <br>                                                    
                                                    <p>Add a accomodations to start your reservation. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accomodation-right">
                                        <div class="card border">
                                            <div class="card-body">
                                                <div class="ar-header">
                                                    <div class="list-inline mb-0 align-items-center d-flex flex-wrap">
                                                        <div class="list-inline-item">
                                                           <label for="" class="mr-2">View <i class="fa fa-question-circle"></i> </label> 
                                                           <div class="amenities-custom-radio">
                                                             <label for="" onclick="alert('grid view');">
                                                                 <input type="radio" name="radio1" id="">
                                                                 <span> <i class="fa fa-th"></i> </span>
                                                             </label>
                                                             <label for="" onclick="alert('list view');">
                                                                 <input type="radio" name="radio1" id="" checked>
                                                                 <span> <i class="fa fa-list"></i> </span>
                                                             </label>
                                                         </div>
                                                        </div>
                                                        <div class="list-inline-item ">
                                                            <div class="row  align-items-center">
                                                                <div class="col-3 text-center">
                                                                 <label for="" class="">Display : </label> 
                                                                </div>
                                                                <div class="col-8">
                                                                 <select name="" class="form-control" id="">
                                                                     <option value="">Base rates</option>
                                                                 </select>
                                                             </div>
                                                            </div>
                                                         
                                                        
                                                      </div>
                                                      <div class="list-inline-item ">
                                                         <div class="row ">
                                                             <div class="col-4">
                                                              <label for="" class="">Select Accomodations: </label> 
                                                             </div>
                                                             <div class="col-8">
                                                                 <select name="" class="form-control" id="">
                                                                     <option value="">All room types</option>
                                                                 </select>
                                                          </div>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <hr>
                                                      </div>
                                                    </div>
                                                   </div>   
                                                <div class="ar-body">
                                                    <div class="card">
                                                        <div class="card-header bg-dark text-white">
                                                            <h5 class="text-uppercase mb-0">Availability</h5>
                                                            </div>
                                                        <div class="card-body p-0">
                                                            <div class="table-wrapper">
                                                                <div id="initial-nonavailability-message" class="manage-placeholder p-5">
                                                                <span class="icon">
                                                                    <i class="fa fa-calendar"></i>  
                                                                </span><br/>
                                                                    <p class="lead">Select check-In and check-out dates to search for availability</p>
                                                                </div>
                                                                <div id="show-when-no-availability" class="d-none manage-placeholder p-5">
                                                                <span class="icon">
                                                                    <i class="fa fa-alert"></i>  
                                                                </span><br/>
                                                                    <p class="lead">There is no availability for the dates specified</p>

                                                                </div>
                                                                <table class="table d-none" id="property-layouts-bookable-container">
                                                                    <thead class="thead-light">
                                                                        <tr>
                                                                            <th>
                                                                                Type
                                                                            </th>
                                                                            <th>
                                                                                Starting from
                                                                            </th>
                                                                            <th>
                                                                                Arrival Date
                                                                            </th>
                                                                            <th>
                                                                                Departure Date
                                                                            </th>
                                                                            <th>
                                                                                Available
                                                                            </th>
                                                                            <th>
                                                                                Adult
                                                                            </th>
                                                                            <th>
                                                                                Child
                                                                            </th>
                                                                            <th>
                                                                                Quantity
                                                                            </th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody >
                                                                    </tbody>
                                                                </table>
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                          <div class="content-bottom-bar" style=" position: fixed; bottom: 60px; width: 100%;">
                            <div class="row">
                                <div class="col-xl-8 offset-xl-4">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Sub-Total</label> <br>
                                            <h6 class="holder-subtotal"></h6>
                                        </div>
                                        <div class="col">
                                          <label for=""><i class="fa fa-question-circle"></i></label> Fees <br>
                                          <h6 class="holder-fees"></h6>
                                      </div>
                                      <div class="col">
                                          <label for=""><i class="fa fa-question-circle"></i></label> Taxes <br>
                                          <h6 class="holder-taxes"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Grand-Total</label> <br>
                                          <h6 class="holder-grand-total"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Suggested Deposit</label> <br>
                                          <h6 class="holder-deposit"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Balance Due</label> <br>
                                          <h6 class="holder-balance"></h6>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                           <div class="tab-action-fixed active">
                            <button class="btn btn-primary text-uppercase" id="btn-step-1">Booking Details  &nbsp; <i class="fa fa-angle-right"></i> </button>
                           </div>
                            
                            
                      </div>
                      <div id="guests-content" class="content" role="tabpanel" aria-labelledby="guests-content-trigger">
                        <!-- Content starts here -->
                        <div class="container">
                            <div class="page-header">
                                <div class="page-info">
                                    <h4 class="mb-0">Reservation Details</h4>
                                 </div>
                            </div>
                            <!-- spacer -->
                            <div class="hr">
                                <hr >
                            </div>
                            <!-- spacer -->
                            <div class="page-content" style="margin-bottom:100px;">
                                <div class="row">
                                    <div class="col-md-3 col-xl-2">
                                        <div class="reservation-detail-profile">
                                            <div class="img-wrapper mb-3 shadow-sm">
                                                <img src="https://cdn.pixabay.com/photo/2015/03/04/22/35/head-659652_1280.png" alt="..." class="img-thumbnail">
                                            </div>
                                            <div class="btn-wrapper mb-3">
                                                <a href="#" class="btn btn-block btn-secondary text-uppercase"> <i class="fa fa-camera"></i>&nbsp; Take Photo  </a>
                                            </div>
                                            <div class="btn-wrapper mb-3">
                                                <button type="button" id="file_btn" class="btn btn-block btn-outline-secondary text-uppercase"> <i class="fa fa-upload"></i>&nbsp; Upload Photo  </button>
                                                <input type="file" name="" hidden id="my_file">
                                            </div>
                                            <div class="alert alert-default">
                                                <i class="fas fa-info-circle"></i> Image Dimensions: <br>
                                                180px x 180px
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4  col-xl-4">
                                        <div class="reservation-detail-form">
                                            <form action="#">
                                                <div class="form-item">
                                                    <h5 class="text-uppercase">Reservation information</h5>
                                                <!--
                                                    <div class="my-3">
                                                        <p class="border-bottom">
                                                            <b class="mb-1">Estimated arrival time</b>
                                                        </p>
                                                    </div>
                                                    <div class="alert alert-success">
                                                        if this is not correct person click the button to create a new customer.
                                                    </div>
                                                    <div class="mb-3">
                                                        <a href="#" class="btn btn-success btn-block text-uppercase"> <i class="fa fa-plus"></i>&nbsp;  New customer</a>
                                                    </div> 
                                                -->
                                                </div>

                                                <div class="form-item" id="guest-form-content">
                                                    <h5 class="text-uppercase mb-3">Primary guest information</h5>
                                                    <p class="alert alert-danger fill_required_fields_error d-none">
                                                        Please fill all required (*) fields.    
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">*First Name</label>
                                                                <input type="text" name="guest_first_name" class="form-control" id="guest_first_name">
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">*Last Name</label>
                                                                <input type="text" name="guest_last_name" class="form-control" id="guest_last_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*Email</label>
                                                        <input type="email" name="guest_email" class="form-control" id="guest_email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Phone</label>
                                                        <input type="number" name="guest_phone" class="form-control" id="guest_phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*Cell Phone</label>
                                                        <input type="number" name="guest_cell_phone" class="form-control" id="guest_phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Date of Birth</label>
                                                        <input type="text" name="guest_dob" class="datepicker form-control" id="guest_dob">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Gender</label>
                                                        <select name="guest_gender" class="form-control" id="guest_gender">
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Guest Tax ID Number</label>
                                                        <input type="number" name="guest_tax_id_no" class="form-control" id="guest_tax_id_no">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Company Name</label>
                                                        <input type="text" name="guest_company_name" class="form-control" id="guest_company_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Company Tax ID Number</label>
                                                        <input type="number" name="guest_company_tax_id_no" class="form-control" id="guest_company_tax_id_no">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">*Address Line 1</label>
                                                        <input type="text" name="guest_address_1" class="form-control" id="guest_address_1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*Address Line 2</label>
                                                        <input type="text" name="guest_address_2" class="form-control" id="guest_address_2">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*City</label>
                                                        <input type="text" name="guest_city" class="form-control" id="guest_city">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*State/Region</label>
                                                        <input type="text" name="guest_state" class="form-control" id="guest_state">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*Country</label>
                                                        <select name="guest_country" class="form-control" id="guest_country" >
                                                        @foreach(\App\Models\Country::all()->pluck('name', 'short_name') as $key => $value)
                                                            <option value="{{ $key }}" >{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">*Zip/Postal Code</label>
                                                        <input type="text" name="guest_zip" class="form-control" id="guest_zip">
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-4  col-xl-3">
                                        <div class="reservation-detail-alert">
                                            <div class="detail-alert-body">
                                                <a href="#" class="close"> &times; </a>
                                                <i class="fa fa-info-circle"></i>
                                                <p>Fill out the primary guest details to the left.
                                                    If you have selected multiple accomodations, or multiple guests belonging to a single accomodation, you will be able to add the addtional guest details on the next screen.
                                                </p>
                                            </div>
                                            <div class="detail-alert-footer">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                                    <label class="custom-control-label" for="customCheck">Do not show this again</label>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-bottom-bar active" style=" position: fixed; bottom: 60px; width: 100%;">
                            <div class="row">
                                <div class="col-xl-8 offset-xl-4">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Sub-Total</label> <br>
                                            <h6 class="holder-subtotal"></h6>
                                        </div>
                                        <div class="col">
                                          <label for=""><i class="fa fa-question-circle"></i></label> Fees <br>
                                          <h6 class="holder-fees"></h6>
                                      </div>
                                      <div class="col">
                                          <label for=""><i class="fa fa-question-circle"></i></label> Taxes <br>
                                          <h6 class="holder-taxes"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Grand-Total</label> <br>
                                          <h6 class="holder-grand-total"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Suggested Deposit</label> <br>
                                          <h6 class="holder-deposit"></h6>
                                      </div>
                                      <div class="col">
                                          <label for="">Balance Due</label> <br>
                                          <h6 class="holder-balance"></h6>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="tab-action-fixed active">
                            <button class="btn btn-outline-light  text-uppercase mr-2 btn-previous"> <i class="fa fa-angle-left"></i> &nbsp; Previous</button>
                            <a class="btn btn-primary text-uppercase btn-step-2" href="javascript:void(0)">Proceed to payment &nbsp; <i class="fa fa-angle-right"></i> </a>
                           </div>  
                      </div>
                      <div id="confirmation-content" class="content" role="tabpanel" aria-labelledby="confirmation-content-trigger">
                        <!-- Content starts here -->
                        <div class="">
                            <div  class="active">
                                <div class="container">
                                    <div class="row">
                                    <div id="confirmation-tab-content" class="col-md-8"></div>
                                    <div class="col-md-4">
            <div class="card border">
                <div class="card-body">
                    <h6>Total :</h6>
                    <div class="amount-list">
                        <div class="amount-list-item">
                            <span>Sub-Total</span>
                            <span class="holder-subtotal"></span>
                        </div>
                        <div class="amount-list-item">
                            <span>Fees</span>
                            <span class="holder-fees"></span>
                        </div>
                        <div class="amount-list-item">
                            <span>Taxes</span>
                            <span class="holder-taxes"></span>
                        </div>
                        <div class="amount-list-item">
                            <span>Grand Total</span>
                            <span class="holder-grand-total"></span>
                        </div>
                        <div class="amount-list-item due-amount">
                            <span>Balance Due</span>
                            <span class="holder-balance"></span>
                        </div>                                                     

                    </div>
                </div>
            </div>
        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="tab-action-fixed active">
                                <button class="btn btn-outline-light  text-uppercase mr-2 btn-previous" > <i class="fa fa-angle-left"></i> &nbsp; Previous</button>
                                <button class="btn btn-primary text-uppercase submit-reservation" >Finish &nbsp; <i class="fa fa-angle-right"></i> </button>
                               </div>  
                        </div>                        
                      </div>                      
                    </div>
                  </div>
                  
            </div>
        </div>
<script id="booking-confirmation-template" type="text/x-handlebars-template">

            <div class="reservation-summary ">
                <div class="card-heading">
                    Reservation summary
                </div>
                <div class="card-content">
                <!-- reservation-details starts  -->
                    <div class="reservation-details-wrapper">
                        <div class="">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <div class="reservation-details-left">
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <label for="" class="d-block mb-1">Check-In</label>
                                            <span>@{{ start_date }}</span>
                                        </li>
                                        <li class="list-inline-item">
                                        <label for="" class="d-block mb-1">Check-Out</label>
                                        <span>@{{ end_date }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <label for="" class="d-block mb-1">Nights</label>
                                        <span>@{{ nights }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <label for="" class="d-block mb-1">Reservation date</label>
                                        <span>@{{ reservation_date }}</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <label for="" class="d-block mb-1">Source</label>
                                        <span>@{{ source }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- reservation-details ends  -->
                <div class="reservation-info-list">
                    <div class="reservation-info-item">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Guest</label>
                                <h6>@{{ guest.first_name }} @{{ guest.last_name }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">Email</label>
                                <h6>@{{ guest.email }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">Phone</label>
                                <h6>@{{ guest.phone }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="reservation-info-item">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Country</label>
                                <h6>@{{ guest.country_name }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">Address 1</label>
                                <h6>@{{ guest.address_1 }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">Address 2</label>
                                <h6>@{{ guest.address_2 }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="reservation-info-item">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">City</label>
                                <h6>@{{ guest.city }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">State/Region</label>
                                <h6>@{{ guest.state }}</h6>
                            </div>
                            <div class="col-md-3">
                                <label for="">Postal Code</label>
                                <h6>@{{ guest.zip }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="reservation-summary mb-4">
            <div class="card-heading">
                Accomodation summary
            </div>
            <div class="card-content">
                <div class="payment-table-wrapper">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Guest</th>
                                <th>Arrival/Departure</th>
                                <th>Guests</th>
                                <th>Nights</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        @{{#each layouts}}
                            @{{#if this.count }}
                            <tr>
                                <td class="text-uppercase">@{{ this.item.title }}(@{{this.item.property.name}}) x @{{ count }}</td>
                                <td>@{{ guest.first_name }} @{{ guest.last_name }}</td>
                                <td>@{{ this.start_date }} - @{{ this.end_date }}</td>
                                <td>
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <i class="fa fa-user"></i> @{{ this.count_adults }}
                                        </li>
                                        <li class="list-inline-item">
                                            <small class="fa fa-user"></small> @{{ this.count_child }}
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                @{{ this.days }}
                                </td>
                                <td>
                                @{{ this.item.property_price.currency_code }} @{{ this.item.property_price.original_price }}
                                </td>
                            </tr>
                            @{{/if}}
                            @{{/each}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



</script>
<script id="property-layouts-template" type="text/x-handlebars-template">

@{{#each success.bookables}}
<tr>
    <td><span class="text-uppercase">@{{ this.title }}(@{{this.property.name}})</span></td>
    <td>@{{ this.property_price.currency_code }} @{{ this.property_price.original_price }} </td>
    <td> @{{ ../success.availablity.start_date }} </td>
    <td>@{{ ../success.availablity.end_date }}</td>
    <td>1</td>
    <td>
        <select name="layout[@{{this.id}}][count_adults]" class="counter_adults" data-layoutid="@{{ this.id }}" class="form-control bg-light">
            @for($i=0; $i<5; $i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </td>
    <td>
        <select name="layout[@{{this.id}}][count_child]"  class="counter_child" data-layoutid="@{{ this.id }}" class="form-control bg-light">
            @for($i=0;$i<5;$i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </td>
    <td>
        <select name="layout[@{{this.id}}][count_guests]"  class="counter_all" data-layoutid="@{{ this.id }}" class="form-control bg-light">
            @for($i=0; $i<5; $i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
    </td>
    <td>
        <button class="btn show-when-zero text-uppercase btn-primary btn-select-layout" data-layoutid="@{{this.id}}"> Add</button>
        <div class="input-group mb-3 show-when-not-zero" style="display:none;">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary btn-add-layout" data-layoutid="@{{this.id}}" type="button">+</button>
            </div>
            <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary btn-minus-layout" data-layoutid="@{{id}}" type="button">-</button>
            </div>
        </div>

    </td>
</tr>
@{{/each}}

</script>
<script id="property-layouts-selected-template" type="text/x-handlebars-template">

<div>
    <i class="fa fa-times float-right btn-remove-accomodation" data-layoutid="@{{ item.id }}"></i>
    <b>@{{ item.title }}(@{{item.property.name}}) x @{{ count }} - @{{ item.property_price.currency_code }} @{{ item.property_price.original_price }} </b><br/>
    <span>@{{ start_date }} - @{{ end_date }} &nbsp;&nbsp; @{{ days }} night(s)</span>
</div>
</script>


</section>
@stop
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css">
<link rel="stylesheet" href="{{asset('partner/css/booking/style.css')}}">
<link rel="stylesheet" href="{{asset('partner/css/booking/responsive.css')}}">
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

<link rel="stylesheet" type="text/css" href="{{ url('css/jquery-ui.min.css')}}" />
<style type="text/css">
div.loading{
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(16, 16, 16, 0.5);
  z-index: 99999;
}

@-webkit-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-ms-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-webkit-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes uil-ring-anim {
  0% {
    -ms-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -ms-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -webkit-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
.uil-ring-css {
  margin: auto;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 200px;
  height: 200px;
}
.uil-ring-css > div {
  position: absolute;
  display: block;
  width: 160px;
  height: 160px;
  top: 20px;
  left: 20px;
  border-radius: 80px;
  box-shadow: 0 6px 0 0 #ffffff;
  -ms-animation: uil-ring-anim 1s linear infinite;
  -moz-animation: uil-ring-anim 1s linear infinite;
  -webkit-animation: uil-ring-anim 1s linear infinite;
  -o-animation: uil-ring-anim 1s linear infinite;
  animation: uil-ring-anim 1s linear infinite;
}


</style>
@endpush
@push('scripts')
<script src="{{ url('js/jquery-ui.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
    <script>
    

        $(function(){

            var booking = { 
                layout_id:[],
                layouts:[],
                subtotal:0,
                taxes:0,
                fees:0,
                grand_total:0,
                deposit:0,
                balance:0,
                pricing:{},
                days:0
            };

            

            var currentStep = 1;
            var stepperInstance = new Stepper(document.querySelector('#reservation-stepper'), {
                linear: true,
                animation: true
            });

            var setAccomodations = function(){
                html = '';
                for(i in booking.layouts){
                    if(booking.layouts[i].count > 0){
                        var template = document.getElementById('property-layouts-selected-template').innerHTML;
                        var compiledTemplate = Handlebars.compile(template);
                        booking.layouts[i].start_date = booking.start_date;
                        booking.layouts[i].days = booking.days;
                        booking.layouts[i].end_date = booking.end_date;
                        var compiledData = compiledTemplate(booking.layouts[i]);
                        html+=compiledData;
                        $('#property-layouts-selected-container').parents('div').find('.hide-when-non-zero').hide();
                    }
                }
                $('#property-layouts-selected-container').html(html);
                if(html ==''){
                    $('#property-layouts-selected-container').parents('div').find('.hide-when-non-zero').show();
                }
            }

            var resetBooking = function(){
                bookings = { 
                    layout_id:[],
                    layouts:[],
                    subtotal:0,
                    taxes:0,
                    fees:0,
                    grand_total:0,
                    deposit:0,
                    balance:0,
                    pricing:{},
                    days:0
                };
            }

            var setPrices = function(){
                var subtotal = 0;
                var fees = 0;
                var grand_total = 0;
                var balance = 0;

                for(i in booking.layouts){
                    if(booking.layouts[i].count > 0){
                        subtotal = subtotal + (booking.layouts[i].item.property_price.original_price*booking.days);
                        fees = fees + booking.layouts[i].item.property_price.original_cleaning_fee + booking.layouts[i].item.property_price.original_guest_fee + booking.layouts[i].item.property_price.original_security_fee;
                        grand_total = grand_total + fees + subtotal;
                        balance = grand_total;

                        subtotal = subtotal * booking.layouts[i].count;
                        fees = fees * booking.layouts[i].count;
                        grand_total =  grand_total  * booking.layouts[i].count;
                        balance = balance * booking.layouts[i].count;
                    }
                }

                booking.subtotal = subtotal;
                booking.fees = fees;
                booking.grand_total = grand_total;
                booking.balance = balance;
                

                $('.holder-subtotal').html(booking.subtotal.toFixed(2));
                $('.holder-fees').html(booking.fees.toFixed(2));
                $('.holder-grand-total').html(booking.grand_total.toFixed(2));
                $('.holder-deposit').html(booking.deposit.toFixed(2));
                $('.holder-taxes').html(booking.taxes.toFixed(2));
                $('.holder-balance').html(booking.balance.toFixed(2));
            }


            $('body').on('click', '.btn-select-layout', function(){
                booking.layouts[$(this).data('layoutid')].count++;
                _this = this;
                $(this).parents('td').find('.show-when-not-zero').show();
                $(this).parents('td').find('.show-when-zero').hide();
                $(this).parents('td').find('input').val(1);

                setPrices();
                setAccomodations();
                //stepperInstance.next();
            });

            $('body').on('click', '.submit-reservation', function(){
                $.post('/api/bookings/create', booking, function(response){
                    swal({
                        title: 'Reservation Confirmed!',
                        text: 'The reservation for user '+response.success.first_name+' has been confirmed.',
                        icon: 'success'
                    }).then(function(result) {
                        window.location.reload();
                    });
                });
            });

            $('body').on('click', '.btn-add-layout', function(){
                booking.layouts[$(this).data('layoutid')].count++;
                booking.layouts[$(this).data('layoutid')].counter_all.push($(this).parents('tr').find('.counter_all').first().val());
                booking.layouts[$(this).data('layoutid')].counter_adults.push($(this).parents('tr').find('.counter_adults').first().val());
                booking.layouts[$(this).data('layoutid')].counter_child.push($(this).parents('tr').find('.counter_child').first().val());

                booking.layouts[$(this).data('layoutid')].count_all+=Number($(this).parents('tr').find('.counter_all').first().val());
                booking.layouts[$(this).data('layoutid')].count_adults+=Number($(this).parents('tr').find('.counter_adults').first().val());
                booking.layouts[$(this).data('layoutid')].count_child+=Number($(this).parents('tr').find('.counter_child').first().val());
                _this = this;
                $(this).parents('td').find('.show-when-not-zero').show();
                $(this).parents('td').find('.show-when-zero').hide();
                $(this).parents('td').find('input').val(booking.layouts[$(this).data('layoutid')].count);
                setPrices();
                setAccomodations();
                //stepperInstance.next();
            });

            
            $('body').on('click', '.btn-remove-accomodation', function(){
                $('.btn-minus-layout[data-layoutid='+$(this).data('layoutid')+']').trigger('click');
            });

            $('body').on('click', '.btn-minus-layout', function(){
                booking.layouts[$(this).data('layoutid')].count--;

                booking.layouts[$(this).data('layoutid')].count_all-= Number(booking.layouts[$(this).data('layoutid')].counter_all.pop());
                booking.layouts[$(this).data('layoutid')].count_adults-= Number(booking.layouts[$(this).data('layoutid')].counter_adults.pop());
                booking.layouts[$(this).data('layoutid')].count_child-=Number(booking.layouts[$(this).data('layoutid')].counter_child.pop());


                if(booking.layouts[$(this).data('layoutid')].count == 0){
                    $(this).parents('td').find('.show-when-not-zero').hide();
                    $(this).parents('td').find('.show-when-zero').show();
                }
                $(this).parents('td').find('input').val(booking.layouts[$(this).data('layoutid')].count);
                setPrices();
                setAccomodations();

                //stepperInstance.next();
            });


            $('body').on('click', '.btn-step-2', function(){
                booking.guest = {};
                booking.guest.first_name = $('#guest_first_name').val();
                booking.guest.last_name = $('#guest_last_name').val();
                booking.guest.email = $('#guest_email').val();
                booking.guest.phone = $('#guest_phone').val();
                booking.guest.cell_phone = $('#guest_cell_phone').val();
                booking.guest.dob = $('#guest_dob').val();
                booking.guest.gender = $('#guest_gender').val();
                booking.guest.tax_id_no = $('#guest_tax_id_no').val();
                booking.guest.company_name = $('#guest_company_name').val();
                booking.guest.company_tax_id_no = $('#guest_company_tax_id_no').val();
                booking.guest.address_1 = $('#guest_address_1').val();
                booking.guest.address_2 = $('#guest_address_2').val();
                booking.guest.city = $('#guest_city').val();
                booking.guest.country = $('#guest_country').val();
                booking.guest.state = $('#guest_state').val();
                booking.guest.zip = $('#guest_zip').val();
                booking.guest.country_name = $('#guest_country option:selected' ).text();
                if (booking.guest.first_name == '' || booking.guest.last_name == '' || booking.guest.email == '' || booking.guest.cell_phone == '' || booking.guest.address_1 == '' || booking.guest.address_2 == '' || booking.guest.city == '' ||  booking.guest.country == '' || booking.guest.state == '' || booking.guest.zip == '') {
                    $('.fill_required_fields_error').removeClass('d-none');
                    $(window).scrollTop(0);
                    
                    return false;
                } else {
                    $('.fill_required_fields_error').addClass('d-none');
                }
                stepperInstance.next();
                console.log({booking:booking});
                var template = document.getElementById('booking-confirmation-template').innerHTML;
                var compiledTemplate = Handlebars.compile(template);
                var compiledData = compiledTemplate(booking);

                $('#confirmation-tab-content').html(compiledData);
            });

            $('#btn-search-availability').click(function(){
                if(($('#search_start_date').val() == '') || ($('#search_end_date').val() == '')){
                    $('#initial-nonavailability-message').addClass('text-warning');
                    $('#initial-nonavailability-message').show();
                    $('#property-layouts-bookable-container').addClass('d-none');
                    $('#show-when-no-availability').addClass('d-none');
                    return;
                }

                resetBooking();
                booking.start_date = $('#search_start_date').val();
                booking.end_date = $('#search_end_date').val();
                booking.source = $('#search_source').val();
                booking.currentPropertyId = <?= $current_property_id ?>;
                $('.loading').removeClass('d-none');

                $.post('/api/check-availability', booking, function(response){
                    booking.layouts = [];
                    for(i in response.success.bookables){
                        booking.layouts[response.success.bookables[i].id] = {count:0, item:response.success.bookables[i], counter_all:[], counter_adults:[], counter_child:[], count_all:0, count_child:0, count_adults:0};
                    }
                    $('#initial-nonavailability-message').removeClass('text-warning');
                    $('#initial-nonavailability-message').hide();
                    booking.days = response.success.availablity.days;
                    booking.days = booking.days == 0 ? 1 : booking.days;
                    if(booking.layouts.length == 0){
                        $('#property-layouts-bookable-container').addClass('d-none');
                        $('#show-when-no-availability').removeClass('d-none');
                        return;
                    }
                    $('#show-when-no-availability').addClass('d-none');

                    var template = document.getElementById('property-layouts-template').innerHTML;
                    var compiledTemplate = Handlebars.compile(template);
                    console.log(response);
                    var compiledData = compiledTemplate(response);
                    // var compiledData = compiledTemplate({
                    //     'test': 'dasds'
                    // });
                    $('#property-layouts-bookable-container tbody').html(compiledData);
                    $('#property-layouts-bookable-container').removeClass('d-none');
                    $('.loading').addClass('d-none');
                });
            });

            var nextDay = new Date();
            nextDay.setDate(new Date().getDate() + 1);

              from = $( "#search_start_date" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 2,
                minDate:0,
                }).datepicker("setDate", new Date())
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
                to = $( "#search_end_date" ).datepicker({
                    defaultDate: "+1d",
                    changeMonth: true,
                    numberOfMonths: 2
                }).datepicker("setDate", nextDay)
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });
 
                function getDate( element ) {
                    var date;
                    try {
                        date = $.datepicker.parseDate( dateFormat, element.value );
                    } catch( error ) {
                        date = null;
                    }

                    return date;
                }

            $('#btn-step-1').click(function(){
                for(i in booking.layouts){
                    if(booking.layouts[i].count > 0){
                        nextStep();
                        return;
                    }
                }
                alert('Please select a layout to book');
                return;
            });

            var nextStep = function(){
                stepperInstance.next();
            }

            var previousStep = function(){
                stepperInstance.previous();
            }

            $('.btn-previous').click(function(){
                previousStep();
            });

            var setAvailability = function(){

            }

            setPrices();

        $(window).scroll(function(){
            $("#openPop-modal").click(function(){
                $("#openPop").modal('show');
            });
    
        });
});

document.getElementById('file_btn').onclick = function() {
    document.getElementById('my_file').click();
};
    </script>

@endpush