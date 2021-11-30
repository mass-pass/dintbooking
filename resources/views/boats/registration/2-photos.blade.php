<div>
<h3>Pictures</h3>
<hr>
<form  action="{{url('/photo-upload')}}" class="dropzone" id="DropzoneElement">{{ csrf_field() }}
<div class="dz-message needsclick">
    <i class="fas fa-cloud-upload-alt text-center display-2 d-block mb-4"></i>
    <h4 class="mb-0 text-center">DRAG YOUR PICTURES HERE </h4>
    <span class="fs-14 text-center">MINIMUM SIZW: 400px x 400px</span>
    </div>
</form>
</div>
<div>
<div class="row">
<template v-for="(image, idx) in images">
    <div class="col-md-6 mt-5">
        <div class="room-image-container200" :style="{backgroundImage:'url(${image.url})'}"> 
            <a v-if="image.cover_photo == 0" class="photo-delete text-right" href="javascript:void(0)" @click="deletePhoto(image)"><p class="photo-delete-icon"><i class="fa fa-trash text-danger p-4"></i></p></a>
        </div>

        <div class="row mt-5">
            <div class="col-md-12 pl-4 pr-4 pr-sm-0 pl-sm-0">
                <textarea class="form-control text-16 photo-highlights" placeholder="{{trans('messages.listing_description.what_are_the_highlight')}}" v-model="image.message"></textarea>
            </div>

            <div class="col-md-6 pl-4 pr-4 pr-sm-0 pl-sm-0 mt-4">
                <label for="sel1">{{trans('messages.listing_description.serial')}}</label>
                <input type="text"  class="form-control text-16 serial" name="serial" v-model="image.serial">
            </div>

            <div class="col-md-6 pl-4 pr-4  pr-sm-0 mt-4">
                <label for="sel1">{{trans('messages.listing_description.cover_photo')}}</label>
                <select @change="resetCover(image.id)" class="form-control photoId text-16" id="photoId" v-model="image.cover_photo">
                    <option value="1">{{trans('messages.listing_description.yes')}}</option>
                    <option value="0">{{trans('messages.listing_description.no')}}</option>
                </select>
            </div>
        </div>
        <div v-if="idx % 3 == 0" style="clear:both;">&nbsp;</div>
    </div>

</template>
</div>
</div>
<hr/><br/>

<div class="text-right">
    <a class="btn thme-btn  px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
    <a class="btn thme-btn  px-5" v-on:click="saveImages();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
</div>

