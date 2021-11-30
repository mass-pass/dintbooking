@extends('admin.template')

@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reports
        <small>Control panel</small>
      </h1>
      @include('admin.common.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Reports Management</h3>
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
<script type="text/javascript">
  $(document).on('change', '.report_status', function(){
    var dataURL = APP_URL+'/admin/reports/status_change';
    var report_id = $(this).attr('data-rel');
    var status = $(this).val();
    $.ajax({
        url: dataURL,
        data: {'report_id': report_id, 'status': status},
        type: 'post',
        async: true,
        dataType: 'json',
        success: function (result) {
          //console.log(result.success);
          if(result.success){

          }
        },
        error: function (request, error) {
          
        }
    });
  });
</script>
<script src="{{ asset('backend/plugins/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/Responsive-2.2.2/js/dataTables.responsive.min.js') }}"></script>
{!! $dataTable->scripts() !!}
@endpush