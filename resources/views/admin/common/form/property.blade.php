@extends('admin.template')
@section('main')
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-3 settings_bar_gap">
				@include('admin.common.property_bar')
			</div>
			
			<div class="col-md-9">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $form_name or '' }}</h3>
					</div>
					
					<form id="{{ $form_id or ''}}" method="post" action="{{ $action or ''}}" class="form-horizontal {{ $form_class or '' }}" {{ isset($form_type) && $form_type == 'file'? "enctype=multipart/form-data":"" }}>
						{{ csrf_field() }}
						<div class="box-body">
							@foreach($fields as $field)
							@include("admin.common.fields.".$field['type'], ['field' => $field])
							@endforeach
						</div>
				
						<div class="box-footer">
							<button type="submit" class="btn btn-default">Cancel</button>
							<button type="submit" class="btn btn-info pull-right">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection