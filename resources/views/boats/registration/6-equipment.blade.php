<div>
    <h3 class="mb-4">Equipment</h3>
    <hr>
</div>
<div class="form-row">
    <template v-for="type in amenities">
    <div v-if="type.boat_amenities.length > 0"  class="col-sm-6 mt-5">
        <h4 class="mb-4">@{{ type.name }}</h4>
        <p v-for="amenity in type.boat_amenities"><input type="checkbox" :value="amenity" v-model="boat.amenities"  :true-value="[]"  name="" class="mr-2">@{{ amenity.title }}</p>
    </div>
    </template>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="text-right">
            <a class="btn thme-btn px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>

