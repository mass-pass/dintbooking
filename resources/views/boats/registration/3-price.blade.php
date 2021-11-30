<div class="row">
    <div class="col-lg-12">
        <h3 class="mb-4">Reference price</h3>
        <p>Seta base rental price for your boat. This should be the lowest price you are willing to accept for rentals.Pou will then be able to add custom price periods</p>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Price /day {{ Session::get('currency') }}</span>
            <input type="text" class="form-control" v-model="boat.price" id="basic-url" aria-describedby="basic-addon3">
        </div>
        <div class=" add-interval mb-3 mr-2">
            <a href="" class="btn btn-success text-uppercase  toggler" data-ref="intervalWrapper">
                <i class="fas fa-plus"></i> Create a new price interval
            </a>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="interval-body" id="intervalWrapper" style="display:none">
            <div class="card border rounded-0 mb-4">
                <div class="card-header ">
                    <h5 class="mb-0 d-flex justify-content-between">
                        ADD INTERVAL
                    </h5>
                </div>
                <div class="card-body pb-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Interval Name</label>
                                        <input type="text" name="name" v-model="pricing_interval.name" class="form-control" id="interval_name"
                                            placeholder="Interval Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Start Date</label>
                                        <input type="date" name="start_date" v-model="pricing_interval.start_date"  class="form-control"
                                            id="interval_start_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">End Date</label>
                                        <input type="date" name="end_date"  v-model="pricing_interval.end_date"  class="form-control" id="interval_end_date">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Closed to drop off <i
                                            class="fas fa-question-circle"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Place your code here"></i></label>
                                    <div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio"  v-model="pricing_interval.closed_arrivals" name="closed_arrivals" value="1" id="interval_closed_arrivals_1">
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio"  v-model="pricing_interval.closed_arrivals"  name="closed_arrivals" id="interval_closed_arrivals_0" value="0" checked>
                                                <span>No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for=""> Closed to Booking <i
                                            class="fas fa-question-circle"
                                            data-toggle="tooltip"  data-placement="top"
                                            title="Place your code here"></i></label>
                                    <div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio"  v-model="pricing_interval.closed_departure" name="closed_departure" value="1" id="interval_closed_departure_1">
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio" name="closed_departure"  v-model="pricing_interval.closed_departure" value="0" id="interval_closed_departure_0" checked>
                                                <span>No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Define which days of week this will be avialable and indicate
                                the price for that day <i class="fas fa-question-circle"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Place your code here"></i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <thead class="thead-light text-center">
                                    <tr>
                                        <th ></th>
                                        <th align="center">Sun<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Mon<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Tue<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Wed<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Thu<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Fri<br><i
                                                class="fas fa-check text-primary"></i></th>
                                        <th align="center">Sat<br><i
                                                class="fas fa-check text-primary"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Price</b></td>
                                        <td><input type="text" name="charges_sunday" id="charges_sunday" v-model="pricing_interval.charges_sunday"  class="line-input"
                                                placeholder="$0.00" style="width:70px"  value=""></td>
                                        <td><input type="text" name="charges_monday" id="charges_monday" v-model="pricing_interval.charges_monday"  class="line-input"
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                        <td><input type="text" name="charges_tuesday" id="charges_tuesday"  v-model="pricing_interval.charges_tuesday"  class="line-input"
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                        <td><input type="text"  name="charges_wednesday" id="charges_wednesday"  v-model="pricing_interval.charges_wednesday" class="line-input"
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                        <td><input type="text" class="line-input"  name="charges_thursday"  v-model="pricing_interval.charges_thursday" id="charges_thursday" 
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                        <td><input type="text" class="line-input"  name="charges_friday"  v-model="pricing_interval.charges_friday" id="charges_friday" 
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                        <td><input type="text" class="line-input" name="charges_saturday"  v-model="pricing_interval.charges_saturday" id="charges_saturday" 
                                                placeholder="$0.00" style="width:70px" value=""></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="interval-btn">
                                <table class="table table-borderless">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>
                                                <div class="interval-btn  d-flex">
                                                    <div class=" add-interval mr-2">
                                                    <a href="javascript:void(0)" @click="addPricingInterval()" id="btn-add-interval" class="btn btn-primary text-uppercase  " >ADD
                                                            INTERVAL</a>
                                                        <!--<a href=""
                                                            class="btn btn-primary text-uppercase  "
                                                            data-toggle="modal"
                                                            data-target="#confirmationModal">ADD
                                                            INTERVAL</a>-->
                                                    </div>
                                                    <div class=" copy-interval">
                                                        <div class="dropdown">
                                                            <button data-ref="intervalWrapper"
                                                                class="toggler btn btn-secondary "
                                                                type="button">CANCEL</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row" v-if="pricing_intervals.length > 0">
                        <div class="col-lg-12">
                            <h3>Pricing Intervals</h3>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th>NAME</th>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                        <th>DAYS OF WEEK</th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody >
                                    <tr v-for="the_pricing_interval in pricing_intervals">
                                        <td>
                                            <a href="#" class="link"> <i
                                                    class="far fa-plus-square "></i>  
                                                    @{{ the_pricing_interval.name }}</a>
                                        </td>
                                        <td>
                                            @{{ the_pricing_interval.start_date }}
                                        </td>
                                        <td>
                                            @{{ the_pricing_interval.end_date }}
                                        </td>
                                        <td>
                                            @{{ the_pricing_interval.interval_days_as_string }}
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" @click="deletePricingIntervals(the_pricing_interval)" class="text-danger btn p-1 btn-remove-pricing_interval"><i
                                                    class="fas fa-times-circle"></i></a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-right">
            <hr/><br/>
            <a class="btn thme-btn  px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn  px-5" v-on:click="saveImages();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

