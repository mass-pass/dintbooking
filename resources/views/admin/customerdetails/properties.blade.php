@extends('admin.template')

@section('main')
<div class="content-wrapper">
	<section class="content">
		@include('admin.customerdetails.customer_menu')
		<div class="row">
				<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/customer/properties/'.$user->id) }}" method="GET" accept-charset="UTF-8">
						{{ csrf_field() }}
						<input class="form-control" id="startfrom" type="hidden" name="from" value="<?= isset($from) ? $from : '' ?>">
						<input class="form-control" id="endto" type="hidden" name="to" value="<?= isset($to) ? $to : '' ?>">
						<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="col-md-3 col-sm-3 col-xs-12">
								<label>Date Range</label>
								<div class="input-group col-xs-12">
									<button type="button" class="form-control" id="daterange-btn">
									<span class="pull-left">
									<i class="fa fa-calendar"></i>  Pick a date range
									</span>
									<i class="fa fa-caret-down pull-right"></i>
									</button>
								</div>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12">
								<label>Status</label>
								<select class="form-control" name="status" id="status">
									<option value="" >All</option>
									<option value="Listed" {{ $allstatus == "Listed" ? ' selected="selected"' : '' }}>Listed</option>
									<option value="Unlisted" {{ $allstatus == "Unlisted" ? ' selected="selected"' : '' }}>Unlisted</option>
								</select>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-12">
									<label>Space Type</label>
									<select class="form-control" name="space_type" id="space_type">
									<option value="" >All</option>
									@if ($space_type_all)
									
									@foreach($space_type_all as $data)
									<option value="{{$data->id}}" {{$data->id == $allSpaceType ? "selected": ''}}>{{$data->name}}</option>
									@endforeach
										
									@endif
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

		<div class="row">
			<div class="col-xs-12">
				<div class="box">
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
<script src="{{ asset('backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!}
@endpush

@section('validate_script')
<script type="text/javascript">

  // Date Time range picker for filter
$(function() {
	if ("{!! $from !!}") {
        var startDate = moment("{!! $from !!}",'MMMM D, YYYY');
        var endDate   = moment("{!! $to !!}",'MMMM D, YYYY');
    } else {
        var startDate = moment().subtract(29, 'days');
        var endDate   = moment();
    }

    $('#daterange-btn').daterangepicker(
		{
		ranges   : {
			'Today'       : [moment(), moment()],
			'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month'  : [moment().startOf('month'), moment().endOf('month')],
			'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: startDate,
		endDate  : endDate
		}, function (start, end) {
			var sessionDate      = '{{Session::get('date_format_type')}}';
			var sessionDateFinal = sessionDate.toUpperCase();
			var startDate        = moment(start, 'MMMM D, YYYY').format("YYYY-MM-DD");
			$('#startfrom').val(startDate);
			var endDate          = moment(end, 'MMMM D, YYYY').format("YYYY-MM-DD");
			$('#endto').val(endDate);
			$('#daterange-btn span').html(startDate + ' - ' +endDate )
		}
    )

    $(document).ready(function(){
        $('#dataTableBuilder_length').after('<div id="exportArea" class="col-md-4 col-sm-4 "><div class="row mt-m-2"><div class="btn-group btn-margin"><button type="button" class="form-control dropdown-toggle w-80" data-toggle="dropdown" aria-haspopup="true">Export</button><ul class="dropdown-menu d-menu-min-w"><li><a href="" title="CSV" id="csv">CSV</a></li><li><a href="" title="PDF" id="pdf">PDF</a></li></ul></div><div class="btn btn-group btn-refresh"><a href="" id="tablereload" class="form-control"><span><i class="fa fa-refresh"></i></span></a></div></div></div>');

        var startDate = "{!! $from !!}";
        var endDate   = "{!! $to !!}";
        if(startDate=='' && endDate==''){
			$('#daterange-btn span').html('<i class="fa fa-calendar"></i> &nbsp;&nbsp; Pick a date range');
        } else {
        $('#daterange-btn span').html(startDate + ' - ' +endDate );
        }
    });

      //csv convert
    $(document).on("click", "#csv", function(event){
        event.preventDefault();
        var space_type = $('#space_type').val();
        var status = $('#status').val();
        var to = $('#endto').val();
        var from = $('#startfrom').val();
        window.location = {{ $user->id }}+"/property_list_csv?to="+to+"&from="+from+"&space_type="+space_type+"&status="+status;
    });
      //pdf convert
    $(document).on("click", "#pdf", function(event){
        event.preventDefault();
        var space_type = $('#space_type').val();
        var status = $('#status').val();
        var to = $('#endto').val();
        var from = $('#startfrom').val();
        window.location = {{ $user->id }}+"/property_list_pdf?to="+to+"&from="+from+"&space_type="+space_type+"&status="+status;
    });
      //reload Datatable
    $(document).on("click", "#tablereload", function(event){
        event.preventDefault();
        $("#dataTableBuilder").DataTable().ajax.reload();
    });
});
</script>
@endsection