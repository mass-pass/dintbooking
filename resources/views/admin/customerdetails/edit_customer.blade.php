	@extends('admin.template')

	@section('main')
	<div class="content-wrapper">
		<section class="content">
			@include('admin.customerdetails.customer_menu')
			<div class="row">
			<!-- right column -->
			<div class="col-md-12">
				<!-- Horizontal Form -->
				<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{ $form_name or '' }}</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form id="{{ $form_id or ''}}" method="post" action="{{ $action or ''}}" onsubmit="return contentValidate();" class="form-horizontal {{ $form_class or '' }}" {{ isset($form_type) && $form_type == 'file'? "enctype=multipart/form-data":"" }}>
					{{ csrf_field() }}
					<div class="box-body">
					@foreach($fields as $field)
						@include("admin.common.fields.".$field['type'], ['field' => $field])
					@endforeach
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
					<button type="submit" class="btn btn-info btn-space">Submit</button>
					<button type="reset" class="btn btn-danger">Reset</button>
					</div>
					<!-- /.box-footer -->
				</form>
				</div>
				<!-- /.box -->

				<!-- /.box -->
			</div>
			<!--/.col (right) -->
			</div>
		</section>
	</div>
	@endsection