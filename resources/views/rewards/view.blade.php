@extends('layouts.master')
@section('main')
<style type="text/css">
#dataTableBuilder_length{
	display:inline;
}
.dataTables_filter{
	float:right;
}
</style>
<div class="margin-top-85">
	<div class="row m-0">
		@include('users.sidebar')

		<div class="col-lg-10 p-0">
			<div class="container-fluid min-height">
				<div class="main-panel">
					<div class="row justify-content-center mt-5">
						<div class="col-md-12">
							<nav class="navbar navbar-expand-lg navbar-light list-bacground border rounded-3 p-3">
								<ul class="navbar-nav">
									<li class="nav-item pl-4 pr-4">
										<span class="text-color secondary-text-color font-weight-700 text-color-hover">{{ trans('messages.users_dashboard.rewards')}}</span>
									</li>
									<li class="nav-item  pl-4 pr-4">
										Matured Points: {{ $total_matured_points }} / Total Points: {{ $total_points }}
									</li>
								</ul>
							</nav>

							@if(Session::has('message'))
							<div class="row mt-4">
								<div class="col-md-12 text-13 alert mb-0 text-center {{ Session::get('alert-class') }} alert-dismissable fade in opacity-1">
									<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
									{{ Session::get('message') }}
								</div>
							</div>
							@endif 

						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
						<div class="">
							<div class="">
								<div class="table-responsive">
									{!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0']) !!}
								</div>
							</div>
						</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>



@endsection

@push('scripts')
<script src="{{ asset('backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!} 
@endpush 
@section('validate_script')
<script type="text/javascript">
$('.select2').select2({
ajax: {
	url: "{{ url('admin/customer/bookings/property_search') }}",
	type:'post',
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
	},
	function (start, end) {
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
		$('#dataTableBuilder_length').after('<div id="exportArea" class="col-md-4 col-sm-4 "><div class="row mt-m-2"><div class="btn-group btn-margin"><button type="button" class="form-control dropdown-toggle" data-toggle="dropdown w-80" aria-haspopup="true">Export</button><ul class="dropdown-menu d-menu-min-w"><li><a href="" title="CSV" id="csv">CSV</a></li><li><a href="" title="PDF" id="pdf">PDF</a></li></ul></div><div class="btn btn-group btn-refresh"><a href="" id="tablereload" class="form-control"><span><i class="fa fa-refresh"></i></span></a></div></div></div>');
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
		var property = $('#property').val();
		var status = $('#status').val();
		var to = $('#endto').val();
		var from = $('#startfrom').val();
		window.location = {{ @$user->id }}+"/booking_list_csv?to="+to+"&from="+from+"&property="+property+"&status="+status;
	});
	//pdf convert
	$(document).on("click", "#pdf", function(event){
		event.preventDefault();
		var property = $('#property').val();
		var status = $('#status').val();
		var to = $('#endto').val();
		var from = $('#startfrom').val();
		window.location = {{ $user->id }}+"/booking_list_pdf?to="+to+"&from="+from+"&property="+property+"&status="+status;
	});
	//reload Datatable
	$(document).on("click", "#tablereload", function(event){
		event.preventDefault();
		$("#dataTableBuilder").DataTable().ajax.reload();
	});
});

</script>
@endsection