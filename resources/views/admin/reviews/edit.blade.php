@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-md-8 col-sm-offset-2">
          <!-- Horizontal Form -->
          <div class="box box-info box_info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Review Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="rev_form" action="{{url('admin/edit_review')}}/{{$result->id}}" method="post">
            {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="booking_id" class="col-sm-3 control-label">Booking Id</label>
                  <div class="col-sm-6">
                    <p>{{$result->booking_id}}</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="property_name" class="col-sm-3 control-label">Property Name</label>
                  <div class="col-sm-6">
                    <p>{{$result->property_name}}</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="sender" class="col-sm-3 control-label">Guest</label>
                  <div class="col-sm-6">
                    <p>{{$result->sender}}</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="receiver" class="col-sm-3 control-label">Host</label>
                  <div class="col-sm-6">
                    <p>{{$result->receiver}}</p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="reviewer" class="col-sm-3 control-label">Reviewed By</label>
                  <div class="col-sm-6">
                    <p>{{$result->reviewer}}</p>
                  </div>
                </div>
            
                @if($result->reviewer == 'guest')
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Rating</label>
                  <div class="col-sm-6">
                    <input type="number" name="rating" min="1" max="5" class="form-control" value="{{$result->rating}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Accuracy</label>
                  <div class="col-sm-6">
                    <input type="number" name="accuracy" min="1" max="5" class="form-control" value="{{$result->accuracy}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Location</label>
                  <div class="col-sm-6">
                    <input type="number" name="location" min="1" max="5" class="form-control" value="{{$result->location}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Communication
                 </label>
                  <div class="col-sm-6">
                    <input type="number" name="communication" min="1" max="5" class="form-control" value="{{$result->communication}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Check In</label>
                  <div class="col-sm-6">
                    <input type="number" name="checkin" min="1" max="5" class="form-control" value="{{$result->checkin}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Cleanliness</label>
                  <div class="col-sm-6">
                    <input type="number" name="cleanliness" min="1" max="5" class="form-control" value="{{$result->cleanliness}}" />
                  </div>
                </div><br><br>
                   <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Value</label>
                  <div class="col-sm-6">
                    <input type="number" name="value" min="1" max="5" class="form-control" value="{{$result->value}}" />
                  </div>
                </div><br><br>
                @endif
           
                <div class="clearfix"></div>
                <div class="form-group">
                  <label for="message" class="col-sm-3 control-label">Message<em class="text-danger">*</em></label>
                  <div class="col-sm-6">
                    <textarea name="message" class="form-control">{{$result->message}}</textarea>
                    <span class="text-danger">{{ $errors->first('message') }}</span>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info btn-space" name="submit" value="submit">Submit</button>
                <button type="submit" class="btn btn-danger" name="cancel" value="cancel">Cancel</button>
             
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @push('scripts')
<script>
  $('#input_dob').datepicker({ 'format': 'dd-mm-yyyy'});

  $(document).ready(function () {

            $('#rev_form').validate({
                rules: {
                    message: {
                        required: true
                    }
                 
                }
            });

        });
</script>
@endpush
@stop


