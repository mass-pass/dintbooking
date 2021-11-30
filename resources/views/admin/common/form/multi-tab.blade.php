@extends('admin.template')
@section('main')
<div class="content-wrapper">
    <section class="content-header">
		<h1>{{ $page_title or '' }}<small>{{ $page_subtitle or '' }}</small></h1>
		@include('admin.common.breadcrumb')
    </section>

	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						@php $fl = 0; @endphp
						@foreach($tab_names as $id => $name)
							@if($fl == 0)
								<li class="active"><a href="#{{$id}}" data-toggle="tab">{{$name}}</a></li>
								@php $fl=1; @endphp 
							@else
								<li><a href="#{{$id}}" data-toggle="tab">{{$name}}</a></li>
							@endif
						@endforeach
					</ul>

					<div class="tab-content">
						@php $fl = 0; @endphp

						@foreach($tab_forms as $id => $form)
							<div class="tab-pane {{ ($fl == 0)? 'active':''}}" id="{{$id}}">
								<form id="{{ $form['form_id'] or ''}}" method="post" action="{{ $form['action'] or ''}}" class="form-horizontal {{ $form['form_class'] or '' }}" {{ isset($form['form_type']) && $form['form_type'] == 'file'? "enctype=multipart/form-data":"" }}>
								{{ csrf_field() }}
								<div class="box-body">
									@foreach($form['fields'] as $field)
									@include("admin.common.fields.".$field['type'], ['field' => $field])
									@endforeach
									<div class="form-group">
									<div class="col-sm-offset-2 col-sm-6">
										<button type="button" class="btn btn-default">Cancel</button>
										<button type="submit" class="btn btn-info pull-right">Submit</button>
									</div>
									</div>
								</div>
								<!-- /.box-body -->
								</form>
							</div>
							@php $fl = 1; @endphp
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection