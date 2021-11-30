@extends('layouts.master')

@section('main')
    <!-- content starts -->
    <section>
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Group homepage</h4>
                    </div>
                </div>
                <!-- spacer -->
                <div class="hr">
                    <hr>
                </div>
                <!-- spacer -->
                <div class="content-body">
                    <div class="property-layout-wrapper pt-3">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <h4>Active Properties</h4> <br>
                                <div class="active-properties-header">
                                    <!-- start -->
                                    <div class="row mb-4 justify-content-between align-items-center">
                                        <div class="col-md-6">
                                            <input type="text" name="" class="form-control" id=""
                                                placeholder="Filter by property ID, name, or location">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="acph-actions text-md-right">
                                                <a href="#" class="text-muted mr-4" onclick="alert('work in progress');"> <i class="fa fa-download"></i>
                                                    Download </a>
                                                <a href="#" class="text-muted"> <i class="fa fa-ellipsis-v"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ends -->
                                    <!-- start -->
                                    <!-- <div class="row mb-4 col-items px-3">
                                        <div class="col">
                                            <h5><b>US $101.16</b></h5>
                                            Booked avg. daily Rates <br>
                                            <small>Year-to-date</small>
                                        </div>
                                        <div class="col">
                                            <h5><b>US $96.16</b></h5>
                                            Stayed avg. daily Rates <br>
                                            <small>Year-to-date</small>
                                        </div>
                                        <div class="col">
                                            <h5><b>68.35%</b></h5>
                                            Cancellation Rate <br>
                                            <small>Year-to-date</small>
                                        </div>
                                        <div class="col">
                                            <h5><b>663</b></h5>
                                            Stayed room nights <br>
                                            <small>Year-to-date</small>
                                        </div>
                                        <div class="col">
                                            <h5><b>US $63,707.05</b></h5>
                                            Stayed earnings <br>
                                            <small>Year-to-date</small>
                                        </div>
                                        <div class="col">
                                            <h5><b>0/10</b></h5>
                                            Open <br>
                                            <small>Properties in this group</small>
                                        </div>
                                    </div>-->
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="property-table-wrapper">
                                                <div class="table-responsive">
                                                    <table class="table  shadow-sm  ">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Location</th>
                                                                <th>Status</th>
                                                                <th>Arrivals/departures for today & tomorrow</th>
                                                                <th>Guest Messages</th>
                                                                <th>Dint.com Messages</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($properties as $property)
                                                            <tr>
                                                                <td>{{ $property->id }}</td>
                                                                <td>
                                                                    <div class="name-wrapper">
                                                                        <img src="{{ $property->cover_photo }}" alt="{{ $property->name }}">
                                                                        <div class="name-details">
                                                                        <b> <a href="{{ route('partner.property.dashboard', $property->id) }}"> {{ $property->name }} </a> </b>
                                                                            <div class="progress mt-2">
                                                                                <div class="progress-bar bg-success"
                                                                                    style="width:70%">70%</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <i class="fa fa-flag-usa"></i> {{$property->property_address?$property->property_address->address_line_1:''}}
                                                                </td>
                                                                <td>
                                                                    <div class="status text-danger">
                                                                        {{ $property->status }}
                                                                    </div>
                                                                </td>
                                                                <td align="center">
                                                                    <span class="badge badge-secondary mr-3">{{ $property->checkinsTodayCount() }}</span>
                                                                    <span class="badge badge-secondary">{{ $property->checkinsTomorrowCount() }}</span>
                                                                </td>
                                                                <td align="center">
                                                                    <span class="badge badge-secondary">{{ $property->guestMessages() }}</span>
                                                                </td>
                                                                <td align="center">
                                                                    <span class="badge badge-primary ">{{ $property->dintMessages() }}</span>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- content ends -->
@stop