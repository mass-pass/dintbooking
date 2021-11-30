@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
    <!-- content starts -->
    <section style="margin-top:90px;" id="partner_calendar">
        <div class="calendar-wrapper">
            {{-- Left  menu --}}
            @include("partner.calendar.partials.left-menu")
            <div class="calendar-content-wrapper">
                <div class="calendar-table" v-if="Object.keys(allRoomsData).length > 0">
                    {{-- Navigation table --}}
                    @include("partner.calendar.partials.navigation-table")

                    <div id="main_scrolltable_container" class="scrollable-table float-left d-flex table-responsive" style="width: 83%;">
                        <div id="inner_main_scrolltable_container" class="d-flex">
                            @include("partner.calendar.partials.main-table" )
                        </div>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="calendar-table text-center alert" v-if="Object.keys(allRoomsData).length <= 0">
                    No data found.
                </div>
            </div>
        </div>
    </section>
    <!-- content ends -->

@stop
@push('after-css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::to('/') }}/css/partner/calendar/calendar.css">
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js'></script>

    <script>
        var propertiesData = <?php echo json_encode($propertiesData); ?>;
        var allRoomsData = <?php echo json_encode($allRoomsData); ?>;
        var dates = <?php echo json_encode($dates); ?>;
        var currentPropertyId = <?php echo $current_property_id; ?>;
    </script>
    <script type='text/javascript' src="{{ URL::to('/') }}/js/partner/calendar/calendar.js"></script>

@endpush
