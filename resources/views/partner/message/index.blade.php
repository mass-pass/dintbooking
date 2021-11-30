@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
    <?php
        $defaultOpenedMessageBookingId = ($bookings->first())?$bookings->first()->id:''
    ?>
    <!-- content starts -->
    <section>
        <div class="content-wrapper py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="alert-msg">
                        <div class="alert alert-primary" >
                            <div> <h5><span class="icon"> <i class="fa fa-info-circle"></i></span>&nbsp; <b>Support with reservations</b> <button class="close" onclick="closeMe()">&times</button> </h5>
                                <span class="text-dark pl-md-4 ">&nbsp;We will send you message here. When you and your guest need help with a reservation.</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-wrapper">
                <div class="chat-tab-header">
                    <div class="container">
                        <div class="tab-links">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active " id="Guest-tab" data-toggle="tab"
                                       href="#Guest" role="tab" aria-controls="Guest"
                                       aria-selected="true">Guest</a>
                                </li>
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <a class="nav-link " id="custService-tab" data-toggle="tab"--}}
{{--                                       href="#custService" role="tab" aria-controls="custService"--}}
{{--                                       aria-selected="false">Customer service &nbsp;<span class="badge badge-danger">5</span> </a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="chat-tab-body">
                    <div class="tab-content">
                        <!-- GUEST PANE Starts -->
                        <div class="tab-pane fade show active" id="Guest">
                            <div class="row w-100">
                                <div class="col-md-3 border-right pr-md-0">
                                    <div class="sidebar-chat">
                                        <div class="sidebar-chat-header">
                                            <h5 >Messages</h5>
                                            <div class="chat-search my-3">
                                                <input type="text" name="" class="form-control" placeholder="Search by booking number " id="">
                                            </div>
                                            <div class="toggleSwitch">
                                                <label class="switch">
                                                    <input type="checkbox" name="only_unread" id="onlyUnread">
                                                    <span class="slider round"></span>
                                                </label>
                                                Only show unread messages
                                            </div>
                                        </div>
                                        <div class="sidebar-chat-body">
                                            <div class="sidebar-list bookings-list">
                                                @foreach($bookings as $bk => $bv)
                                                        <a id="bkg-{{$bv->id}}" href="javascript:void(0)" onclick="getMessageDetails({{$bv->id}}); return false;" class="sidebar-list-item booking-message {{($defaultOpenedMessageBookingId === $bv->id)?'active':''}} {{($bv->messages->first()->read === 0)?'unread':'read'}}">
                                                            <div class="chat-details">
                                                                <div class="chat-info">
                                                                    <h5>{{$bv->users->first_name}} {{$bv->users->last_name}}</h5>
                                                                    <small>Booking number: {{$bv->code}}</small>
                                                                </div>
                                                                <div class="chat-timings">
                                                                    <small>{{$bv->messages->first()->created_at->format('M d,Y')}}</small>
                                                                </div>
                                                            </div>
{{--                                                            <div class="chat-last-msg">--}}
{{--                                                                cs: Hola: Hemos dsdjpsodk dldsjhd jsdos odkso kdos fdfdfd fdfdf fdfd--}}
{{--                                                            </div>--}}
                                                        </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="chatBlock" class="col-md-6 px-md-0">
                                    @include('common.loader')
                                    <!-- html will be updated here via ajax call -->
                                </div>

                                <div id="reservationBlock" class="col-md-3  border-left pl-md-0">
                                    @include('common.loader')
                                    <!-- html will be updated here via ajax call -->
                                </div>
                            </div>
                        </div>
                        <!-- GUEST PANE ENDS -->
                        <!-- CUSTOMER PANE STARTS -->
                        <div class="tab-pane fade" id="custService">
                            <div class="row w-100">
                                <div class="col-md-3 border-right pr-md-0">
                                    <div class="sidebar-chat">
                                        <div class="sidebar-chat-header">
                                            <h5 >Messages</h5>
                                            <div class="chat-search my-3">
                                                <input type="text" name="" class="form-control" placeholder="Search by booking number " id="">
                                            </div>
                                            <div class="toggleSwitch">
                                                <label class="switch">
                                                    <input type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                                Only show unread messages
                                            </div>
                                        </div>
                                        <div class="sidebar-chat-body">
                                            <div class="sidebar-list">
                                                <a href="#" class="sidebar-list-item active">
                                                    <div class="chat-details">
                                                        <div class="chat-info">
                                                            <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </h5>
                                                            <small>Booking number: 293083321</small>
                                                        </div>
                                                        <div class="chat-timings">
                                                            <small>May 11, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="chat-last-msg">
                                                        cs: Hola: Hemos dsdjpsodk dldsjhd jsdos odkso kdos fdfdfd fdfdf fdfd
                                                    </div>
                                                </a>
                                                <a href="#" class="sidebar-list-item">
                                                    <div class="chat-details">
                                                        <div class="chat-info">
                                                            <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </h5>
                                                            <small>Booking number: 293083321</small>
                                                        </div>
                                                        <div class="chat-timings">
                                                            <small>May 11, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="chat-last-msg">
                                                        cs: Hola: Hemos dsdjpsodk dldsjhd jsdos odkso kdos dsdsds dsds sdsd
                                                    </div>
                                                </a>
                                                <a href="#" class="sidebar-list-item">
                                                    <div class="chat-details">
                                                        <div class="chat-info">
                                                            <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </h5>
                                                            <small>Booking number: 293083321</small>
                                                        </div>
                                                        <div class="chat-timings">
                                                            <small>May 11, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="chat-last-msg">
                                                        cs: Hola: Hemos dsdjpsodk dldsjhd jsdos odkso kdos dsdsds dsds sdsd
                                                    </div>
                                                </a>
                                                <a href="#" class="sidebar-list-item">
                                                    <div class="chat-details">
                                                        <div class="chat-info">
                                                            <h5>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </h5>
                                                            <small>Booking number: 293083321</small>
                                                        </div>
                                                        <div class="chat-timings">
                                                            <small>May 11, 2021</small>
                                                        </div>
                                                    </div>
                                                    <div class="chat-last-msg">
                                                        cs: Hola: Hemos dsdjpsodk dldsjhd jsdos odkso kdos dsdsds dsds sdsd
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 px-md-0">
                                    <div class="contentArea-chat">
                                        <div class="contentArea-chat-header">
                                            <a href="#" class="backBtn">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                            <h4>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                <small>Booking number: 293083321</small>
                                            </h4>
                                            <a href="#" class="shareLink">
                                                <i class="fas fa-external-link-alt"></i>
                                            </a>

                                        </div>
                                        <div class="contentArea-chat-body">
                                            <div class="chat-date">
                                                Tue, May 11 2021  09:11 PM
                                            </div>
                                            <div class="chat-item sender">
                                                <span class="icon"> <i class="fas fa-user-circle"></i> </span>
                                                <div class="chat-text">
                                                    <h5>Hello all</h5>
                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, dolores cumque nesciunt sit nulla, explicabo ex reprehenderit sed suscipit repellat quis temporibus veritatis eaque est necessitatibus quaerat deserunt a harum.</p>

                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, dolores cumque nesciunt sit nulla, explicabo ex reprehenderit sed suscipit repellat quis temporibus veritatis eaque est necessitatibus quaerat deserunt a harum.</p>
                                                </div>
                                            </div>
                                            <div class="chat-item receiver">
                                                <span class="icon"> <i class="fas fa-user-circle"></i> </span>
                                                <div class="chat-text">
                                                    <h5>Hello all</h5>
                                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam, dolores cumque nesciunt sit nulla, explicabo ex reprehenderit sed suscipit repellat quis temporibus veritatis eaque est necessitatibus quaerat deserunt a harum.</p>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="contentArea-chat-footer">
                                            <div class="chat-footer-btns">
                                                <button type="button" class="btn btn-primary btn-lg mr-md-2" onclick="subForm()">Reply</button>
                                                <button type="button" class="btn btn-outline-primary btn-lg"><i class="fa fa-thumbs-up"></i>&nbsp; Say thanks</button>
                                            </div>
                                            <div class="chat-footer-form d-none" id="submit-form">
                                                <form action="#">
                                                    <textarea name="" id="" class="textarea" rows="1" placeholder="Your message"></textarea>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fa fa-paper-plane"></i>&nbsp; Send
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3  border-left pl-md-0">
                                    <div class="reservationDetails-chat">
                                        <div class="reservationDetails-header">
                                            <h5 >Reservation Details</h5>
                                            <div class="reservation-status my-3">
                                                <span class="badge badge-danger">Reservation Cancelled</span>
                                            </div>
                                        </div>
                                        <div class="reservationDetails-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Guest Name:</label>
                                                        <h5 class="guestName"></h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Booking referance number:</label>
                                                        <h5>2930833820</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Arrival:</label>
                                                        <h5>Fri, May 21, 2021</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Departure:</label>
                                                        <h5>Thu, May 27, 2021</h5>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="" class="mb-1">Total Price:</label>
                                                        <h5>$0</h5>
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
                                                        <h5>02</h5>
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
                                </div>
                            </div>
                        </div>
                        <!-- CUSTOMER PANE ENDS -->
                    </div>
                </div>


            </div>
        </div>
    </section>
    <!-- content ends -->
    <script>
        let defaultOpenedMessageBookingId = "{{$defaultOpenedMessageBookingId}}"
        $(function(){
            //neeed to call details about a booking or message
                getMessageDetails(defaultOpenedMessageBookingId);

            //only show unread message toggle
            $('#onlyUnread').click(function(){
                if($(this).prop('checked')){
                    $('.booking-message.read').hide();
                }else{
                    $('.booking-message.read').show();
                }
            })

        });
        function getMessageDetails(booking_id = 0)
        {
            let $reservationBlock = $('#reservationBlock');
            let $chatBlock = $('#chatBlock');

            if(booking_id == 0){
                let chatMsg = "<div class='text-center pt-5'>No Message Yet</div";
                let reservationMsg = "<div class='text-center pt-5'>No Reservation Yet</div";
                $reservationBlock.html(reservationMsg).ready(function(){
                    $reservationBlock.removeClass("sp-loading");
                });
                $chatBlock.html(chatMsg).ready(function(){
                    $chatBlock.removeClass("sp-loading");
                });
            }

            $('.bookings-list a.booking-message').removeClass('active');
            $('.bookings-list a#bkg-'+booking_id).addClass('active');
            // let formData = $form.serializeArray();
            $.ajax({
                url: APP_URL+'/partner/inbox/details/'+booking_id,
                type: 'POST',
                dataType: 'JSON',
                data: {
                    '_token': "{{csrf_token()}}"
                },
                beforeSend:function(){
                    $reservationBlock.addClass("sp-loading");
                    $chatBlock.addClass("sp-loading");
                },
                success:function(resp){
                    $reservationBlock.html(resp.reservation).ready(function(){
                        $reservationBlock.removeClass("sp-loading");
                    });
                    $chatBlock.html(resp.chat).ready(function(){
                        $chatBlock.removeClass("sp-loading");
                    });
                },
                error: function(xhr){
                    let obj = JSON.parse(xhr.responseText);
                    console.log("error from getMessageDetails >>",obj.message);
                    // toastError(obj.message);
                    $reservationBlock.removeClass("sp-loading");
                    $chatBlock.removeClass("sp-loading");
                }
            })
        }
    </script>
@stop