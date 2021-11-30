@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
<section>
        <div class="content-wrapper">
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Reservations</h4>
                        <div class="btn_actions">
                            <a href="#" class="link"> <i class="fa fa-download"></i> Download  </a>
                            <a href="#" class="link"> <i class="fa fa-print"></i> Print Reservation List  </a>
                        </div>
                     </div>
                </div>
                <!-- spacer -->
                <div class="hr">
                    <hr>
                </div>
                <!-- spacer -->
                <div class="content-body"> 

                    <div class="reservation-table-wrapper">
                        <div class="reservation-table-header">
                            <div class="row">
                               <div class="col-xl-8 col-lg-10 col-md-12">
                                   <form id="ajax-search-form" action="#" class="search-form">
                                    <div class="row">
                                        <div class="col-15">
                                            <div class="form-group">
                                                <label for="">Date of</label>
                                                <select name="" id="date_of" class="form-control">
                                                    <option value="start_date">Check-in</option>
                                                    <option value="end_date">Check-out</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-15">
                                            <div class="form-group">
                                                <label for="">From</label>
                                                <input type="text" name="" id="from_date" class="form-control" value="{{$startDate}}">
                                            </div>
                                        </div>
                                        <div class="col-15">
                                            <div class="form-group">
                                                <label for="">Until</label>
                                                <input type="text" name="end_date" id="end_date" class="form-control" value="{{$endDate}}">
                                            </div>
                                        </div>
                                        <div class="col-15">
                                            <div class="form-group dropdown">
                                                <label for="">&nbsp;</label> <br>
                                                <button class="btn btn-outline-primary dropdown-toggle btn-block" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Status
                                                  </button>
                                                  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <button onclick="setStatus('Accepted')" class="dropdown-item" type="button">Accepted</button>
    <button  onclick="setStatus('Cancelled')" class="dropdown-item" type="button">Cancelled</button>
    <button onclick="setStatus('Pending')" class="dropdown-item" type="button">Pending</button>
    <button onclick="setStatus('Declined')" class="dropdown-item" type="button">Declined</button>
    <button onclick="setStatus('Expired')" class="dropdown-item" type="button">Expired</button>
    <button onclick="setStatus('Processing')" class="dropdown-item" type="button">Processing</button>
    <button onclick="setStatus('')" class="dropdown-item" type="button">Clear</button>
                                                  </div> 
                                            </div>
                                        </div>
                                        <div class="col-15">
                                            <div class="form-group">
                                                <label for="">&nbsp;</label> <br>
                                               <button type="submit" class="btn btn-primary btn-block ajax-submit-button">Show</button>
                                            </div>
                                        </div>
                                       </div>
                                   </form>
                               </div>
                            </div>
                        </div>
                        <div class="reservation-table-body ajaxresult">
                            
                        </div>
                        <div class="reservation-table-body ajaxhidden">
                                            <div class="col-sm-4 offset-sm-4">
                                            <img class="ldlz m-4" data-src="{{url('img/loading.gif')}}" src="{{url('img/loading.gif')}}"  style="width: 128px; height: 128px; opacity: 1; visibility: visible;">
                                            </div>
                                     </div>
                    </div>
               
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')
    
    <script  type="text/javascript">
        var status = '';
        var token = $('meta[name=csrf-token]').attr('content');
        getReservationList();
        $("#ajax-search-form").submit(function(){
            getReservationList();
            return false;
        })
        function setStatus(st)
        {
            status =  st;
        }
        function isValidDate(d) {
          var d=new Date(d);
          if(d && d.getFullYear())
            return true;
           else 
            return false
        }
        function getReservationList(tab)
       {

        $("#from_date").removeClass("alert").removeClass("alert-danger")
        $("#end_date").removeClass("alert").removeClass("alert-danger")
        var fromDate=$("#from_date").val();
        var toDate=$("#end_date").val()
        
        if(!isValidDate(fromDate))
        {
            
            $("#from_date").addClass("alert").addClass("alert-danger")
            return false;
        }
        else if(!isValidDate(toDate))
        {
            $("#end_date").addClass("alert").addClass("alert-danger")
            return false;
        }
        var d1 = new Date(fromDate);
        var d2 = new Date(toDate);

        if(d1>d2)
        {

            $("#from_date").addClass("alert").addClass("alert-danger")
            $("#end_date").addClass("alert").addClass("alert-danger")
            return false;
        }
        $(".ajax-submit-button").attr("disabled",true)
        let index=tab-1;
        $(".ac-nav li a").removeClass("active")
        $(".ac-nav li a:eq('"+index+"')").addClass("active")
        
        $(".ajaxresult").addClass("d-none")
        $(".ajaxhidden").removeClass("d-none")
       
        $.post(
        "/partner/reservations/table",
        {_token:token,date_of:$("#date_of").val(),start_date:$("#from_date").val(),end_date:$("#end_date").val(),status:status},
        function(msg)
        {
             $(".ajax-submit-button").removeAttr("disabled");
            $(".ajaxresult").html(msg)
            $(".ajaxresult").removeClass("d-none")
            $(".ajaxhidden").addClass("d-none")
        })
    }
    </script>
@endpush