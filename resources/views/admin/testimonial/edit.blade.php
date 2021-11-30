@extends('admin.template')

@section('main')

     

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Testimonial
      <small>Add Testimonial</small>
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
            <form class="form-horizontal" action="{{url('admin/edit-testimonials')}}/{{$result->id}}" id="edit_testimonials" method="post" name="edit_testimonials" accept-charset='UTF-8' enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                               
                              {{csrf_field()}}
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Name<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" id="name" value="{{ $result->name }}" placeholder="Enter Reviewer Name..">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif 
                                  </div>
                                   
                                  <div>
                                   
                                  </div>
                                  
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Designation<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" name="designation" id="designation" placeholder="Reviewer Designation.." value="{{ $result->designation }}">
                                    @if ($errors->has('designation'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div>
                                    
                                  </div>
                                 
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Description<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <textarea name="description" id="description" class="form-control error" placeholder="Description..">{{ $result->description }}</textarea>
                                    @if ($errors->has('description'))
                                      <span class="help-block">
                                          <strong class="text-danger">{{ $errors->first('description') }}</strong>
                                      </span>
                                    @endif  
                                  </div>
                                  <div>
                                    
                                  </div>
                                   

                              </div>

                               <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Image<span class="text-danger">*</span></label>
                                  <div class="col-sm-8">
                                    <input type="file" class="form-control error" name="image" id="image" placeholder="" >  
                                    <img src="{{url('/front/images/testimonial/'.$result->image)}}" height="80px;" width="80px;">

                                    
                                    @if ($errors->has('image'))
                                      <span class="help-block">
                                          <strong class="text-danger">{{ $errors->first('image') }}</strong>
                                      </span>
                                    @endif 
                                  </div>
                              </div>


                              <div class="form-group">
                                  <label for="exampleInputPassword1" class="control-label col-sm-3">Rating<span class="yellow-color">*</span></label>
                                  <input type="hidden" name="rating_1" id="rating" value="{{ $result->review }}">
                                  <div class="col-sm-8">
                                    @for($i=1; $i <=5 ; $i++)
                                      <i id="rating-{{$i}}" class="icon icon-star {{ $i <= $result->review ? 'icon-beach':'icon-light-gray' }} icon-click"></i> 
                                    @endfor
                                    @if ($errors->has('rating_1'))
                                      <span class="help-block">
                                          <strong class="text-danger">{{ $errors->first('rating_1') }}</strong>
                                      </span>
                                    @endif 
                                  </div>

                              </div>

                              <div class="form-group">
                                <label for="exampleInputPassword1" class="control-label col-sm-3">Status</label>
                                <div class="col-sm-8">
                                  <select class="form-control" name="status" id="status">
                                    <option value="Active" {{ ($result->status == 'Active') ? 'selected' : '' }} >Active</option>
                                    <option value="Inactive" {{ ($result->status == 'Inactive') ? 'selected' : '' }}>Inactive</option>
                                  </select>
                                </div>
                              </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info" id="submitBtn">Submit</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
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
      $('.icon-click').on('click', function(){
        var temp = $(this).attr('id');
        temp     = temp.split('-');
        var name = temp[0];
        var val  = temp[1];
        var prv  = $('#'+name).val();
        $('#'+name).val(val);
        $('#rating_1').val(val);
        for(i = 1; i <= prv; i++){
          $('#'+name+'-'+i).removeClass('icon-beach');
          $('#'+name+'-'+i).addClass('icon-light-gray');
        }
        for(i = 1; i <= val; i++){
          $('#'+name+'-'+i).removeClass('icon-light-gray');
          $('#'+name+'-'+i).addClass('icon-beach');
        }
      })

      jQuery.validator.addMethod("laxEmail", function(value, element) {
            return this.optional( element ) || /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test( value );
          }, "{{ __('messages.jquery_validation.email') }}" );

</script>


@endpush