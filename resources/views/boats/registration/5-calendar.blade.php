<div class="row">
    <div class="col-sm-12">
        <div >
        <h3> Select the dates when your boat is not available.</h3>
        <hr class="mb-5">
        <div class="form-row">
            <div class="col-sm-4 form-group">
                <label>FROM</label>
                <input class="form-control" v-model="blocked_date.start_date" type="date" id="date">
            </div>
            <div class="col-sm-4 form-group">
                <label>TO</label>
                <input class="form-control" v-model="blocked_date.end_date"  type="date" id="date">
            </div>
            <div class="col-sm-4 form-group">
                <label>REASON</label>
                <select class="form-control basic-select" v-model="blocked_date.notes">
                    <option value="Maintenance">Maintenance</option>
                    <option value="Holiday">Holiday</option>
                </select>
            </div>
            </div>
            <div class="btn-section-artment mt-4 mb-5 d-flex justify-content-end">
                <a class="btn thme-btn px-5" href="javascript:void(0)" @click="createBlockedDate()"> Add</a>
            </div>
            <h3>Your future periods of unavailability</h3>
            <div v-if="blocked_dates.length">
                <table class="table">
                    <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Reason</th>
                        <th></th>
                    </tr>
                    <tr v-for="blocked_date in blocked_dates">
                        <td>@{{ blocked_date.start_date }}</td>
                        <td>@{{ blocked_date.end_date }}</td>
                        <td>@{{ blocked_date.notes }}</td>
                        <td><a href="javascript:void(0)" @click="deleteBlockedDate(blocked_date.id)"><i class="fa fa-trash"></i></a></td>
                    </tr>
                </table>
            </div>
            <hr class="mb-5">
            <h3> View the calendar</h3>
            <hr class="mb-5">
            <div class="mod-search calendar mb-5" id="eviivo-availability-search" style="display: block;">
                <input value="" id="default-nights-serviced" type="hidden">
                <div class="column column-1 tooltip-holder">
                    <input class="cp-input icon-calendar start-date icon-input datepicker hasDatepicker" id="eviivo-start-date" name="input" placeholder="Check in" readonly="readonly" value="" type="text">
                </div>
                <div class="column column-2">
                    <input class="cp-input icon-calendar end-date icon-input datepicker hasDatepicker" id="eviivo-end-date" name="input" placeholder="Check out" readonly="readonly" value="" type="text">
                </div>
                <div class="pr">
                    <div id="datepicker"></div>
                </div>
            </div>
        </div>
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

