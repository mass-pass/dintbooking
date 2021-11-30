@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $page_title ?? '' }}
        <small>{{ $page_subtitle ?? '' }}</small>
      </h1>
      @include('admin.common.breadcrumb')
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Report Details</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="report_form" method="post" action="{{ url('admin/display_report/'.$result->id) }}" class="form-horizontal">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <p>{{ $result->message }}</p>
                  <label for="inputEmail3" class="col-sm-2 control-label">Status</label>
                  <div class="col-sm-6">
                    <select class="form-control" id="report_status" name="status">
                      <option value='unsolved' {{ ($result->status ==  'unsolved')?'selected':'' }}>Unsolved</option>
                      <option value='solved' {{ ($result->status ==  'solved')?'selected':'' }}>Solved</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                    
                    <button type="submit mt-15" class="btn btn-info">Submit</button>
                    
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            
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