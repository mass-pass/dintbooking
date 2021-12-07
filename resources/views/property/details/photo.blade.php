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

    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location </a></li>
            <li><a data-toggle="tab" href="#property-setup">Property Setup</a></li>
            <li><a data-toggle="tab" href="#photos" class="active">Photos<div><span class="fil-success"></span></div></a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="name-and-location" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">What does your place look like?</h3>
                    </div>
                    <div class="col-lg-6">
                    <form  action="{{url('listing/'.$property->id.'/photo-upload')}}" class="dropzone" id="DropzoneElement">{{ csrf_field() }}</form>
                    <div >
                        <div id="photo-list-div" class=" p-0">
                            <?php
                            $serial = 0;
                            ?>
                            <div class="row">
                                @foreach($property_photo as $photo)
                                    <?php
                                        $serial++;
                                    ?>

                                    <div class="col-md-6 mt-5" id="photo-div-{{$photo->id}}">
                                        <div class="room-image-container200" style="background-image:url({{ s3Url($photo) }});"> 
                                            @if($photo->cover_photo == 0)
                                                <a class="photo-delete text-right" href="javascript:void(0)" data-rel="{{$photo->id}}"><p class="photo-delete-icon"><i class="fa fa-trash text-danger p-4"></i></p></a>
                                            @endif
                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-md-12 pl-4 pr-4 pr-sm-0 pl-sm-0">
                                                <textarea data-rel="{{$photo->id}}" class="form-control text-16 photo-highlights" placeholder="{{trans('messages.listing_description.what_are_the_highlight')}}">{{$photo->message}}</textarea>
                                            </div>

                                            <div class="col-md-6 pl-4 pr-4 pr-sm-0 pl-sm-0 mt-4">
                                                <label for="sel1">{{trans('messages.listing_description.serial')}}</label>
                                                <input type="text" image_id="{{$photo->id}}" property_id = "{{$property->id}}" id="serial-{{$photo->id}}" class="form-control text-16 serial" name="serial" value="{{$photo->serial}}">
                                            </div>

                                            <div class="col-md-6 pl-4 pr-4  pr-sm-0 mt-4">
                                                @if($photo->cover_photo == 0)
                                                    <label for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
                                                    <select class="form-control photoId text-16" id="photoId">
                                                        <option value="Yes" <?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$property->id}}">{{trans('messages.listing_description.yes')}}</option>
                                                        <option value="No" <?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$property->id}}">{{trans('messages.listing_description.no')}}</option>
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
                        </div>

                        <div class="col-md-12">
                            <span class="text-danger display-off ml-3" id='photo'>{{ trans('messages.reviews.this_field_is_required') }} </span>
                        </div>
                    </div>

                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.photo',$property->id)}}">
                            @csrf
                            <div style="display:none" class="place-section-right hidden">
                                <p class="mt-3"><strong>Add at least one photo.</strong> You can always add more later
                                </p>
                                <a href="javascript:void(0);" class="thme-btn-border mr-3 w-100">Take a photo or select from gallery</a>
                                <p class="text-center mt-5 mb-3"><i class="fas fa-images mr-2"></i>import photos from your airbnb listing</p>
                                <div class="place-section-right-img">
                               <span>
                                  <i class="fas fa-camera"></i>
                               </span>

                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment mt-2">
                                <a href="{{route('partner.property.details.rule',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" id="btn-continue" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>



                    </div>
                    <div class="col-lg-3">
                        <div class="place-section-left d-flex">
                            <div class="mr-3"><i class="far fa-lightbulb-on"></i></div>
                            <span class="close-icon"><i class="fal fa-times"></i></span>
                            <div class="">
                                <h4>What should i consider when choosing name?</h4>
                                <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
                                <p><a href="javascript:void(0);"><strong>Lorem ipsum dolor sit</strong></a></p>
                                <p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
<script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
		<script src="{{ url('js/sweetalert.min.js') }}"></script>

