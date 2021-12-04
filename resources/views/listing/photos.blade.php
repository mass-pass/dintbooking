@extends('layouts.master')
@section('main')

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
		<div class="col-md-10">
			<div class="main-panel min-height mt-4">
				<div class="row justify-content-center">
					<div class="col-md-3 pl-4 pr-4">
						@include('listing.sidebar')
					</div>

					<div class="col-md-9 mt-4 mt-sm-0 pl-4 pr-4">

						<div class="row">
							<div class="col-md-12 border mt-4 pb-5 rounded-3 pl-sm-0 pr-sm-0 ">
								<div class="row">
									<div class="form-group col-md-12 main-panelbg pb-3 pt-3 mt-sm-0 ">
										<h4 class="text-18 font-weight-700 pl-3">
											{{trans('messages.listing_sidebar.photos')}}</h4>
									</div>

									<div class="form-group col-md-12">
										<div class="alert alert-info mt-4">
											<i class="fa fa-info-circle"></i> This property must have atleast 4 photos
											in order to be listed
										</div>
										<form action="{{url('listing/'.$result->id.'/photo-upload')}}" class="dropzone"
											id="DropzoneElement">{{ csrf_field() }}</form>



										<form id="img_form" enctype='multipart/form-data' method="post"
											action="{{url('listing/'.$result->id.'/'.$step)}}" accept-charset='UTF-8'>
											{{ csrf_field() }}

											<div class="row">
												<div class="col-md-12 mt-4 p-4 pb-4 pt-4">
													<div class="row">
														<div class="col-md-9">
															@if(session('success'))
															<div class="alert alert-success mt-4">
																<span>{{ session('success') }}</span>
															</div>
															@endif
														</div>
													</div>

													<div class="row">

														<div class="col-md-12">

														</div>

														<div style="display:none;" class="col-md-9">

															<div class="form-group inputDnD">
																<label class="sr-only" for="inputFile">File
																	Upload</label>
																<input class="field form-control-file" id="photo_file"
																	name="photos[]" type="file" multiple=""
																	accept="image/*" data-ref="files-list"
																	onchange="readUrl(this)"
																	data-title="Drag and drop a file">

															</div>

															<p id="files-list"></p>
															<p class="text-13">(Width 640px and Height 360px)</p>

														</div>
														<div style="display:none;" class="col-md-12">
															<button type="submit"
																class="btn btn-large btn-photo text-16" id="up_button">
																<i class="spinner fa fa-spinner fa-spin d-none"
																	id="up_spin"></i>
																<span
																	id="up_button_txt">{{trans('messages.listing_description.upload')}}</span>

															</button>
														</div>
													</div>

													<div class="row">
														<div class="col-md-9">

															@if ($errors->any())
															<div class="alert alert-danger mt-4">
																<span class="text-center">{{$errors->first()}}</span>
															</div>
															@endif
														</div>
													</div>
												</div>
											</div>

											<div class="row">
												<div id="photo-list-div" class="col-md-12 p-0">
													<?php $serial = 0; ?>
													<div class="row">
														@foreach($photos as $photo)
														<?php $serial++; ?>

														<div class="col-md-6 mt-5" id="photo-div-{{$photo->id}}">
															<div class="room-image-container200"
																style="background-image:url({{ s3Url($photo) }});">
																@if($photo->cover_photo == 0)
																<a class="photo-delete text-right"
																	href="javascript:void(0)" data-rel="{{$photo->id}}">
																	<p class="photo-delete-icon"><i
																			class="fa fa-trash text-danger p-4"></i></p>
																</a>
																@endif
															</div>

															<div class="row mt-5">
																<div class="col-md-12 pl-4 pr-4 pr-sm-0 pl-sm-0">
																	<textarea data-rel="{{$photo->id}}"
																		class="form-control text-16 photo-highlights"
																		placeholder="{{trans('messages.listing_description.what_are_the_highlight')}}">{{$photo->message}}</textarea>
																</div>

																<div class="col-md-6 pl-4 pr-4 pr-sm-0 pl-sm-0 mt-4">
																	<label
																		for="sel1">{{trans('messages.listing_description.serial')}}</label>
																	<input type="text" image_id="{{$photo->id}}"
																		property_id="{{$result->id}}"
																		id="serial-{{$photo->id}}"
																		class="form-control text-16 serial"
																		name="serial" value="{{$photo->serial}}">
																</div>

																<div class="col-md-6 pl-4 pr-4  pr-sm-0 mt-4">
																	@if($photo->cover_photo == 0)
																	<label
																		for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
																	<select class="form-control photoId text-16"
																		id="photoId">
																		<option value="Yes"
																			<?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?>
																			image_id="{{$photo->id}}"
																			property_id="{{$result->id}}">
																			{{trans('messages.listing_description.yes')}}
																		</option>
																		<option value="No"
																			<?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?>
																			image_id="{{$photo->id}}"
																			property_id="{{$result->id}}">
																			{{trans('messages.listing_description.no')}}
																		</option>
																	</select>
																	@endif
																</div>
															</div>

															{{-- <div class="row mt-4">
																			<div class="col-md-6 col-xs-12 p-0">
																				@if($photo->cover_photo == 0)
																					<label for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
															<select class="form-control photoId text-16" id="photoId">
																<option value="Yes"
																	<?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?>
																	image_id="{{$photo->id}}"
																	property_id="{{$result->id}}">
																	{{trans('messages.listing_description.yes')}}
																</option>
																<option value="No"
																	<?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?>
																	image_id="{{$photo->id}}"
																	property_id="{{$result->id}}">
																	{{trans('messages.listing_description.no')}}
																</option>
															</select>
															@endif
														</div>
													</div> --}}

													@if($serial % 3 == 0)
													<div style="clear:both;">&nbsp;</div>
													@endif
												</div>
												@endforeach
											</div>
									</div>

									<div class="col-md-12">
										<span class="text-danger display-off ml-3"
											id='photo'>{{ trans('messages.reviews.this_field_is_required') }} </span>
									</div>
								</div>

								<div style="clear:both;"></div>
							</div>

							</form>


						</div>
					</div>
				</div>

				<div class="col-md-12 p-0 mt-4 mb-5">
					<div class="row m-0 justify-content-between">
						<div class="mt-4">
							<a href="{{ url('listing/'.$result->id.'/amenities') }}"
								class="btn btn-outline-danger secondary-text-color-hover text-16 font-weight-700  pt-3 pb-3 pl-5 pr-5">
								{{trans('messages.listing_description.back')}}
							</a>
						</div>

						<div class="mt-4">

							<a href="{{url('listing/'.$result->id.'/pricing')}}"
								class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3 pl-5 pr-5"
								id="btnnext"><i class="spinner fa fa-spinner fa-spin d-none" id="btn_spin"></i>
								<span id="btnnext-text">{{trans('messages.listing_basic.next')}}</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
