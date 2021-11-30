@extends('layouts.master')

@section('main')
<link href="/css/dropzone.min.css" rel="stylesheet">

<style type="text/css">

.inputDnD .form-control-file {
position: relative;
width: 100%;
height: 100%;
min-height: 6em;
outline: none;
visibility: hidden;
cursor: pointer;
background-color: #c61c23;
box-shadow: 0 0 5px solid black !important;
}
.inputDnD .form-control-file:before {
content: attr(data-title);
position: absolute;
top: 0.5em;
left: 0;
width: 100%;
min-height: 6em;
line-height: 2em;
padding-top: 1.5em;
opacity: 1;
visibility: visible;
text-align: center;
border: 0.25em dashed black;
transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
overflow: hidden;
}
.inputDnD .form-control-file:hover:before {
border-style: solid;
box-shadow: inset 0px 0px 0px 0.25em black;
}
</style>

<div class="margin-top-85">
    <div class="row m-0">
        <!-- sidebar start-->
        @include('users.sidebar')
        <!--sidebar end-->
        <div class="col-lg-10 p-0">
            <div class="container-fluid min-height">
                <div class="col-md-12 mt-5">
                    <div class="main-panel">
                        @include('users.profile_nav')

                        <!--Success Message -->
                        @if(Session::has('message'))
                            <div class="row pl-5 pr-5 mt-5">
                                <div class="col-md-12  alert {{ Session::get('alert-class') }} alert-dismissable fade in top-message-text opacity-1">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ Session::get('message') }}
                                </div>
                            </div>
                        @endif 
                        
                        <div class="row mt-5 border pt-4 pb-4 rounded">
                            <div class="col-md-3">
                                <div class="profile-photo-sec border">
                                    @if($result->profile_image)
                                    
                                        <img width="200" height="200" title="{{ Auth::user()->first_name }}" src="{{  s3UrlAppend('images/profile').'/'.Auth::user()->id.'/'.$result->profile_image }}" alt="{{ $result->first_name }}" class="mask-img">
                                        <a class="profile-photo-delete" href="javascript:void(0)" data-url="{{ url('/') }}/users/profile/photo_delete" data-photo="{{ $result->profile_image }}"><i class="far fa-trash-alt"></i></a>
                                        <i class="spinner fa fa-spinner fa-spin profile-delete-spinner d-none"></i>
                                    @elseif(file_exists(public_path('images/profile').'/'.Auth::user()->id.'/'.basename(Auth::user()->profile_src)))
                                        <img width="200" height="200" title="{{ Auth::user()->first_name }}" src="{{  \Auth::user()->profile_src }}" alt="{{ $result->first_name }}" class="circle-avatar">
                                    @else
                                        <img width="200" height="200" title="{{ Auth::user()->first_name }}" src="{{ url('images/default-profile.png') }}" alt="{{ $result->first_name }}" class="circle-avatar">
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9 align-self-center">

                                @if(!empty(Auth::user()->profile_images))
                                    <div id="old_profile_img_sec">
                                        @foreach(Auth::user()->profile_images as $old_img)
                                            <img width="50" height="50" src="{{  s3UrlAppend('images/profile').'/'.Auth::user()->id.'/'.$old_img }}" class="circle-avatar mx-2 my-2">
                                        @endforeach
                                    </div>
                                @endif
                                
                                <p class="text-16 my-3">{{trans('messages.users_media.photo_data')}}</p>
                                <form  action="{{ url('/') }}/users/profile/photo_upload" class="dropzone" id="DropzoneElement">{{ csrf_field() }}</form>

                                <form style="display:none;" name="ajax_upload" method="post" id="ajax_upload" enctype="multipart/form-data" action="{{ url('/') }}/users/profile/photo_upload" accept-charset="UTF-8" >
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12 p-0">
                                            <input type="file" name="photos[]" id="profile_image">
                                            <button type="button" name="btn" id="file_upload_btn" class="btn form-control vbtn-outline-success text-14 font-weight-700 pl-4 pr-4 pt-3 pb-3 mr-2 mt-3">{{trans('messages.users_media.file_upload')}}</button>
                                        </div>
                                    </div>
                                    
                                    <iframe class="d-none" name="upload_frame" id="upload_frame"></iframe>
                                </form>
                            </div>
                        </div>       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ url('js/jquery.validate.min.js') }}"></script>
<script src="{{ url('js/additional-method.min.js') }}"></script>
<script src="/js/dropzone.min.js"></script>
<script type="text/javascript">

Dropzone.autoDiscover = false;
    $(function(){

      var myDropzone = new Dropzone("form#DropzoneElement", {  url: "{{ url('/') }}/users/profile/photo_upload" });
      console.log({dd:myDropzone});
      myDropzone.on("queuecomplete", function(file, res) {
		location.reload();
      });
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '#file_upload_btn', function() {
            $('#profile_image').trigger('click'); 
        });

        $('#ajax_upload').validate({
            rules: {
                'photos[]': {
                    accept: "image/jpg,image/jpeg,image/png,image/gif"
                }
            },
            messages: {
            'photos[]': {
                    accept: "{{ __('messages.jquery_validation.image_accept') }}",
                    }
            },
            errorElement : 'div',
            errorLabelContainer: '.errorTxt_p'
        });
    });
</script>  

<script type="text/javascript">
    $(document).on('change', '#profile_image', function(){
        $('#ajax_upload').submit();
    });

    $(document).on('click', '.profile-photo-delete', function() {
        var url = $(this).data('url');
        var photo = $(this).data('photo');

        if(url != '') {

            $('.profile-delete-spinner').removeClass('d-none');
            $('.profile-photo-delete').addClass('d-none');
            $('.mask-img').addClass('processing-layer');

            $.ajax({
                url: url,
                data: {'photo': photo, '_token': '{{ csrf_token() }}'},
                type: 'post',
                dataType: 'json',
                success: function (result) {
                    console.log(result);
                    if(result.success){
                        window.location.href = "{{ url('/') }}/users/profile/media";
                    }
                },
                error: function (request, error) {
                    // This callback function will trigger on unsuccessful action
                    console.log(error);
                }
            });
        }
    });

</script>
@endpush
@stop
