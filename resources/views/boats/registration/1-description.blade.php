


    <div class="row">
        <div class="col-lg-12">
            <div class="">
                <div class="">
                <h3>Languages</h3>
                <hr>
                <p>Add languages in order to Improve your visibility on search results</p>
                <p  v-for="(language, idx) in selectable_languages"><input type="checkbox" v-model="boat.languages" :true-value="[]" :value="language"  name="languages[]" value="en" class="mr-2">@{{ getLanguageNameFromCode(language) }}</p> 
            </div>
            </div>
            <div class="input-group mb-3">
                <select class="form-control" v-model="language_selector" id="additional-languages" >
                    <template v-for="(language, idx) in languages">
                        <option v-if="!selectable_languages.includes(idx)" :value="idx">@{{ language }}</option>
                    </template>
                </select>
                <a href="javascript:void(0);" class="btn thme-btn" style="font-size:small !important;color:white" v-on:click="pushLanguageToSelectableLanguages()" id="lnk-additional-language">Add additional</a>
            </div>

            <div class="">
                <div class="">
                    <div class="py-5">
                        <h3>Title</h3>
                        <hr>
                        <div class="form-row">
                            <div class="col-lg-6">
                                <input type="text" class="form-control mt-4" name="title" id="title" v-model="boat.title" placeholder="E.g.: Yamaha 242 Limited s">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="">
                    <div class="">
                    <h3>Description</h3>
                    <hr>
                    </div>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-lg-7">
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" v-model="boat.description" name="description" id="description" rows="20" placeholder="The length and quality of your description impacts the positioning of your advertisement in the search results."></textarea>
                    </div>
                </div>
                <div class="col-lg-5">
                    <p>Write about your boat Number of berths, equipment, safety features. The history of the boat, your use of this boat (family outings, regattas). <br><br>
                    About your area! Things to see in your area (best restaurants, places to moor, a pretty cove, a place not to be missed). Sorne ideas on things to do with your boat (tell us about the best places to visit from your boat's marina of departure). <br><br> About you! Why did you buy this boat? In which marina it located? A short anecdote.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="py-5">
                        <h3>Technical</h3>
                        <hr>
                        <form>
                            <div class="form-row">
                                <div class="col-sm-6 form-group">
                                    <label>ONBOARD CAPACITY-AUTHORISED</label>
                                    <input type="text" class="form-control" v-model="boat.authorised_onboard_capacity" name="authorised_onboard_capacity" id="authorised_onboard_capacity" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>ONBOARD CAPACITY-RECOMMENDED</label>
                                    <input type="text" class="form-control" v-model="boat.recommended_onboard_capacity" name="recommended_onboard_capacity" id="recommended_onboard_capacity" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>NUMBER OF CABINS</label>
                                    <input type="text" class="form-control" v-model="boat.cabin_count" name="cabin_count" id="cabin_count" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>NUMBER OF BERTHS</label>
                                    <input type="text" class="form-control" v-model="boat.berth_count" name="berth_count" id="berth_count" />
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label>NUMBER OF BATHROOM</label>
                                    <input type="text" class="form-control" v-model="boat.bathroom_count" name="bathroom_count" id="bathroom_count">
                                </div>
                                <div class="col-sm-6 form-group"></div>
                                <div class="col-lg-3 form-group">
                                    <div class="">
                                        <label for="basic-url">LENGTH</label>
                                        <div class="input-group w-50">
                                            <input type="text" class="form-control" v-model="boat.length" placeholder="25" id="length" name="length" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ft</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <div class="">
                                        <label for="basic-url">FUEL</label>
                                        <div class="input-group w-50">
                                            <input type="text" class="form-control" placeholder="0" v-model="boat.fuel_consumption_ga_h" name="fuel_consumption_ga_h" id="fuel_consumption_ga_h" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">gal/h</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 form-group">
                                    <div class="">
                                        <label for="basic-url">SPEED</label>
                                        <div class="input-group w-50">
                                            <input type="text" class="form-control" name="speed_km_h" id="speed_km_h" v-model="boat.speed_km_h" placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Kn</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 form-group">
                                    <label>YEAR OF CONSTRUCTION</label>
                                    <input type="text" class="form-control" v-model="boat.year_of_construction" name="year_of_construction" id="year_of_construction" />
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label>RENOVATED</label>
                                    <input type="text" class="form-control" id="year_of_renovation" v-model="boat.year_of_renovation" name="year_of_renovation" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 text-right">
        <hr/><br/>

            <a class="btn thme-btn  px-5" v-on:click="prevStep();" href="javascript:void(0)"><i class="fa fa-chevron-left"></i> &nbsp;prev</a>
            <a class="btn thme-btn  px-5" v-on:click="save();" href="javascript:void(0)"> next&nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
    </div>