@stop

@push('scripts')

@if(false)
<script type="text/javascript" src="{{ url('js/bootbox.min.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>

<script type="text/javascript" src="{{ url('js/jquery.validate.min.js') }}"></script>
<script src="{{ url('js/additional-method.min.js') }}"></script>
<script src="/js/loadingoverlay.min.js"></script>
<script src="/js/dropzone.min.js"></script>
@endif

<script type="text/javascript">
	var propertyID = {{ $result->id }};
	Dropzone.autoDiscover = false;

	var loadPhotos = function() {
		setTimeout(function(){
			const url = '/listing/<?php echo $result->id;?>/photo-selectables';
			$.ajax({
				url: url,
				data: {'property_id':<?php echo $result->id;?>, 'photoable_type': 'Property', '_token': '{{ csrf_token() }}'},
				type: 'get',
				dataType: 'json',
				success: function (result) {
					$('#photo-list-div').html(result.html);
				},
				error: function (request, error) {
				}
			});
		}, 1000);
	};

    $(function() {

      	var myDropzone = new Dropzone("form#DropzoneElement", {  
			url: "{{ url('listing/'.$result->id.'/photo-upload') }}",
			sending: function(file, xhr, formData) {
				formData.append("photoable_type", "Property");  //name and value
				formData.append("property_id", propertyID); //name and value
			},
		});
		//console.log({dd:myDropzone});
		myDropzone.on("queuecomplete", function(file, res) {
			loadPhotos();
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
			page_loader_start();
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
				loadPhotos();
				/*
				if(result.status) {
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
				*/

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

	$(document).on('focusout', '.photo-highlights', function(e){
			var dataURL = '{{url("listing/$result->id/photo_message")}}';
			var photo_id = $(this).attr('data-rel');
			var messages = $(this).val();
			$.ajax({
				url: dataURL,
				data: {'photo_id':photo_id, 'messages':messages, '_token': '{{ csrf_token() }}'},
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


	$(document).on('click', '.photo-delete', function(e){
		var gl_photo_id = $(this).attr('data-rel');
		console.log(name);
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
				var dataURL  = '{{url("listing/$result->id/photo_delete")}}';
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
		var photoable_type = 'Property';
		var photo_id     = $('option:selected', this).attr('image_id');
		var property_id  = $('option:selected', this).attr('property_id'); 
		page_loader_start();
		$.ajax({
			url: dataURL,
			data: {'photo_id':photo_id, 'property_id':property_id, 'photoable_type':photoable_type, 'option_value':option_value, '_token': '{{ csrf_token() }}'},
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

	function page_loader_start(){
		$('body').prepend('<div id="preloader"></div>');
	}

	function page_loader_stop(){
		$('#preloader').fadeOut('slow',function(){$(this).remove();});
	}
</script>

<script type="text/javascript">
	$(document).ready(function () {
				$('#img_form').validate({
					rules: {
						'photos[]': {
							required:true,
							accept: "image/jpg,image/jpeg,image/png,image/gif,image/JPG"
						}
					},
					submitHandler: function(form)
		            {
		                $("#up_button").on("click", function (e)
		                {	
		                	$("#up_button").attr("disabled", true);
		                    e.preventDefault();
		                });
		                
		                $("#up_spin").removeClass('d-none');
		                $("#up_button_txt").text("{{trans('messages.listing_description.upload')}}..");
		                return true;
		            },
					messages: {
						'photos[]': {
							accept: "{{ __('messages.jquery_validation.image_accept') }}",
						}
					} 
				});
			});

			$(document).on('click', '#btnnext', function() {
				$(this).addClass('disabled');
		        $("#btn_spin").removeClass('d-none');
		        $("#btnnext-text").text("{{trans('messages.listing_basic.next')}}..");
				
			});
</script>
@endpush