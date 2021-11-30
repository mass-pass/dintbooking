@extends('layouts.partner_template')

@section('main')
    <section style="padding-left: 20%;padding-top:3%;">
    
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Group homepage</h4>
                        <a href="#" class="btn btn-primary">Add new property</a>
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
                                <h4>Properties in progress(2)</h4> <br>
                                <div class="property-table-wrapper">
                                    <table class="table  shadow-sm  ">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Location</th>
                                                <th>Registration Progress</th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                   <span class="letter-ico">J</span> John Doe
                                                </td>
                                                <td>
                                                    United Arab Emirates
                                                </td>
                                                <td>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar" style="width:90%">90%</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="link">Continue registration</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="link text-danger"> <i
                                                            class="fa fa-trash"></i>&nbsp; Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="letter-ico">J</span> John Doe
                                                </td>
                                                <td>
                                                    United Arab Emirates
                                                </td>
                                                <td>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar" style="width:70%">70%</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="#" class="link">Continue registration</a>
                                                </td>
                                                <td>
                                                    <a href="#" class="link text-danger"> <i
                                                            class="fa fa-trash"></i>&nbsp; Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                                                <a href="#" class="text-muted mr-4"> <i class="fa fa-download"></i>
                                                    Download </a>
                                                <a href="#" class="text-muted"> <i class="fa fa-ellipsis-v"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ends -->
                                    <!-- start -->
                                    <div class="row mb-4 col-items px-3">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="property-table-wrapper">
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
                                                        <tr>
                                                            <td>789465</td>
                                                            <td>
                                                                <div class="name-wrapper">
                                                                    <img src="images/img.jpg" alt="">
                                                                    <div class="name-details">
                                                                        <b>MP Furnished condos at opera</b>
                                                                        <div class="progress mt-2">
                                                                            <div class="progress-bar bg-success"
                                                                                style="width:70%">70%</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-flag-usa"></i> 1750 North Bayshore
                                                                Drive, Miami
                                                            </td>
                                                            <td>
                                                                <div class="status text-danger">
                                                                    Closed/Not bookable
                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary mr-3">0</span>
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-primary ">3</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>789465</td>
                                                            <td>
                                                                <div class="name-wrapper">
                                                                    <img src="images/img.jpg" alt="">
                                                                    <div class="name-details">
                                                                        <b>MP Furnished condos at opera</b>
                                                                        <div class="progress mt-2">
                                                                            <div class="progress-bar bg-warning"
                                                                                style="width:40%">40%</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-flag-usa"></i> 1750 North Bayshore
                                                                Drive, Miami
                                                            </td>
                                                            <td>
                                                                <div class="status text-danger">
                                                                    Closed/Not bookable
                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary mr-3">0</span>
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-primary ">3</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>789465</td>
                                                            <td>
                                                                <div class="name-wrapper">
                                                                    <img src="images/img.jpg" alt="">
                                                                    <div class="name-details">
                                                                        <b>MP Furnished condos at opera</b>
                                                                        <div class="progress mt-2">
                                                                            <div class="progress-bar bg-danger"
                                                                                style="width:20%">20%</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-flag-usa"></i> 1750 North Bayshore
                                                                Drive, Miami
                                                            </td>
                                                            <td>
                                                                <div class="status text-danger">
                                                                    Closed/Not bookable 
                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary mr-3">0</span>
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-primary ">3</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>789465</td>
                                                            <td>
                                                                <div class="name-wrapper">
                                                                    <img src="images/img.jpg" alt="">
                                                                    <div class="name-details">
                                                                        <b>MP Furnished condos at opera</b>
                                                                        <div class="progress mt-2">
                                                                            <div class="progress-bar bg-primary"
                                                                                style="width:90%">90%</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <i class="fa fa-flag-usa"></i> 1750 North Bayshore
                                                                Drive, Miami
                                                            </td>
                                                            <td>
                                                                <div class="status text-danger">
                                                                    Closed/Not bookable
                                                                </div>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary mr-3">0</span>
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-secondary">0</span>
                                                            </td>
                                                            <td align="center">
                                                                <span class="badge badge-primary ">3</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    <!-- Modal starts -->
    <div id="onLoad-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Property</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Add to contract under the name of the Legal Entity</label>
                            <select name="" id="" class="form-control">
                                <option value="">Select legal entity</option>
                                <option value="">Select legal entity</option>
                                <option value="">Select legal entity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Country/Region</label>
                            <select name="" id="" class="form-control">
                                <option value="">Please select</option>
                                <option value="">Please select</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Build your property</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script  type="text/javascript">
        $(document).ready(function () {
            $("#onLoad-modal").modal('show');
        });
    </script>
@endpush