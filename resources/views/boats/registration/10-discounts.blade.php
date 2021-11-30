<div class="mt-5">
    <h3 class="mb-4">Standard discounts</h3>
    <hr>
    <div class="row">
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">First booking discount</h3>
                <p class="fs-14">This discount is only valid on the first booking made by a renter on your boat</p>
                <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#basicModalMyPropertyType1" href="#">Add </a>
                <div class="modal fade" id="basicModalMyPropertyType1" tabindex="-1" role="dialog" aria-labelledby="basicModalMyPropertyType1" aria-hidden="true">
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
                                <div class="form-group mt-4">
                                    <p><input type="radio" name="" class="mr-2">-5%</p>
                                </div>
                                <hr>
                                <div class="form-group mt-4">
                                    <p><input type="radio" name="" class="mr-2">-10%</p>
                                </div>
                                <hr>
                                <div class="form-group mt-4">
                                    <p><input type="radio" name="" class="mr-2">-15%</p>
                                </div>
                                <hr>
                                <div class="form-group mt-4">
                                    <p><input type="radio" name="" class="mr-2">-20%</p>
                                </div>
                                <hr>
                                <div class="form-group mt-4">
                                    <div class="mt-4"><input type="checkbox" id="traveling" name="traveling" value="traveling">
                                        <label for="traveling"> Apply to my other boats</label>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 d-flex">
                                <button type="button" class="btn thme-btn w-100 mr-2">Cancel </button>
                                <button type="button" class="btn-thme-border w-100">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">Early-bird discount</h3>
                <p class="fs-14">Encourage renters to book your boat early in the season</p>
                <a class="thme-btn-border fs-14 rounded mt-4" href="#">Add </a>
            </div>
        </div>
        <div class="col-lg-6 mt-5">
            <div class="shadow-box p-4 rounded">
                <h3 class="mb-2">Last-minute booking</h3>
                <p class="fs-14">Entice renters who books at the last minute</p>
                <a class="thme-btn-border fs-14 rounded mt-4" data-toggle="modal" data-target="#basicModalMyPropertyType3" href="#">Add </a>
                <div class="modal fade" id="basicModalMyPropertyType3" tabindex="-1" role="dialog" aria-labelledby="basicModalMyPropertyType3" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered discounts-modal">
                        <div class="modal-content">
                            <div class="modal-header border-0 text-left d-block">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body boat-form">
                                <h3 class="modal-title mb-0" id="myModalLabel">I Last-minute booking</h3>
                                <p class="fs-14">Entice renters who book at the last minute</p>
                                <hr class="my-5">
                                <div class="form-group mt-5">
                                    <label class="text-uppercase">Last minute booking window </label>
                                    <select class="form-control basic-select">
                                    <option>1 day before booking</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label class="text-uppercase">Minimum rental duration </label>
                                    <select class="form-control basic-select">
                                    <option>2 days or more</option>
                                    </select>
                                </div>
                                <div class="form-group mt-4">
                                    <label for="basic-url">Length</label>
                                    <div class="input-group w-25">
                                        <input type="text" class="form-control" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
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
                                <button type="button" class="btn thme-btn w-100 mr-2">Cancel </button>
                                <a class="btn thme-btn w-100 px-5" v-on:click="save();" href="javascript:void(0)"> Save</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-5">
    <h3 class="mb-4">Length-of-stay-discounts</h3>
    <hr>
    <a class="thme-btn-border fs-14 rounded mt-4" href="#">Add a length-of-stay-discount </a>
</div>
<div class="mt-5">
    <h3 class="mb-4">Custom discounts</h3>
    <hr>
    <a class="thme-btn-border fs-14 rounded mt-4" href="#">Add a custom discount </a>
</div>
<div class="text-right">
<a class="btn thme-btn w-100 px-5" v-on:click="save();" href="javascript:void(0)"> Save</a>
</div>
