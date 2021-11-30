<div class="mt-5 d-flex justify-content-between">
<h3 class="mb-4">Your additional options</h3>
<div class="">
    <a class="thme-btn fs-14 rounded"  data-toggle="modal" data-target="#basicModalMyPropertyType" href="#">Add additional options </a>
    <div class="modal fade" id="basicModalMyPropertyType" tabindex="-1" role="dialog" aria-labelledby="basicModalMyPropertyType" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 text-left d-block">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body boat-form">
            <h3 class="modal-title mb-0" id="myModalLabel">Add additional options</h3>
            <div class="form-group mt-5">
                <label class="text-uppercase">Category </label>
                <select class="form-control basic-select">
                <option>Select</option>
                <option>Select1</option>
                </select>
            </div>
            <div class="form-group mt-4">
                <label class="text-uppercase">Type of additional options </label>
                <select class="form-control basic-select">
                <option>Select</option>
                <option>Select1</option>
                </select>
            </div>
            <div class="form-group mt-4">
            <label class="text-uppercase">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Add your description here"></textarea>
            </div>
            <div class="form-row align-items-center">
            <div class="col-sm-6 form-group mt-2">
                <label class="text-uppercase">Quantity </label>
                <input type="number" class="form-control" value="5">
            </div>
            <div class="col-sm-6 form-group mt-5">
            <h4>Maximum availability</h4>
            </div>
            </div>
            <div class="form-group mt-2">
                <label class="text-uppercase">Option </label>
                <select class="form-control basic-select">
                <option>Select</option>
                <option>Select1</option>
                </select>
            </div>

            <div class="form-row">
            <div class="form-group col-sm-6 mt-2">
                <label class="text-uppercase">Price </label>
                <input type="number" class="form-control" value="5">
            </div>
            <div class="form-group mt-2 col-sm-6">
                <label class="text-uppercase">Per </label>
                <select class="form-control basic-select">
                <option>Select</option>
                <option>Select1</option>
                </select>
            </div>
            </div>

            <div class="form-row">
            <div class="form-group col-sm-6 mt-2">
                <label class="text-uppercase">Payment</label>
                <select class="form-control basic-select">
                <option>Online</option>
                <option>Offline</option>
                </select>
            </div>
            <div class="form-group mt-2 col-sm-6">
                <label class="text-uppercase">Commission(%)</label>
                <div class="input-group w-100">
                    <input type="text" class="form-control" placeholder="Commission" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
                    </div>
            </div>
            </div>

            <div class="d-flex">
            <button type="button" class="btn thme-btn w-100 mr-2">Cancel </button>
            <a class="btn thme-btn w-100 px-5" v-on:click="save();" href="javascript:void(0)"> Save</a>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="text-right">
            <a class="btn thme-btn px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>


