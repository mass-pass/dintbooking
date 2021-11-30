@extends('admin.template')

@section('main')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
                <div class="col-md-3 settings_bar_gap">
                    @include('admin.common.settings_bar')
                </div>
                <div class="col-md-9">

                        <div class="box box_info">
                            <div class="box-header">
                                <h3 class="box-title">Country Management</h3>
                                <div class="pull-right"><a class="btn btn-success" href="{{ url('admin/settings/add-country') }}">Add Country</a></div>
                            </div>
                        
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
