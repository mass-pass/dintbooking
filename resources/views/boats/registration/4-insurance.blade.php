<div class="row">
    <div class="col-lg-12">
        <div >
            <h3>Insurance</h3>
            <hr>
            <form>
                <div class="form-row">
                    <div class="col-lg-12 form-group">
                        <div class="">
                            <label class="pt-5">AMOUNT OF THE SECURITY DEPOSIT</label>
                            <div class="input-group w-25">
                                <span class="input-group-text" id="basic-addon1">{{ Session::get('currency') }}</span>
                                <input type="text" class="form-control" placeholder="" v-model="boat.insurance_security_deposit" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            </div>
                        </div>
                        <label class="pt-5">CERTIFICATE OF INSURANCE</label>

                    </div>
                </div>
            </form>
            <form  action="{{url('/file-upload')}}" class="dropzone" id="DropzoneFileUploadElement">{{ csrf_field() }}
                <div class="dz-message needsclick">
                    <i class="fas fa-cloud-upload-alt text-center display-2 d-block mb-4"></i>
                    <h4 class="mb-0 text-center">DRAG FILE HERE </h4>
                </div>
            </form>

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
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="text-right">
        <hr/><br/>
            <a class="btn thme-btn px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>
</div>



