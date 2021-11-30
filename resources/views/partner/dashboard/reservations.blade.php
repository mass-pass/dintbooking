<div class="table-header">
    <div class="tab-links">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="todayTable-tab" data-toggle="tab" href="#todayTable" role="tab"
                    aria-controls="todayTable" aria-selected="true">Today</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tomTable-tab" data-toggle="tab" href="#tomTable" role="tab"
                    aria-controls="tomTable" aria-selected="false">Tomorrow</a>
            </li>
        </ul>
    </div>
</div>
<div class="table-body" v-if="reservation.activeTab != 4">
    <div class="tab-content">
        <div class="tab-pane active fade show" id="todayTable">
            <table class="table ">
                <thead class="thead-light">
                    <tr>
                        <th>
                            Guest <i class="float-right fa fa-sort pt-1 "></i>
                        </th>
                        <th>
                            Conf <i class="float-right fa fa-sort pt-1 "></i>
                        </th>
                        <th>
                            Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i>
                        </th>
                        <th>
                            Status <i class="float-right fa fa-sort pt-1 "></i>
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="reservation.data.bookingsToday.length == 0">
                        <td colspan="4" class="text-center">
                            None Available
                        </td>
                    </tr>
                    <template v-if="reservation.data.bookingsToday.length > 0">
                        <tr v-for="bookingToday in reservation.data.bookingsToday">
                            <td> @{{ bookingToday.first_name }} </td>
                            <td> @{{ bookingToday.code }} </td>
                            <td> @{{ bookingToday.total_night }} </td>
                            <td>
                                @{{ (reservation.activeTab == 1 ? 'Arrival' : reservation.activeTab == 2) ? 'Depature' : 'In-House' }}
                            </td>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action 01</a>
                                            <a class="dropdown-item" href="#">Action 02</a>
                                        </div>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action 01</a>
                                            <a class="dropdown-item" href="#">Action 02</a>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="tab-pane  fade" id="tomTable">
            <table class="table ">
                <thead class="thead-light">
                    <tr>
                        <th> Guest <i class="float-right fa fa-sort  pt-1 "></i> </th>
                        <th> Conf <i class="float-right fa fa-sort pt-1 "></i> </th>
                        <th> Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i> </th>
                        <th> Status <i class="float-right fa fa-sort pt-1 "></i> </th>
                        <th> Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="reservation.data.bookingsTomorrow.length == 0">
                        <td colspan="5" class="text-center">
                            None Available
                        </td>
                    </tr>
                    <template v-if="reservation.data.bookingsTomorrow.length > 0">
                        <tr v-for="bookingTomorrow in reservation.data.bookingsTomorrow">
                            <td> @{{ bookingTomorrow.first_name }} </td>
                            <td> @{{ bookingTomorrow.code }} </td>
                            <td> @{{ bookingTomorrow.total_night }} </td>
                            <td> @{{ (reservation.activeTab == 1 ? 'Arrival' : reservation.activeTab == 2) ? 'Depature' : 'In-House' }} </td>
                            <td>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action 01</a>
                                            <a class="dropdown-item" href="#">Action 02</a>
                                        </div>
                                    </li>
                                    <li class="list-inline-item dropdown">
                                        <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action 01</a>
                                            <a class="dropdown-item" href="#">Action 02</a>
                                        </div>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </template>

                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- For tab 4 --}}
<div class="table-header-wrapper" v-if="reservation.activeTab == 4">
    <div class="w-100">

        <div class="row">
            <div class="col-md-4">
                <div class="today-item">
                    <span class="count">0</span>
                    <span class="title">Guests</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="today-item">
                    <span class="count">0</span>
                    <span class="title">Adults</span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="today-item">
                    <span class="count">0</span>
                    <span class="title">Children</span>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="table-body" v-if="reservation.activeTab == 4">
    <table class="table ">
        <thead class="thead-light">
            <tr>
                <th> Guest <i class="float-right fa fa-sort  pt-1 "></i> </th>
                <th> Conf <i class="float-right fa fa-sort pt-1 "></i> </th>
                <th> Room <i class="float-right fa fa-sort-amount-up-alt pt-1 "></i> </th>
                <th> Status <i class="float-right fa fa-sort pt-1 "></i> </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="reservation.data.guests.length == 0">
                <td colspan="5" class="text-center"> None Available </td>
            </tr>
            <template v-if="reservation.data.guests.length > 0">
                <tr v-for="guest in reservation.data.guests">
                    <td> @{{ guest.first_name }} </td>
                    <td> @{{ guest.code }} </td>
                    <td> @{{ guest.total_night }} </td>
                    <td> In-House </td>
                    <td>
                        <ul class="list-inline mb-0>
                        <li class=" list-inline-item dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action 01</a>
                                <a class="dropdown-item" href="#">Action 02</a>
                            </div>
                            </li>
                            <li class="list-inline-item dropdown">
                                <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-print"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Action 01</a>
                                    <a class="dropdown-item" href="#">Action 02</a>
                                </div>
                            </li>
                        </ul>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</div>
