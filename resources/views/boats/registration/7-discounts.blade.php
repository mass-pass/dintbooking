<div>
    <h3 class="mb-4">Standard discounts</h3>
    <hr>
    <div class="row">
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">First booking discount</h3>
                <p class="fs-14">This discount is only valid on the first booking made by a renter on your boat</p>
                <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#modalFirstBookingDiscount" href="#">Add </a>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">Early-bird discount</h3>
                <p class="fs-14">Encourage renters to book your boat early in the season</p>
                <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#modalEarlyBirdDiscount" href="#">Add </a>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">Last-minute booking</h3>
                <p class="fs-14">Entice renters who books at the last minute</p>
                <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#modalLastMinuteDiscount" href="#">Add </a>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    <h3 class="mb-4">Length-of-stay-discounts</h3>
    <hr> 
    <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#modalLengthOfStayDiscount" href="#">Add a length-of-stay-discount </a>
</div>
<div class="row" v-if="discounts.length > 0">
    <div class="col-lg-12">
    <h3 class="mb-4">Applicable Discounts</h3>
    <hr> 
        <table class="table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Percentage</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <template v-for="the_discount in discounts">
                    <tr>
                        <td>@{{ the_discount.type }}</td>
                        <td>@{{ the_discount.percentage }}</td>
                        <td><a href="javascript:void(0)" @click="deleteDiscount(the_discount)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-right">
            <a class="btn thme-btn px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>


<div class="modal fade" id="modalFirstBookingDiscount" tabindex="-1" role="dialog" aria-labelledby="modalFirstBookingDiscount" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered discounts-modal">
        <div class="modal-content">
            <div class="modal-header border-0 text-left d-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body boat-form">
                <h3 class="modal-title mb-0" id="myModalLabel">First booking discount</h3>
                <p class="fs-14">Offer a discount to the first renter who will book your boat</p>
                <hr class="my-5">
                <h4 class="text-uppercase mb-0">Selected discount </h4>
                <template v-for="val in ['5','10','15','20']">
                <div class="form-group mt-4">
                    <p><input type="radio" v-model="discount_first_booking.percentage" name="discount_first_booking_percentage" :value="val" class="mr-2">@{{ val }}%</p>
                </div>
                <hr>
                </template>
                <div class="form-group mt-4">
                    <div class="mt-4"><input type="checkbox" id="traveling" name="traveling" value="traveling">
                        <label for="traveling"> Apply to my other boats</label>
                    </div>
                </div>
            </div>
            <div class="p-2 d-flex">
                <button type="button" data-dismiss="modal" class="btn thme-btn w-100 mr-2">Cancel </button>
                <button type="button" @click="addDiscount(discount_first_booking)" class="btn-thme-border w-100">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalEarlyBirdDiscount" tabindex="-1" role="dialog" aria-labelledby="modalEarlyBirdDiscount" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered discounts-modal">
        <div class="modal-content">
            <div class="modal-header border-0 text-left d-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body boat-form">
                <h3 class="modal-title mb-0" id="myModalLabel">Early Bird Discount</h3>
                <p class="fs-14">Offer a discount to the first renter who will book your boat</p>
                <hr class="my-5">
                <h4 class="text-uppercase mb-0">Selected discount </h4>
                <template v-for="val in ['5','10','15','20']">
                    <div class="form-group mt-4">
                        <p><input type="radio" v-model="discount_early_bird.percentage" name="discount_early_bird_percentage" :value="val" class="mr-2">@{{ val }}%</p>
                    </div>
                    <hr>
                </template>
                <div class="form-group mt-4">
                    <div class="mt-4"><input type="checkbox" id="traveling" name="traveling" value="traveling">
                        <label for="traveling"> Apply to my other boats</label>
                    </div>
                </div>
            </div>
            <div class="p-2 d-flex">
                <button type="button" data-dismiss="modal" class="btn thme-btn w-100 mr-2">Cancel </button>
                <button type="button" @click="addDiscount(discount_early_bird)" class="btn-thme-border w-100">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalLastMinuteDiscount" tabindex="-1" role="dialog" aria-labelledby="modalLastMinuteDiscount" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered discounts-modal">
        <div class="modal-content">
            <div class="modal-header border-0 text-left d-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body boat-form">
                <h3 class="modal-title mb-0" id="myModalLabel">Last-minute booking</h3>
                <p class="fs-14">Entice renters who book at the last minute</p>
                <hr class="my-5">
                <div class="form-group mt-5">
                    <label class="text-uppercase">Last minute booking window </label>
                    <select class="form-control basic-select" v-model="discount_last_minute.applicable_meta.days_before">
                        <template v-for="index in 3">
                            <option :value="index">@{{ index }} day before booking</option>
                        </template>
                    </select>
                </div>
                <div class="form-group mt-4">
                    <label class="text-uppercase">Minimum rental duration </label>
                    <select class="form-control basic-select" v-model="discount_last_minute.applicable_meta.length">
                        <template v-for="index in 3">
                            <option :value="index">@{{ index }} day(s) or more</option>
                        </template>
                    </select>
                </div>
                <div class="form-group mt-4">
                    <label for="basic-url">Length</label>
                    <div class="input-group w-25">
                        <input type="text" class="form-control" v-model="discount_last_minute.percentage" />
                        <div class="input-group-append">
                            <span class="input-group-text fs-14 px-4" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-4">
                    <div class="mt-4"><input type="checkbox" id="traveling" name="traveling" value="traveling">
                        <label for="traveling"> Apply to my other boats</label>
                    </div>
                </div>
            </div>
            <div class="p-2 d-flex">
                <button type="button" data-dismiss="modal"   class="btn thme-btn w-100 mr-2">Cancel </button>
                <a class="btn thme-btn w-100 px-5" @click="addDiscount(discount_last_minute);" href="javascript:void(0)"> Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalLengthOfStayDiscount" tabindex="-1" role="dialog" aria-labelledby="modalLengthOfStayDiscount" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered discounts-modal">
        <div class="modal-content">
            <div class="modal-header border-0 text-left d-block">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body boat-form">
                <h3 class="modal-title mb-0" id="myModalLabel">Length of Stay Discount</h3>
                <p class="fs-14">Offer a discount to long term stays</p>
                <hr class="my-5">
                <h4 class="text-uppercase mb-0">Selected discount </h4>
                <template v-for="val in ['5', '10', '15', '20']">
                    <div class="form-group mt-4">
                        <p><input type="radio" v-model="discount_length.percentage" name="discount_length_percentage" :value="val" class="mr-2">@{{ val }}%</p>
                    </div>
                    <hr>
                </template>
                <template v-for="val in ['7', '15', '30', '30+']">
                    <div class="form-group mt-4">
                        <p><input type="radio" v-model="discount_length.applicable_meta.length" name="discount_length_meta_length" :value="val" class="mr-2">@{{ val }} days</p>
                    </div>
                    <hr>
                </template>
                <div class="form-group mt-4">
                    <div class="mt-4"><input type="checkbox" id="traveling" name="traveling" value="traveling">
                        <label for="traveling"> Apply to my other boats</label>
                    </div>
                </div>
            </div>
            <div class="p-2 d-flex">
                <button type="button" data-dismiss="modal"  class="btn thme-btn w-100 mr-2">Cancel </button>
                <button type="button" @click="addDiscount(discount_length)" class="btn-thme-border w-100" >Save</button>
            </div>
        </div>
    </div>
</div>
