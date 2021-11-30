@extends('admin.template') 
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Reviews<small>Control panel</small></h1>
@include('admin.common.breadcrumb')
</section>
<!-- Main content -->
<section class="content">
	<!--Filtering Box Start -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/reviews') }}" method="GET" accept-charset="UTF-8">
						{{ csrf_field() }}
						<div class="col-md-12  d-none">
							<input class="form-control" type="text" id="startDate"  name="from" value="<?= isset($from) ? $from : '' ?>" hidden>
							<input class="form-control" type="text" id="endDate"  name="to" value="<?= isset($to) ? $to : '' ?>" hidden>
						</div>

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

									<div class="col-md-4 col-sm-3 col-xs-12">
										<label>Property</label>
										<select class="form-control" name="property" id="property">
											<option value="">All</option>
											@if(!empty($property))
												@foreach($property as $properties)
												<option value="{{$properties->id}}" "{{$properties->id == $allproperties ? ' selected="selected"' : ''}}">{{$properties->name}}</option>
												@endforeach
											@endif
										</select>
									</div>

									<div class="col-md-3 col-sm-2 col-xs-12">
										<label>Reviewer</label>
										<select class="form-control" name="reviewer" id="reviewer">
											<option value="" >All</option>
											<option value="guest" {{ $allreviewer == "guest" ? ' selected="selected"' : '' }}>Guest</option>
											<option value="host" {{ $allreviewer == "host" ? ' selected="selected"' : '' }}>Host</option>
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
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Reviews Management</h3>
				</div>
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
<script src="{{ asset('backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!} 
@endpush 
@section('validate_script')
<script type="text/javascript">
// Date Time range picker for filter
$(function() {

	var startDate      = $('#startDate').val();
	var endDate        = $('#endDate').val();
	dateRangeBtn(startDate,endDate, dt=1);
	formDate (startDate, endDate);

	$(document).ready(function(){
		$('#dataTableBuilder_length').after('<div id="exportArea" class="col-md-4 col-sm-4 "><div class="row mt-m-2"><div class="btn-group btn-margin"><button type="button" class="form-control dropdown-toggle w-80" data-toggle="dropdown" aria-haspopup="true">Export</button><ul class="dropdown-menu d-menu-min-w"><li><a href="" title="CSV" id="csv">CSV</a></li><li><a href="" title="PDF" id="pdf">PDF</a></li></ul></div><div class="btn btn-group btn-refresh"><a href="" id="tablereload" class="form-control"><span><i class="fa fa-refresh"></i></span></a></div></div></div>');
	});
	//csv convert
	$(document).on("click", "#csv", function(event){
		event.preventDefault();
		var property = $('#property').val();
		var reviewer = $('#reviewer').val();
		var to = $('#endDate').val();
		var from = $('#startDate').val();
		console.log(property);

		window.location = "reviews/review_list_csv?to="+to+"&from="+from+"&property="+property+"&reviewer="+reviewer;
	});
	//pdf convert
	$(document).on("click", "#pdf", function(event){
		event.preventDefault();
		var property = $('#property').val();
		var reviewer = $('#reviewer').val();
		var to = $('#endDate').val();
		var from = $('#startDate').val();
		window.location = "reviews/review_list_pdf?to="+to+"&from="+from+"&property="+property+"&reviewer="+reviewer;
	});
	//reload Datatable
	$(document).on("click", "#tablereload", function(event){
		event.preventDefault();
		$("#dataTableBuilder").DataTable().ajax.reload();
	});
});
</script>
@endsection