@extends('admin.template') 
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box box_info">
          <div class="box-header">
            <h3 class="box-title">Guest Penalty</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              {!! $dataTable->table(['class' => 'table table-striped table-hover dt-responsive', 'width' => '100%', 'cellspacing' => '0'])
              !!}
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