<script src="/js/loadingoverlay.min.js"></script>
		<script src="/js/dropzone.min.js"></script>

<script type="text/javascript">
    var propertyID = {{ $property->id }};
    Dropzone.autoDiscover = false;
    
    $(function(){
        var myDropzone = new Dropzone("form#DropzoneElement", 
        {  
            url: "{{ url('listing/'.$property->id.'/photo-upload') }}",
            sending: function(file, xhr, formData) {
                formData.append("property_id", propertyID); //name and value
            },
        });
        myDropzone.on("queuecomplete", function(file, res) {
            $.ajax({
                url: '/listing/<?php echo $property->id;?>/photo-selectables',
                data: {'property_id':<?php echo $property->id;?>, '_token': '{{ csrf_token() }}'},
                type: 'post',
                dataType: 'json',
                success: function (result) {
                    console.log(result);
                    $('#photo-list-div').html(result.html);
                },
                error: function (request, error) {
                }
            });
        });

        $(document).on('click', '.photo-delete', function(e){
            var gl_photo_id = $(this).attr('data-rel');
            event.preventDefault();
            swal({
                title: "{{trans('messages.modal.are_you_sure')}}",
                text: "{{trans('messages.modal.delete_message')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "{{trans('messages.search.cancel')}}",
                        value: null,
                        visible: true,
                        className: "btn btn-outline-danger text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5",
                        closeModal: true,
                    },
                    confirm: {
                        text: "{{trans('messages.modal.ok')}}",
                        value: true,
                        visible: true,
                        className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
                        closeModal: true
                    }
                },
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var dataURL  = '{{url("listing/$property->id/photo_delete")}}';
                    var photo_id = gl_photo_id;
                    page_loader_start();
                    $.ajax({
                        url: dataURL,
                        data: {'photo_id':photo_id, '_token': '{{ csrf_token() }}'},
                        type: 'post',
                        dataType: 'json',
                        success: function (result) {
                            if(result.success){
                                $('#photo-div-'+photo_id).remove();
                                swal({
                                    icon: "success",
                                    buttons: {
                                        confirm: {
                                            text: "Deleted!",
                                            value: true,
                                            visible: true,
                                            className: "btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5",
                                            closeModal: true
                                        }
                                    },
                                });
                            }
                        },
                        error: function (request, error) {
                            console.log(error);
                            }
                    });
                    page_loader_stop();
                }
            });
        });

        $(document).on('change', '#photoId', function(ev){
            var dataURL      = '{{url("listing/photo/make_default_photo")}}';
            var option_value = $(this).val();
            var photo_id     = $('option:selected', this).attr('image_id');
            var property_id  = $('option:selected', this).attr('property_id'); 
            page_loader_start();
            $.ajax({
                url: dataURL,
                data: {'photo_id':photo_id, 'property_id':property_id, 'option_value':option_value, '_token': '{{ csrf_token() }}'},
                type: 'post',
                dataType: 'json',
                success: function (result) {
                location.reload();
                }
            });
            page_loader_stop();
        });

        $(document).on('change', '.serial', function(ev){
            var dataURL = '{{url("listing/photo/make_photo_serial")}}';
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

    });

    function page_loader_start(){
				$('body').prepend('<div id="preloader"></div>');
			}

			function page_loader_stop(){
				$('#preloader').fadeOut('slow',function(){$(this).remove();});
			}

    </script>

    <script  type="text/javascript">
        {{--$(document).ready(function () {--}}
        {{--    $("#locationForm").validate({--}}
        {{--        rules: {--}}
        {{--            address_line_2: "required",--}}
        {{--            city: "required",--}}
        {{--            postal_code: "required",--}}
        {{--            state: "required",--}}
        {{--        },--}}
        {{--        messages: {--}}
        {{--            address_line_2: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            city: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            postal_code: "{{ __('messages.jquery_validation.required') }}",--}}
        {{--            state: "{{ __('messages.jquery_validation.required') }}"--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endpush
