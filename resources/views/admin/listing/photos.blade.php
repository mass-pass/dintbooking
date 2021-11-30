@extends('admin.template')
@section('main')
<link href="/css/dropzone.min.css" rel="stylesheet">
  <div class="content-wrapper">
      <section class="content-header">
              <h1>
              Photos
              <small>Photos</small>
            </h1>
            <ol class="breadcrumb">
        <li><a href="{{url('/')}}/admin/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>
      <section class="content">
      <div class="row">
        <div class="col-md-3 settings_bar_gap">
          @include('admin.common.property_bar')
        </div>

        <div class="col-md-9">
          <div class="box box-info">
          <div class="box-body">        
          <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">

              <div class="col-md-12">
              <div class="alert alert-info text-left">
                  <i class="fa fa-info-circle"></i> Properties must have atleast 4 photos in order to be listed
              </div>

          <form  action="{{url('admin/listing/'.$result->id.'/photo-upload')}}" class="dropzone"
          id="DropzoneElement">{{ csrf_field() }}</form>
              </div></div></div></div>
          <form id="img_form" style="display:none;" enctype='multipart/form-data' method="post" action="{{url('admin/listing/'.$result->id.'/'.$step)}}" class='signup-form login-form' accept-charset='UTF-8'>
            {{ csrf_field() }}
            <div class="col-md-12">


            <div class="panel panel-default">
              <div class="panel-body">
                <div class="row">

              <div class="col-md-6">
                @if(session('success'))
                   <div class="alert alert-success text-center text-success">{{ session('success') }}</div>
                @endif

                <div class="form-group inputDnD"> 
        <label class="sr-only" for="inputFile">File Upload</label>
        <input class="field form-control-file" id="photo_file" name="photos[]" type="file" multiple=""  accept="image/*" data-ref="files-list" onchange="readUrl(this)" data-title="Drag and drop a file">

      </div>

                <p id="files-list"></p>
                <p class="text-13">( Width:640px and Height:360px )</p>
                @if ($errors->any())     
                  <span class="text-center text-danger">{{$errors->first()}}</span>
                @endif
              </div>
              <div class="col-md-12">
                <button type="submit" id="upload_photos_button" class="btn btn-large btn-primary next-section-button">
                  {{trans('messages.listing_description.upload')}}
                </button>
              </div>

            </div>
          </div>
        </div>

            </div>
            <br>
            <br>
          </form>

          <div class="row">
            <div id="photo-list-div" class="col-md-12 l-pad-none min-height-div">

            <?php
              $serial = 0;
            ?>

              @foreach($photos as $photo)

            <?php
              $serial++;
            ?>

                <div class="col-md-4 margin-top10" id="photo-div-{{$photo->id}}">
                  <div class="room-image-container200" style="background-image:url({{ s3Url($photo) }});">
                    @if($photo->cover_photo == 0)
                    <a class="photo-delete" href="javascript:void(0)" data-rel="{{$photo->id}}"><p class="photo-delete-icon"><i class="fa fa-trash-o"></i></p></a>
                    @endif
                  </div>
                  <div class="margin-top5">
                    <textarea data-rel="{{$photo->id}}" class="form-control photo-highlights" placeholder="What are the highlights of this photo?">{{$photo->message}}</textarea>
                  </div>


                <div class="row">
                    <div class="col-md-6">
                  <label for="sel1">Serial</label>
                  <input type="text" image_id="{{$photo->id}}" property_id = "{{$result->id}}" id="serial-{{$photo->id}}" class="form-control serial" name="serial" value="{{$photo->serial}}">
                </div>
                <div class="col-md-6">
                  @if($photo->cover_photo == 0)
                  <label for="sel1">Cover Photo</label>
                  <select class="form-control photoId" id="photoId">
                    <option value="Yes" <?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">Yes</option>
                    <option value="No" <?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">No</option>
                  </select>
                  @endif
                   </div>
                </div>

                @if($serial % 3 == 0)
                <div style="clear:both;">&nbsp;</div>
                @endif

                </div>
              @endforeach
            </div>
            <div class="col-md-12">
              <span class="text-danger display-off" id='photo'>This field is required 
            </div>
          </div>
          <div class="row">
            <br>

          <div class="col-md-12">
            <div class="col-md-10 col-sm-6 col-xs-6 l-pad-none text-left">
                <a data-prevent-default="" href="{{ url('admin/listing/'.$result->id.'/amenities') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-6 text-right">
              <a href="{{url('admin/listing/'.$result->id.'/pricing')}}" class="btn btn-large btn-primary next-section-button">
               {{trans('messages.listing_basic.next')}} 
              </a>
            </div>
          </div>
          </div>
          </div>
          </div>

        </div>
      </div>
      </section>
  </div>
