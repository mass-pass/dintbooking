@extends('admin.template')

@section('main')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
      <!-- Main content -->
      <section class="content">
          <div class="row">
                  <div class="col-md-3 settings_bar_gap">
                      @include('admin.common.settings_bar')
                  </div>
                  <div class="col-md-9">

                          <div class="box box_info">
                                <div class="box-header">
                                  <h3 class="box-title">Space  type Management</h3>
                                  <div class="pull-right"><a class="btn btn-success" href="{{ url('admin/settings/add-space-type') }}">Add Space Type</a></div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! $dataTable->table() !!}
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
