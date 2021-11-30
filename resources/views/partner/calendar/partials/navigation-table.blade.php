<table class="table table-bordered float-left left-side-table mb-0" width="17%" style="width: 17%;">
    <thead>
        <tr>
            <th class="calendar-actions dropdown">
                <button type="button" class="btn  btn-primary" onclick="calenderSide()">
                    <i class="fa fa-bars"></i></button>
                <span class="calendarOpen">
                    <button type="button" class="btn  btn-primary" id="calendarBtn">
                        <i class="far fa-calendar-alt"></i></button> <input type="text" name="" id="datepicker">
                </span>
                <span>
                    <button type="button" class="btn btn-primary" data-toggle="dropdown">
                        <i class="fa fa-search"></i>
                    </button>
                    <div class="dropdown-menu shadow">
                        <form action="#" @submit="searchRoom">
                            <input type="text" name="" v-model="is_searched_room.value" class="form-control" id="" placeholder="Quick find room">
                        </form>
                    </div>
                </span>
                <span>
                    <button type="button" class="btn btn-success" data-toggle="dropdown">
                        <i class="fa fa-plus"></i>
                    </button>
                    <div class="dropdown-menu shadow">
                        <a class="dropdown-item" targer="_blank" href="{{ route('partner.bookings.new', ['property' => $current_property_id])}}">New Reservation</a>
                        <a class="dropdown-item" href="#">Block Dates</a>
                        <a class="dropdown-item" href="#">Courtesy Hold</a>
                        <a class="dropdown-item" href="#">Out of Service</a>
                    </div>
                </span>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="collapse-all">
            <td class="main-heading">
                <span class="fa fa-caret-down"></span> All Room Types
            </td>
        </tr>
        <template v-for="property in propertiesData['properties']">
            <template v-for="propertyLayout in property.property_layouts">
                <tr class="main-collapse" :class="{['main-collapse-'+propertyLayout.id]: true}" :data-pId="propertyLayout.id" >
                    <td class="sub-heading">
                        <b><span class="fa fa-caret-down"></span> @{{ propertyLayout.title }} </b>
                    </td>
                </tr>
                {{-- <tr v-for="(bed, id) in propertyLayout.beds" class="dint_collapse" :class="{['dint-collapse-'+propertyLayout.id]: true}" v-if=" id != '__REPLACE__'"> --}}
                <tr v-for="(unit, id) in propertyLayout.property_units" class="dint_collapse" :class="['dint-collapse-'+propertyLayout.id, ,(is_searched_room.id == unit.property_unit_number) ? 'is_searched_room' : '']">
                    <td>
                        @{{ unit.property_unit_number }} <i class="fa fa-certificate float-right text-danger"></i>
                    </td>
                </tr>
            </template>
        </template>
    </tbody>
    <tfoot>
        <tr>
            <td class="main-heading">
                <a href="#" class="link mr-2"> <i class="fa fa-square"></i> Legend </a>
                <a href="#" class="link"> <i class="fa fa-info-circle"></i> Learn to use </a>
                <div class="pt-2"><i class=" fa fa-link text-success"></i> Connected </div>
            </td>
        </tr>
    </tfoot>
</table>
