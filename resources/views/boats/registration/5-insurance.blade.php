<div class="">
    <div class="row">
        <div class="col-lg-12">
            <div class="py-5">
                <h3>Insurance</h3>
                <hr>
                <form>
                    <div class="form-row">
                        <div class="col-lg-12 form-group">
                            <div class="">
                                <label class="pt-5">AMOUNT OF THE SECURITY DEPOSIT</label>
                                <div class="input-group w-25">
                                    <input type="text" class="form-control" placeholder="" v-model="boat.insurance_security_deposit" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">€</span>
                                    </div>
                                </div>
                                <label class="mt-4">Approximately  0.00  $</label>
                            </div>
                            <label class="pt-5">CERTIFICATE OF INSURANCE</label>

                        </div>
                    </div>
                </form>
                <div class="file-upload"><input type="file" id="fileUpload"></div>

                <form  action="{{url('/file-upload')}}" class="dropzone" id="DropzoneFileUploadElement">{{ csrf_field() }}
<div class="dz-message needsclick">
    <i class="fas fa-cloud-upload-alt text-center display-2 d-block mb-4"></i>
    <h4 class="mb-0 text-center">DRAG FILE HERE </h4>
    </div>
</form>

                <div class="states mt-5"><a href="#">Miami, United States</a></div>
                <div class="form-row">
                    <div class="col-sm-5 form-group mt-5">
                        <label class="text-uppercase">IS YOUR BOAT INSURED? </label>
                        <select class="form-control basic-select" v-model="boat.is_insured">
                            <option>No</option>
                            <option>Yes</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="btn-section-artment mt-5 d-flex justify-content-end">
                <a class="btn thme-btn w-100 px-5" v-on:click="save();" href="javascript:void(0)"> Save</a>
            </div>
        </div>
    </div>
</div>


