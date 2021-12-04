<?php
$serial = 0;
?>
<div class="row">
@if ($s3_path != '')
    <?php $path = $s3_path; ?>
@else
    <?php $path = env('S3_BUCKET_PATH'); ?>
@endif
@foreach($photos as $photo)
<?php
    $serial++;
?>

<div class="col-md-6 mt-5" id="photo-div-{{$photo->id}}">
    <div class="room-image-container200 tep" style="background-image:url({{ s3PropertyUrl($photo, $path) }});"> 
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
            <input type="text" image_id="{{$photo->id}}" property_id = "{{$result->id}}" id="serial-{{$photo->id}}" class="form-control text-16 serial" name="serial" value="{{$photo->serial}}">
        </div>

        <div class="col-md-6 pl-4 pr-4  pr-sm-0 mt-4">
            @if($photo->cover_photo == 0)
                <label for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
                <select class="form-control photoId text-16" id="photoId">
                    <option value="Yes" <?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">{{trans('messages.listing_description.yes')}}</option>
                    <option value="No" <?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">{{trans('messages.listing_description.no')}}</option>
                </select>
            @endif
        </div>
    </div>

    {{-- <div class="row mt-4">
        <div class="col-md-6 col-xs-12 p-0">
            @if($photo->cover_photo == 0)
                <label for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
                <select class="form-control photoId text-16" id="photoId">
                    <option value="Yes" <?= ($photo->cover_photo == 1 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">{{trans('messages.listing_description.yes')}}</option>
                    <option value="No" <?= ($photo->cover_photo == 0 ) ? 'selected' : '' ?> image_id="{{$photo->id}}" property_id = "{{$result->id}}">{{trans('messages.listing_description.no')}}</option>
                </select>
            @endif
        </div>
    </div> --}}

    @if($serial % 3 == 0)
        <div style="clear:both;">&nbsp;</div>
    @endif
</div>
@endforeach

