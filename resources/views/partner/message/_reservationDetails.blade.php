<div class="reservationDetails-chat">
    <div class="reservationDetails-header">
        <h5 >Reservation Details</h5>
        <div class="reservation-status my-3">
            <?php
                $badge = "";
                if($booking->status === 'Accepted'){
                    $badge = 'success';
                }elseif($booking->status === 'Declined'){
                    $badge = 'danger';
                }else{
                    $badge = 'warning';
                }
            ?>
            <span class="badge badge-{{$badge}}">Reservation {{$booking->status}}</span>
        </div>
    </div>
    <div class="reservationDetails-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Guest Name:</label>
                    <h5>{{$booking->users->first_name}} {{$booking->users->last_name}}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Booking referance number:</label>
                    <h5>{{$booking->code}}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Arrival:</label>
                    <h5>{{$booking->start_date->format('D, M d, Y')}}</h5>
{{--                    <h5>Fri, May 21, 2021</h5>--}}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Departure:</label>
                    <h5>{{$booking->end_date->format('D, M d, Y')}}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Total Price:</label>
                    <h5>${{$booking->total}}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Preferred language:</label>
                    <h5>spanish</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Total Guests</label>
                    <h5>{{$booking->guest}}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="mb-1">Total Rooms</label>
                    <h5>0</h5>
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <div class="form-group text-center">
                    <a href="#" class="h5 link ">View full reservation details</a>
                </div>
            </div>
            <div class="w-100">
                <hr>
            </div>
            <div class="col-md-12">
                <p class="lead">Dint.com receives all messages written here and processes them according to our <a href="#" class="link">Privacy & Cookies statement  </a></p>
            </div>
        </div>
    </div>
</div>