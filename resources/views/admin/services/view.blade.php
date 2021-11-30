@extends('admin.template') 

@section('main')

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">
    <h1>
      Services
    </h1>
  @include('admin.common.breadcrumb')
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!--Filtering Box Start -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/services') }}" method="GET" accept-charset="UTF-8">
              {{ csrf_field() }}
              <div class="col-md-12  d-none">
                <input class="form-control" type="text" id="startDate"  name="from" value="<?= isset($from) ? $from : '' ?>" hidden>
                <input class="form-control" type="text" id="endDate"  name="to" value="<?= isset($to) ? $to : '' ?>" hidden>
              </div>
              
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                      <label>Date Range</label>
                      <div class="input-group  col-xs-12">
                        <button type="button" class="form-control" id="daterange-btn">
                              <span class="pull-left">
                                <i class="fa fa-calendar"></i>  Pick a date range
                              </span>
                              <i class="fa fa-caret-down pull-right"></i>
                            </button>
                      </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <label>Status</label>
                      <select class="form-control" name="status" id="status">
                          <option value="" >All</option>
                          <option value="Success" {{ $allstatus == "Success" ? ' selected="selected"' : '' }}>Success</option>
                          <option value="Pending"  {{ $allstatus == "Pending"  ? ' selected="selected"' : '' }}>Pending</option>
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-4 mt-5">
                      <br>
                      <button type="submit" name="btn" class="btn btn-primary btn-flat">Filter</button>
                    </div>
                    <div class="col-md-1 col-sm-2 col-xs-4 mt-5">
                      <br>
                      <button type="submit" name="reset_btn" class="btn btn-primary btn-flat">Reset</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--Filtering Box End -->
    <!-- Booking summary start-->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="panel panel-primary">
                            <div class="panel-body text-center">
                                <span class="text-20">{{ $totalPayouts }}</span><br>
                                <span class="total-payouts">Total Payouts</span>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-2">
                            <div class="panel panel-primary">
                                <div class="panel-body text-center">
                                    <span class="text-20">{{$totalPayoutsAmount}}</span><br>
                                    Total<span class="total-amount font-weight-bold"> </span> amount
                                </div>
                            </div>
                        </div>
                </div> 
            </div>
        </div>
      </div>
    </div>
    <!-- Booking summary ending-->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
              <div class="table-responsive">
                  {!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0']) !!}
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

 @push('scripts')
<script src="{{ asset('public/backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!} 
@endpush 

@section('validate_script')
<script type="text/javascript">
  // Select 2 for property search
  $('.select2').select2({
  // minimumInputLength: 3,
  ajax: {
      url: 'bookings/property_search',
      processResults: function (data) {
        $('#property').val('DSD');
        return {
          results: data
        };
      }
    }
  });

  // Date Time range picker for filter

$(function() {

      // * Set the time range for daterangepicker
      var startDate      = $('#startDate').val();
      var endDate        = $('#endDate').val();
      dateRangeBtn(startDate,endDate, dt=1);
      formDate (startDate, endDate);
      $(document).ready(function(){
          $('#dataTableBuilder_length').after('<div id="exportArea" class="col-md-4 col-sm-4 "><div class="row mt-m-2"><div class="btn-group btn-margin"><button type="button" class="form-control dropdown-toggle w-80" data-toggle="dropdown" aria-haspopup="true">Export</button><ul class="dropdown-menu d-menu-min-w "><li><a href="" title="CSV" id="csv">CSV</a></li><li><a href="" title="PDF" id="pdf">PDF</a></li></ul></div><div class="btn btn-group btn-refresh"><a href="" id="tablereload" class="form-control"><span><i class="fa fa-refresh"></i></span></a></div></div></div>');
      });

      //csv convert
      $(document).on("click", "#csv", function(event){
        event.preventDefault();
        var property = $('#property').val();
        var status = $('#status').val();
        var types = $('#types').val();
        var to = $('#endDate').val();
        var from = $('#startDate').val();
        window.location = "payouts/payouts_list_csv?to="+to+"&from="+from+"&property="+property+"&types="+types+"&status="+status;
      });

      //pdf convert
      $(document).on("click", "#pdf", function(event){
        event.preventDefault();
        var property = $('#property').val();
        var status = $('#status').val();
        var types = $('#types').val();
        var to = $('#endDate').val();
        var from = $('#startDate').val();
        window.location = "payouts/payouts_list_pdf?to="+to+"&from="+from+"&property="+property+"&types="+types+"&status="+status;
      });

      //reload Datatable
      $(document).on("click", "#tablereload", function(event){
        event.preventDefault();
        $("#dataTableBuilder").DataTable().ajax.reload();
      });
});

</script>

@endsection