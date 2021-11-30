	@extends('admin.template')
	@push('css')
	<link href="{{ url('backend/css/setting.css') }}" rel="stylesheet" type="text/css" /> 
	@endpush
	@section('main')
	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-md-3 settings_bar_gap">
					@include('admin.common.settings_bar')
				</div>
			
				<div class="col-md-9">
					<div class="box box-info">
						<div class="error_email_settings">  
							<div class="alert alert-warning fade in alert-dismissable">
								<strong>Warning!</strong> Whoops there was an error. Please verify your below information. <a class="close" href="#" data-dismiss="alert" aria-label="close" title="close">×</a>
							</div>
						</div>

						<div class="box-header with-border">
							<h3 class="box-title">{{ $form_name ?? '' }}</h3><span class="email_status" >(<span class="text-green"><i class="fa fa-check" aria-hidden="true"></i>Verified</span>)</span>
						</div>
					
						<form id="{{ $form_id ?? ''}}" method="post" action="{{ $action ?? ''}}" class="form-horizontal {{ $form_class ?? '' }}" {{ isset($form_type) && $form_type == 'file'? "enctype=multipart/form-data":"" }}>
							{{ csrf_field() }}
							<div class="box-body">
								@foreach($fields as $field)
									@include("admin.common.fields.".$field['type'], ['field' => $field])
								@endforeach
								<div class="text-center" id="error-message"></div>
							</div>
							
							<div class="box-footer">
								<button type="submit" class="btn btn-info btn-space">Submit</button>
								@if(Request::segment(3) == 'email' || Request::segment(3) == '' || Request::segment(3) == 'api_informations' || Request::segment(3) == 'payment_methods' || Request::segment(3) == 'social_links')
									<a class="btn btn-danger" href="{{ url('admin/settings') }}">Cancel</a>
								@else
									<a class="btn btn-danger" href="{{ url('admin/settings') }}">Cancel</a>
								@endif
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection