@extends('admin.template')
@push('css')
<link href="{{ url('backend/css/preferences.css') }}" rel="stylesheet" type="text/css" /> 
@endpush
@section('main')

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3 settings_bar_gap">
          @include('admin.common.settings_bar')
        </div>
        <!-- right column -->
        <div class="col-md-9">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Preferences Setting Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="preferencesform" method="post" action="{{ url('admin/settings/preferences')}}" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputPassword1" class="control-label col-sm-3">Row Per Page <span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <select class="form-control" name="row_per_page" id="row_per_page">
                      @foreach($row_per_page as $key => $value)
                        <option value="{{ $key }}" {{ $result['row_per_page'] == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                {{-- date_sepa --}}
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3">Date Separator:</label>

                  <div class="col-sm-6">
                    <select name="date_separator" class="form-control">
                        <option value="-" {{isset($result['date_separator']) && $result['date_separator'] == '-' ? 'selected':""}}>-</option>
                        <option value="/" {{isset($result['date_separator']) && $result['date_separator'] == '/' ? 'selected':""}}>/</option>
                        <option value="." {{isset($result['date_separator']) && $result['date_separator'] == '.' ? 'selected':""}}>.</option>
                    </select>
                  </div>
                </div>

                {{-- date_format --}}
                 <div class="form-group">
                    <label class="col-sm-3 control-label" for="inputEmail3">Date Format:</label>
                    <div class="col-sm-6">
                      <select name="date_format" class="form-control" >
                          <option value="0" {{isset($result['date_format']) && $result['date_format'] == 0 ? 'selected':""}}>yyyymmdd {2019 12 31}</option>
                          <option value="1" {{isset($result['date_format']) && $result['date_format'] == 1 ? 'selected':""}}>ddmmyyyy {31 12 2019}</option>
                          <option value="2" {{isset($result['date_format']) && $result['date_format'] == 2 ? 'selected':""}}>mmddyyyy {12 31 2019}</option>
                          <option value="3" {{isset($result['date_format']) && $result['date_format'] == 3 ? 'selected':""}}>ddMyyyy &nbsp;&nbsp;&nbsp;{31 Dec 2019}</option>
                          <option value="4" {{isset($result['date_format']) && $result['date_format'] == 4 ? 'selected':""}}>yyyyMdd &nbsp;&nbsp;&nbsp;{2019 Dec 31}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label class="col-sm-3 control-label" for="inputEmail3">TimeZone</label>
                      <div class="col-sm-6">
                        <select class="form-control" name="dflt_timezone" id="dflt_timezone">
                            @foreach($timezones as $timezone)
                              <option value="{{ $timezone['zone'] }}" {{ isset($result['dflt_timezone']) && $result['dflt_timezone'] == $timezone['zone'] ? 'selected="selected"' : "" }}>
                                {{ $timezone['diff_from_GMT'] . ' - ' . $timezone['zone'] }}
                              </option>
                            @endforeach
                        </select>
                      </div>
                  </div>
                    {{-- money_format --}}
                  <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3">Money Symbol Position:</label>
                      <div class="col-sm-6">
                        <select name="money_format" class="form-control select2">
                            <option value="before" {{isset($result['money_format']) && $result['money_format'] == 'before' ? 'selected':""}}>Before { $500 }</option>
                            <option value="after" {{isset($result['money_format']) && $result['money_format'] == 'after' ? 'selected':""}}>After { 500$ }</option>
                        </select>
                      </div>
                  </div>    
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                @if(Request::segment(3) == 'email' || Request::segment(3) == '' || Request::segment(3) == 'api_informations' || Request::segment(3) == 'payment_methods' || Request::segment(3) == 'social_links')
                <a class="btn btn-default" href="{{ url('admin/settings') }}">Cancel</a>
                @else
                <button type="submit" class="btn btn-info ">Submit</button>
                <a class="btn btn-danger" href="{{ url('admin/settings') }}">Cancel</a>
              
                @endif
               
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

@endsection