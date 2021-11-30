<div class="mt-5">
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
<div class="text-right">
<a class="btn thme-btn w-100 px-5" v-on:click="save();" href="javascript:void(0)"> Save</a>
</div>
