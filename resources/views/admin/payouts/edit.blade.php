@extends('admin.template')

@section('main')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payouts
        <small>Edit Payout</small>
      </h1>
    @include('admin.common.breadcrumb')
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box">
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{url('admin/payouts/edit')}}/{{$withDrawal->id}}" id="edit_payout" method="post" name="add_customer" accept-charset='UTF-8'>
                {{ csrf_field() }}
                <div class="box-body">
                           
               <input type="hidden" name="id" id="" value="{{ $withDrawal->id}}">
                
                <div class="form-group">
                 <label for="exampleInputPassword1" class="control-label col-sm-3">Amount :</label>
                  <div class="col-sm-4">
                   <input type="hidden" name="amount" value="{{ $withDrawal->subtotal}}" class="form-control" > 
                   <h5>{!! $withDrawal->currency->symbol !!} {{ $withDrawal->subtotal}}</h5>
                  </div>  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1" class="control-label col-sm-3">Status :</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="status" id="status">
                        <option value="Pending" {{$withDrawal->status == 'Pending' ? 'selected' : ''}}>Pending</option>
                        <option value="Success" {{$withDrawal->status == 'Success' ? 'selected' : ''}}>Success</option>
                     
                      </select>
                      @if ($errors->has('status')) <p class="error-tag">{{ $errors->first('status') }}</p> 
                       @endif
                  </div>
                 
                </div>                 
                <!-- /.box-body -->
                <div class="form-group">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1" class="control-label col-sm-3"></label>
                  <div class="col-sm-8">
                  <button type="submit" class="btn btn-info" id="submitBtn">Submit</button>&nbsp;&nbsp;
                  <a href="{{url('admin/payouts')}}" class="btn btn-danger">Cancel</a>
                </div>
              </div>
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

@push('scripts')
<script type="text/javascript">
  
  $('#edit_payout').validate({
            rules: {
               amount: { 
                        required:true,
                        digits:true
                    }
             
                }
          });
</script>      


     
</script>
@endpush