@push('scripts')
<script src="/js/dropzone.min.js"></script>
  <script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(function(){

      var myDropzone = new Dropzone("form#DropzoneElement", { url: "{{url('admin/listing/'.$result->id.'/photo-upload')}}"});
      console.log({dd:myDropzone});
      myDropzone.on("queuecomplete", function(file, res) {
        $.ajax({
          url: '/admin/listing/<?php echo $result->id;?>/photo-selectables',
          data: {'property_id':<?php echo $result->id;?>, '_token': '{{ csrf_token() }}'},
          type: 'post',
          dataType: 'json',
          success: function (result) {
            $('#photo-list-div').html(result.html);
          },
          error: function (request, error) {
          }
        });
      });
    });


    var gl_photo_id = 0;
    $(document).on('submit', '#photo-form', function(e){
      e.preventDefault();
      $('#photo').hide();
      var dataURL = '{{url("add_photos/$result->id")}}';
      var form_data = new FormData(this);
      var photo_file = $('#photo_file').val();
      if(photo_file != ''){
       // page_loader_start();
        $.ajax({
          url: dataURL,
          data: {
            form_data,
            '_token': '{{ csrf_token() }}'
          },
          type: 'post',
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function (result) {
            if(result.status){
              var photo_url = '{{url("images/rooms/$result->id")}}'+'/'+result.photo_name;
              var photo_div = '<div class="col-md-4 margin-top10" id="photo-div-'+result.photo_id+'">'
                                +'<div class="room-image-container200" style="background-image:url('+photo_url+');">'
                                +'<a class="photo-delete" href="#" data-rel="'+result.photo_id+'"><p class="photo-delete-icon"><i class="fa fa-trash-o"></i></p></a>'
                                +'</div>'
                                +'<div class="margin-top5">'
                                  +'<textarea data-rel="'+result.photo_id+'" class="form-control photo-highlights" placeholder="'+"{{ trans('messages.lys.highlights_photo') }}"+'"></textarea>'
                                +'</div>'
                              +'</div>';
              $('#photo-list-div').append(photo_div);
            }
            else
              $('#photo').show();

          },
          error: function (request, error) {
            // This callback function will trigger on unsuccessful action
            show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
          }
        });
        $('#photo_file').val('');
        page_loader_stop();
      }
    });
    $(document).on('click', '.photo-delete', function(e){
      e.preventDefault();
      gl_photo_id = $(this).attr('data-rel');
      var con = bootbox.confirm('Are you sure you want to delete this?', location_image_upload);
    });
    $(document).on('focusout', '.photo-highlights', function(e){
      var dataURL = '{{url("admin/listing/$result->id/photo_message")}}';
      var photo_id = $(this).attr('data-rel');
      var messages = $(this).val();
      $.ajax({
          url: dataURL,
          data: {'photo_id':photo_id, 'messages':messages,'_token': '{{ csrf_token() }}'},
          type: 'post',
          dataType: 'json',
          success: function (result) {

          },
          error: function (request, error) {
            // This callback function will trigger on unsuccessful action
            show_error_message('Det har oppstått nettverksfeil vennligst prøv igjen');
          }
        });
    })
    
    function location_image_upload(result){
      if(result){
        var dataURL = '{{url("admin/listing/$result->id/photo_delete")}}';
        var photo_id = gl_photo_id;

        //page_loader_start();
        $.ajax({
          url: dataURL,
          data: {'photo_id':photo_id, '_token': '{{ csrf_token() }}'},
          type: 'post',
          dataType: 'json',
          success: function (result) {
            if(result.success){
              $('#photo-div-'+photo_id).remove();
            }
          },
          error: function (request, error) {
            // This callback function will trigger on unsuccessful action
            console.log(error);
          }
        });
        //page_loader_stop();
      }
    }


    $(document).on('change', '.photoId', function(ev){
     // alert('ok');
      var dataURL = '{{url("admin/listing/photo/make_default_photo")}}';
      var option_value = $(this).val();
      var photo_id     = $('option:selected', this).attr('image_id');
      var property_id = $('option:selected', this).attr('property_id'); 
       
      $.ajax({
          url: dataURL,
          data: {'photo_id':photo_id, 'property_id':property_id, 'option_value':option_value, '_token': '{{ csrf_token() }}'},
          type: 'post',
          dataType: 'json',
          success: function (result) {
            location.reload();
          }
        });
       

     });

    $(document).on('change', '.serial', function(ev){
      var dataURL = '{{url("admin/listing/photo/make_photo_serial")}}';
      var serial = $(this).val();
      var id     = $(this).attr('image_id');
      
      $.ajax({
          url: dataURL,
          data: {'id':id, 'serial':serial, '_token': '{{ csrf_token() }}'},
          type: 'post',
          dataType: 'json',
          success: function (result) {
            location.reload();
          }
        });

     });

  </script>
@endpush
@stop

@section('validate_script')
<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>
<script src="{{ asset('js/loadingoverlay.min.js') }}"></script>
<script type="text/javascript">

function readUrl(input) {
  
  if (input.files && input.files[0]) {
    let files_list = [];
    for(i in input.files){
      console.log({f:input.files[i]});
      if(input.files[i].name && (input.files[i].name!='item')){
        files_list.push(input.files[i].name);
      }
    }
    $('#'+$(input).data('ref')).html(files_list.join('<br/>'))
  }

}
  $(document).ready(function () {

            $('#img_form').validate({
                rules: {
                    'photos[]': {
                        required: true,
                        accept: "image/jpg,image/jpeg,image/png,image/gif"
                    }
                },
                messages: {
                    'photos[]': {
                        accept: 'The file must be an image (jpg, jpeg, png or gif)'
                    }
                },
                submitHandler: function(form)
		            {
		                $("#upload_photos_button").on("click", function (e)
		                {	
		                	$("#upload_photos_button").attr("disabled", true);
		                    e.preventDefault();
		                });
                    $.LoadingOverlay("show");

		                return true;
		            },
 
            });

        });
</script>
@endsection