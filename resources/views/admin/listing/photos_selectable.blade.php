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
