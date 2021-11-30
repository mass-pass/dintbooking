@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
<section>
        <div class="content-wrapper">
            <div class="container">
                <div class="content-header">
                    <div class="dash-info">
                        <ul class="list-inline mb-3">
                            <li class="list-inline-item border-right">
                                Rates and Availability / Basic Rates
                            </li>
                            <li class="list-inline-item">
                                <a href="#"> <i class="fa fa-play-circle"></i>&nbsp; Learn to use </a>
                            </li>
                        </ul>
                        <div class="">
                            <p>On this page you can set the base rates for any period, including specific days of the
                                week and minimun and maximum length of stay limitations.
                                Base rates are also sometimes referred to as a BAR or<br>"Best Available Rate".<br>
                                <b>Important:</b>base rate is (valid) for all channels (mannual reservations in the
                                system, online booking page and connected OTAs.). Some OTAs do not allow setting minimun
                                and maximun length of stay<br>
                                limitations, <a href="" class="link">click here for more details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="t-wrapper mb-4">
                    <div class="t-header">
                        <div class="tab-links">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach($property_layouts as $ii=>$property_layout)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $ii==0 ? 'active':'' }}" id="{{ str_slug($property_layout->title) }}-tab" data-layoutid="{{ $property_layout->id }}" data-toggle="tab" href="#{{ str_slug($property_layout->title) }}"
                                        role="tab" aria-controls="{{ str_slug($property_layout->title) }}" aria-selected="true">{{$property_layout->title}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <div class="guests-content-wrapper">
                        <div class="interval-btn">
                            <h5>DATE RANGES, RATES AND RESTRICTIONS</h5>
                            <div class="interval-btn  d-flex">
                                <div class=" add-interval mb-3 mr-2">
                                    <a href="" class="btn btn-success text-uppercase  toggler" ref="intervalWrapper"><i class="fas fa-plus"></i> ADD
                                        INTERVAL</a>
                                </div>
                                <div class="d-none copy-interval mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-toggle="dropdown">COPY INTERVAL<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a href="#" class="dropdown-item">Copy intervals from another accomodation
                                                type</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Interval Name</label>
                                                            <input type="text" name="name"  class="form-control" id="interval_name"
                                                                placeholder="Interval Name">
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Min LOS <span data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Place your code here"><i
                                                                                class="fas fa-question-circle"></i></span></label>
                                                                    <input type="number" name="min_los" class="form-control"
                                                                        id="interval_min_los">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Max LOS <span data-toggle="tooltip"
                                                                            data-placement="top"
                                                                            title="Place your code here"><i
                                                                                class="fas fa-question-circle"></i></span></label>
                                                                    <input type="number" name="max_los" class="form-control"
                                                                        id="interval_max_los">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Start Date</label>
                                                                    <input type="date" name="start_date" class="form-control"
                                                                        id="interval_start_date">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">End Date</label>
                                                                    <input type="date" name="end_date" class="form-control" id="interval_end_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label for="">Closed to arrival <i
                                                                        class="fas fa-question-circle"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Place your code here"></i></label>
                                                                <div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input type="radio" name="closed_arrivals" value="1" id="interval_closed_arrivals_1">
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input type="radio" name="closed_arrivals" id="interval_closed_arrivals_0" value="0" checked>
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for=""> Closed to Departure <i
                                                                        class="fas fa-question-circle"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Place your code here"></i></label>
                                                                <div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input type="radio" name="closed_departure" value="1" id="interval_closed_departure_1">
                                                                            <span>Yes</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-check-inline">
                                                                        <div class="custom-radio">
                                                                            <input type="radio" name="closed_departure" value="0" id="interval_closed_departure_0" checked>
                                                                            <span>No</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <p class="mb-2">Do you charge for additional addults and or
                                                            children? (Myfrontdesk and <a href=""
                                                                class="link">mybookings</a>) only</p>
                                                        <div>
                                                            <div class="form-check-inline">
                                                                <div class="custom-radio">
                                                                    <input type="radio" name="closeD" id="">
                                                                    <span>Yes</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-check-inline">
                                                                <div class="custom-radio">
                                                                    <input type="radio" name="closeD" id="">
                                                                    <span>No</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"></div>
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
                                                                    <th style="min-width: 150px;"></th>
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
                                                                    <td><input type="text" name="charges_sunday" id="charges_sunday"  class="line-input"
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text" name="charges_monday" id="charges_monday"  class="line-input"
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text" name="charges_tuesday" id="charges_tuesday"  class="line-input"
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text"  name="charges_wednesday" id="charges_wednesday" class="line-input"
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text" class="line-input"  name="charges_thursday" id="charges_thursday" 
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text" class="line-input"  name="charges_friday" id="charges_friday" 
                                                                            placeholder="$0.00" value=""></td>
                                                                    <td><input type="text" class="line-input" name="charges_saturday" id="charges_saturday" 
                                                                            placeholder="$0.00" value=""></td>
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
                                                                                <a href="javascript:void(0)" id="btn-add-interval" class="btn btn-primary text-uppercase  " >ADD
                                                                                        INTERVAL</a>
                                                                                    <!--<a href=""
                                                                                        class="btn btn-primary text-uppercase  "
                                                                                        data-toggle="modal"
                                                                                        data-target="#confirmationModal">ADD
                                                                                        INTERVAL</a>-->
                                                                                </div>
                                                                                <div class=" copy-interval">
                                                                                    <div class="dropdown">
                                                                                        <button ref="intervalWrapper"
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            @foreach($property_layouts as $ii => $property_layout)
                                @if($ii==0)
                                    <input id="property_layout_id" name="property_layout_id" value="{{ $property_layout->id }}" type="hidden" />
                                @endif
                            <div class="tab-pane {{ $ii==0 ? 'active':'' }} fade show" id="{{ str_slug($property_layout->title) }}">
                                <div class="guests-table-wrapper">
                                    <div class="card border rounded-0">
                                        <div class="card-header bg-dark text-white">
                                            <h5 class="mb-0 d-flex justify-content-between">
                                                INTERVALS
                                            </h5>
                                        </div>
                                        <div class="card-body pb-2 ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>NAME</th>
                                                                <th>START DATE</th>
                                                                <th>END DATE</th>
                                                                <th>MIN LOS</th>
                                                                <th>MAX LOS</th>
                                                                <th>DAYS OF WEEK</th>
                                                                <th>
                                                                </th>
                                                            </tr>
                                                        <tbody id="pricing_intervals_for_property_layout_{{ $property_layout->id }}">
                                                            @foreach($property_layout->pricing_intervals as $pricing_interval)
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="link"> <i
                                                                            class="far fa-plus-square "></i>  {{ $pricing_interval->name }}</a>
                                                                </td>
                                                                <td>
                                                                    {{ $pricing_interval->start_date }}
                                                                </td>
                                                                <td>
                                                                    {{ $pricing_interval->end_date }}
                                                                </td>
                                                                <td>
                                                                    {{ $pricing_interval->min_los }}
                                                                </td>
                                                                <td>
                                                                {{ $pricing_interval->max_los }}
                                                                </td>
                                                                <td>
                                                                    {{ $pricing_interval->interval_days_as_string }}
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" data-pricingintervalid="{{ $pricing_interval->id }}" class="link btn p-1 btn-edit-pricing_interval"><i
                                                                            class="fas fa-pencil-alt"></i></a>
                                                                    <a href="javascript:void(0)" data-pricingintervalid="{{ $pricing_interval->id }}" class="text-danger btn p-1 btn-remove-pricing_interval"><i
                                                                            class="fas fa-times-circle"></i></a>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script id="pricing-interval-template" type="text/x-handlebars-template">
    <tr>
            <td>
                <a href="#" class="link"> <i
                        class="far fa-plus-square "></i> @{{ pricing_interval.name }}</a>
            </td>
            <td>
                @{{ pricing_interval.start_date }}
            </td>
            <td>
                @{{ pricing_interval.end_date }}
            </td>
            <td>
                @{{ pricing_interval.min_los }}
            </td>
            <td>
                    @{{ pricing_interval.max_los }}
            </td>
            <td>
                @{{ pricing_interval.interval_days_as_string }}
            </td>
            <td>
                <a href="javascript:void(0)" data-pricingintervalid="@{{ pricing_interval.id }}" class="link btn p-1 btn-edit-pricing_interval"><i
                        class="fas fa-pencil-alt"></i></a>
                <a href="javascript:void(0)" data-pricingintervalid="@{{ pricing_interval.id }}" class="text-danger btn p-1 btn-remove-pricing_interval"><i
                        class="fas fa-times-circle"></i></a>
            </td>
        </tr>

    </script>
@stop
@push('css')
<script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>

<!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

@endpush
@push('scripts')
<script>
$(function(){
    $('.tab-links').find('.nav-link').click(function(){
        $('#property_layout_id').val($(this).data('layoutid'));
    });

    $('.toggler').click(function(){
        var ref = $(this).attr('ref');
        console.log({ref:ref});
        $('#'+ref).toggle('slide');
        return false;
    });

    
    $('body').on('click','.btn-edit-pricing_interval', function(){
        alert('work in progress');
    });

    $('body').on('click','.btn-remove-pricing_interval', function(){
        var _this = this;
        $.post('/api/pricing_intervals/'+$(this).data('pricingintervalid')+'/delete', function(response){
            $(_this).parents('tr').first().css('backgroundColor', 'red').fadeOut('fast', function(){
                $(_this).remove();
            })
            var template = document.getElementById('pricing-interval-template').innerHTML;
                var compiledTemplate = Handlebars.compile(template);
                var compiledData = compiledTemplate(response.success);
                console.log({compiledData:compiledData});
                $('#pricing_intervals_for_property_layout_'+response.success.pricing_interval.property_layout_id).append(compiledData);

        });

    })

    $('#btn-add-interval').click(function(){
        data = {};
        data.name = $('#interval_name').val();
        data.min_los = $('#interval_min_los').val();
        data.max_los = $('#interval_max_los').val();
        data.start_date = $('#interval_start_date').val();
        data.end_date = $('#interval_end_date').val();
        data.closed_arrivals = $('input[name="closed_arrivals"]:checked').first().val();
        data.closed_departure = $('input[name="closed_departure"]:checked').first().val();
        data.extra_charges_additional_guest = 0;
        data.charges_sunday = $('#charges_sunday').val() ? $('#charges_sunday').val() : 0;
        data.charges_monday = $('#charges_monday').val() ? $('#charges_monday').val() : 0;
        data.charges_tuesday = $('#charges_tuesday').val() ? $('#charges_tuesday').val() : 0;
        data.charges_wednesday = $('#charges_wednesday').val() ? $('#charges_wednesday').val() : 0;
        data.charges_thursday = $('#charges_thursday').val() ? $('#charges_thursday').val() : 0;
        data.charges_friday = $('#charges_friday').val() ? $('#charges_friday').val() : 0;
        data.charges_saturday = $('#charges_saturday').val() ? $('#charges_saturday').val() : 0;
        data.property_layout_id = $('#property_layout_id').val();

        $.post('/api/pricing_intervals/create', data, function(response){
            var template = document.getElementById('pricing-interval-template').innerHTML;
                var compiledTemplate = Handlebars.compile(template);
                var compiledData = compiledTemplate(response.success);
                console.log({compiledData:compiledData});
                $('#pricing_intervals_for_property_layout_'+response.success.pricing_interval.property_layout_id).append(compiledData);

        });

    })
})


</script>
@endpush
