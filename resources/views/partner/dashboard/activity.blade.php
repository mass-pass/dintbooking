<div class="table-header-wrapper">
    <div class="w-100">
            <div class="row" v-if="activity.activeTab == 1">
                <div class="col-md-4">
                    <div class="today-item">
                        <span class="count">@{{ activity.data.today_booked }}</span>
                        <span class="title">Booked Today</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="today-item">
                        <span class="count">@{{ activity.data.total_nights }}</span>
                        <span class="title">Room nights</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="today-item">
                        <span class="count">$ @{{ activity.data.total_revenue }}</span>
                        <span class="title">Revenue</span>
                    </div>
                </div>
            </div>
            <div class="row" v-if="activity.activeTab == 2">
                <div class="col-md-6">
                    <div class="today-item">
                        <span class="count">@{{ activity.data.today_booked }}</span>
                        <span class="title">Cancellation</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="today-item">
                        <span class="count">$ @{{ activity.data.total_revenue }}</span>
                        <span class="title">Lost</span>
                    </div>
                </div>

            </div>
            <div class="row" v-if="activity.activeTab == 3">
                <div class="col-md-6">
                    <div class="today-item">
                        <span class="count">0</span>
                        <span class="title">Booking List</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="today-item">
                        <span class="count">0</span>
                        <span class="title">Over Booking List</span>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="table-body">
    <table class="table ">
        <thead class="thead-light">
            <tr>
                <th>
                    Guest <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
                </th>
                <th>
                    Revenue <i class="float-right fa fa-sort pt-1 "></i>
                </th>
                <th>
                    Check-in <i class="float-right fa fa-sort pt-1 "></i>
                </th>
                <th>
                    Nights <i class="float-right fa fa-sort pt-1 "></i>
                </th>

            </tr>
        </thead>
        <tbody>
            <tr v-if="activity.data.list.length <= 0">
                <td colspan="4" class="text-center">
                    None Available
                </td>
            </tr>
            <tr v-if="activity.data.list.length > 0" v-for="booking in activity.data.list">
                <td>
                    @{{ booking.first_name }}
                </td>
                <td>
                    @{{ booking.base_price }}
                </td>
                <td>
                    @{{ booking.startdate_dmy }}
                </td>
                <td>
                    @{{ booking.total_night }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
