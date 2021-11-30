<div class="property-layout-wrapper pt-3">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Single</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Apartment type</label>
                                <select name="property_type_id" id="" required class="form-control">
                                    <option value="">Please select</option>
                                    @foreach($property_types as $ii=>$vv)
                                        <option value="{{ $ii }}" {{ isset($property_layout) && ($property_layout->property_type_id == $ii) ? 'selected': '' }} >{{ $vv }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Room name</label>
                                        <select name="title" required id="" class="form-control">
                                            <option value="">Please select</option>
                                            @foreach($room_name_suggestions as $ii=>$vv)
                                            <option value="{{ $vv }}" {{ isset($property_layout) && ($property_layout->title == $vv) ? 'selected': '' }} >{{ $vv }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Custom name (optional)</label>
                                        <input type="text" name="title_custom" class="form-control" value="{{ isset($property_layout) ? $property_layout->title_custom :'' }}" id="">
                                        <p>Create an optional, custom name for your referance.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Number of rooms(of this type)</label>
                                <select name="number_of_units" required id="" class="form-control">
                                @for($i=1; $i<8; $i++)
                                    <option value="{{$i}}" {{ isset($property_layout) && ($property_layout->number_of_units == $i) ? 'selected': '' }}>{{ $i }}</option>
                                @endfor
                                </select>
                                <p class="pt-1">Out of 1 apartment (in total)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Apartment Location</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Floor Level</label>
                                <select name="floor_level" required id="" class="form-control">
                                    <option value="">No Selection</option>
                                    @for($i=0; $i<100; $i++)
                                        <option  {{ isset($property_layout) && ($property_layout->floor_level == $i) ? 'selected': '' }} value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                <p class="pt-1">This feature will help your guests understand which
                                    floor this option is available on. If it's available on both the
                                    ground floor and upper floor(s), guests can make a special
                                    request for their preferred floor based on your availability.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Total number of floors in the building (excl.
                                    underground floors)</label>
                                <input type="number" required name="no_of_floors" value="{{ isset($property_layout) ?  $property_layout->no_of_floors : '' }}"  id="" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Bed options and occupancy</h5>
                </div>
                <div class="card-body">
                    <p>All fields required</p>
                    <div class="bg-light p-3 mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-primary">Standard Arrangement</h6>
                                <div id="beds-container">
                                    <!--loop element  -->
                                    @if(isset($property_layout))
                                    
                                    @foreach($property_layout->beds as $ii=>$one_bed)
                                    <div class="row align-items-end bed-row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">What kind of beds are
                                                    available?</label>
                                                <select name="beds[{{$ii}}][bed_type]" id="" class="form-control">
                                                    @foreach($bed_types as $vv)
                                                        <option value="{{ $vv }}" {{ $one_bed['bed_type'] == $vv ? 'selected' : '' }}>{{ $vv }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group text-center">
                                                <h5 class="pb-2 text-muted">X</h5>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Number of beds</label>
                                                <select name="beds[{{$ii}}][no_of_beds]" id="" class="form-control">
                                                    @for($i=1;$i<10;$i++)
                                                        <option value="{{$i}}" {{ $one_bed['no_of_beds'] == $i ? 'selected' : '' }} >{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group pb-3">
                                                <a href="javascript::void(0)" class="link delete-bed text-danger"> <iclass="fa fa-trash"></i>&nbsp; Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--loop element  -->
                                    @endforeach
                                    @endif
                                </div>
                                <a href="javascript:void(0)" class="btn btn-outline-secondary btn-add-bed">
                                    <i class="fa fa-plus-circle"></i> Add another bed
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-light p-3 mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">Do you need to add a different bed arrangement for
                                    this room?</h6>
                                <small>For example, you can have a double room with 2 twin beds or 1
                                    queen bed.</small>
                            </div>
                            <a href="#" class="btn btn-outline-dark">Add alternative arrangement</a>
                        </div>
                    </div>
                    <!-- occupancy -->
                    <h5>Occupancy</h5>
                    <p>The occupancy you set here is only for guests staying in <b>existing
                            beds</b>. Occupancy from guests staying in cribs and extra beds
                        shouldn't be included. View your crib and extra bed settings in the <a
                            href="#" class="link">Policies section for cribs and extra bes.</a></p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Max adults</label>
                                <select required name="max_occupancy_adults" id="" class="form-control">
                                @for($i=1;$i<10;$i++)
                                    <option value="{{$i}}" {{ isset($property_layout) && ($property_layout->max_occupancy_adults == $i )? 'selected' : '' }} >{{$i}}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Max children</label>
                                <select required name="max_occupancy_children" id="" class="form-control">
                                @for($i=1;$i<10;$i++)
                                    <option value="{{$i}}" {{ isset($property_layout) && ($property_layout->max_occupancy_children == $i) ? 'selected' : '' }} >{{$i}}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Max occupancy</label>
                                <select required name="max_occupancy" id="" class="form-control">
                                @for($i=1;$i<10;$i++)
                                    <option value="{{$i}}" {{ isset($property_layout) && ($property_layout->max_occupancy == $i) ? 'selected' : '' }} >{{$i}}</option>
                                @endfor
                                </select>
                                <p>The maximum number of guests (adults and children) that can stay.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12" id="alert-msg">
                                <div class="alert alert-warning pt-3">
                                    <div>
                                        <h5><span class="icon"> <i
                                                    class="fa fa-info-circle"></i></span>&nbsp;
                                            <b>You don't have child occupany set</b> </h5>
                                        <h6 class="text-dark pl-md-4 ">&nbsp;You don't have child
                                            occupancy set, Which means children are priced as adults
                                            at your property. To set child and maximum occupancy for
                                            your entire property, click the link below.</h6>
                                        <p class="text-dark pl-md-4 mb-1 ">&nbsp;<a href="#"
                                                class="link">Set occupancy and child rates</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Bathroom options</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Number of bathrooms</label>
                                <select name="number_of_bathrooms" id="bathrooms_count" class="form-control" required>
                                <option value="">Select a Bathroom</option>
                                @for($i=1;$i<10;$i++)
                                    <option value="{{$i}}" {{ isset($property_layout) && ($property_layout->no_of_floors == $i) ? 'selected' : '' }} >{{$i}}</option>
                                @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Appended bathrooms -->
                    <div class="row" id="bathroom-container">
                    @if(isset($property_layout))
                    @foreach($property_layout->bathrooms as $ii=>$bathroom)
                        <div class="col-md-6 mb-2">
                            <div class="bathroom-item-wrapper">
                                <h5>Bathroom </h5>
                                <div class="bathroom-item">
                                    <label
                                        for="Is the bathroom private? (not shared with host or other guests)">Is
                                        the bathroom private? (not shared with host or other
                                        guests)</label>
                                    <div class="bathroom-actions">
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio" name="bathrooms[{{$ii}}][is_private]" value="1" 
                                                    {{ $bathroom['is_private'] == 1? 'checked="checked"' : '' }} >
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio" name="bathrooms[{{$ii}}][is_private]" value="0" 
                                                    {{ $bathroom['is_private'] == 0? 'checked="checked"' : '' }} >
                                                <span>No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bathroom-item">
                                    <label
                                        for="Is the bathroom private? (not shared with host or other guests)">Is
                                        the bathroom inside the room?</label>
                                    <div class="bathroom-actions">
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio" name="bathrooms[{{$ii}}][is_inside]" value="1" 
                                                    {{ $bathroom['is_inside'] == 1 ? 'checked="checked"' : '' }} >
                                                <span>Yes</span>
                                            </div>
                                        </div>
                                        <div class="form-check-inline">
                                            <div class="custom-radio">
                                                <input type="radio"  name="bathrooms[{{$ii}}][is_inside]" value="0" 
                                                    {{ $bathroom['is_inside'] == 0 ? 'checked="checked"' : '' }}>
                                                <span>No</span>
                                            </div>
                                        </div>
                                        <p class="text-danger">Select if the bathroom is in the room
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="alert alert-warning">
                When you click continue, don't forgot to add availability & prices, photos, and
                amenities right after!
            </div>
        </div>
        <div class="col-md-12 ">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Continue</button>
        </div>
    </div>
</div>
<div id="bedroom_html" style="display:none">
    <div class="row align-items-end bed-row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="">What kind of beds are
                    available?</label>
                <select name="beds[__REPLACE__][bed_type]" id="" class="form-control">
                    @foreach($bed_types as $vv)
                        <option value="{{ $vv }}" >{{ $vv }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group text-center">
                <h5 class="pb-2 text-muted">X</h5>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Number of beds</label>
                <select name="beds[__REPLACE__][no_of_beds]" id="" class="form-control">
                    @for($i=1;$i<10;$i++)
                        <option value="{{$i}}" >{{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group pb-3">
                <a href="javascript::void(0)" class="link delete-bed text-danger"> <iclass="fa fa-trash"></i>&nbsp; Delete</a>
            </div>
        </div>
    </div>
    <!--loop element  -->
</div>
<div id="bathroom_html" style="display:none">


<div class="col-md-6 mb-2">
    <div class="bathroom-item-wrapper">
        <h5>Bathroom </h5>
        <div class="bathroom-item">
            <label
                for="Is the bathroom private? (not shared with host or other guests)">Is
                the bathroom private? (not shared with host or other
                guests)</label>
            <div class="bathroom-actions">
                <div class="form-check-inline">
                    <div class="custom-radio">
                        <input type="radio" name="bathrooms[__REPLACE__][is_private]" value="1" checked>
                        <span>Yes</span>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-radio">
                        <input type="radio" name="bathrooms[__REPLACE__][is_private]" value="0" >
                        <span>No</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bathroom-item">
            <label
                for="Is the bathroom private? (not shared with host or other guests)">Is
                the bathroom inside the room?</label>
            <div class="bathroom-actions">
                <div class="form-check-inline">
                    <div class="custom-radio">
                        <input type="radio" name="bathrooms[__REPLACE__][is_inside]" value="1" checked >
                        <span>Yes</span>
                    </div>
                </div>
                <div class="form-check-inline">
                    <div class="custom-radio">
                        <input type="radio"  name="bathrooms[__REPLACE__][is_inside]" value="0" >
                        <span>No</span>
                    </div>
                </div>
                <p class="text-danger">Select if the bathroom is in the room
                </p>
            </div>
        </div>
    </div>
</div>

</div>
@push('scripts')
<script language="javascript">
$(function(){
    $('.btn-add-bed').click(function(){
        bedroom_html = $('#bedroom_html').html();
        bedroom_html = bedroom_html.replace(/__REPLACE__/g, Date.now());
        $('#beds-container').append(bedroom_html);

    });
    $('body').on('click', '.delete-bed', function(){
        $(this).parents('.bed-row').first().remove();
    });

    $('#bathrooms_count').change(function(){
        $('#bathroom-container').html('');
        for(i=0; i<$(this).val(); i++){
            bathroom_html = $('#bathroom_html').html();
            apx = Date.now()+i;
            bathroom_html = bathroom_html.replace(/__REPLACE__/g, apx);
            $('#bathroom-container').append(bathroom_html);
        }
    });
})
</script>
@endpush