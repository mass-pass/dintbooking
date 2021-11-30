<div class="row">
    <div class="col-lg-12">
        <div class="">
        <h3>Your boat</h3>
        <hr>
        <div class="boat-category">
        <h4 class="my-5">TYPE</h4>
        <div class="boat-category-list">
            
            <template v-for="(the_boat_type, slug) in boat_types">
            <div class="boat-col">
                <a :class="{ 'border-primary' : isBoatType(the_boat_type) }" @click="setBoatType(the_boat_type);" class="boat-category-item text-center">
                    <img :src="'/images/boat/' + slug + '.png'"  />
                    <h5>@{{ the_boat_type }}</h5>
                </a>
            </div>
            </template>

            </div>
        </div>
        <form class="row boat-form">
            <div class="col-lg-6">
                <div class="form-group">
                    <label class="text-uppercase">Boat Address</label>
                    <input type="text" v-model="boat.address_line_1" class="form-control" id="address_line_1" name="address_line_1" />
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="text-uppercase">Boat City</label>
                    <input type="text" v-model="boat.city" class="form-control" id="city" name="city" />
                </div>
            </div>
 
            <div class="col-lg-6">
            <div class="form-group">
                <label class="text-uppercase">Are you a professional? </label>
                <select class="form-control basic-select" v-model="boat.is_owner_professional" id="is_owner_professional" name="is_owner_professional">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            </div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <label class="text-uppercase">Manufacturer</label>
                <input type="text" class="form-control"  v-model="boat.manufacturer" placeholder="Manufacturer" id="manufacturer" name="manufacturer" />
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <label class="text-uppercase">Model</label>
                <input type="text" class="form-control"  v-model="boat.model"  placeholder="Model" id="model" name="model" />
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <label class="text-uppercase">Is your boat rented with a captain? </label>
                <select class="form-control basic-select"   v-model="boat.is_rented_with_captain"   id="is_rented_with_captain" name="is_rented_with_captain">
                    <option value="1">With captain</option>
                    <option value="0">Without captain</option>
                </select>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
                <label class="text-uppercase">Boat Name</label>
                <input type="text" class="form-control"  v-model="boat.name" name="name" id="name" />
            </div>
            </div>

            <div class="col-lg-12 text-right">
                <hr/>
                <a class="btn thme-btn  px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>
        </form>
        </div>
    </div>
</div>
