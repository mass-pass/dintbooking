<table class="table table-bordered right-side-table mb-0 month-table main_calendar_table" v-for="(allRoomData, month) in allRoomsData">
    <thead>
        <tr>
            <th :colspan="Object.keys(allRoomData).length" class="bg-light">
                <h5 class="mb-0">@{{ month }}</h5>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr class="no-collapse">
            <td class="current-date " align="center" v-for="(roomData, dayDate) in allRoomData">
                <div class="head-item">
                    <span class="badge badge-secondary">@{{ roomData['total_booking'] }}</span> <br>
                    <strong class="text-uppercase"> @{{ dayDate }} </strong> <br>
                    @{{ roomData['booking_percentage'] }}%
                </div>
            </td>
        </tr>
        <template v-for="property in propertiesData['properties']">
            <template v-for="propertyLayout in property.property_layouts">

                {{-- tr for propertyLayout pricing --}}
                <tr class="main-collapse">
                    <td class="current-date " align="center" v-for="pricing in propertyLayout.propertyLayoutPricing[month]">
                        <span class="">0</span> <br>
                        $@{{ pricing }}
                    </td>
                </tr>
                {{-- /tr for propertyLayout pricing --}}

                {{-- tr for beds and booking  --}}
                <tr class="dint_collapse" :class="['dint-collapse-'+propertyLayout.id, ,(is_searched_room.id == unit.property_unit_number) ? 'is_searched_room' : '']" v-for="unit in propertyLayout.property_units">
                    <td class="current-date" v-for="pricing in propertyLayout.propertyLayoutPricing[month]">

                    </td>
                </tr>
                {{-- /tr for beds and booking  --}}

            </template>
        </template>
        
    </tbody>
</table>
