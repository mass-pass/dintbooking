@extends('admin.template')

@section('main')

<div class="content-wrapper page-details">
  <div class="container margin-top-85 p-0 mb-5 min-height">
    <div class="panel-body">
        <div class="place-section">
          <section class="content-header print-div">
            <h1>
              Reservation Details
            </h1>
          @include('admin.common.breadcrumb')
          </section>
          <section class="content place-section">
            <div class="row" >
              <div class="col-lg-8">
                <div class="row py-5 shadow-box px-4 px-md-0">
                  <div class="col-md-4 no-gutters mt-5">
                  
                    <lable class="mt-5">Check-in</lable>
                    
                    <h2 class="mb-4 font-weight-700">{{ date(' M d, Y', strtotime($bk->start_date)) }}</h2>
                    <lable class="mb-3">Check-out</lable>
                    <h2 class="pb-4 font-weight-700" >{{ date(' M d, Y', strtotime($bk->end_date)) }}</h2>
                    
                    <lable class="mb-3 pt-4 "> Length of stay:</lable>
                        <h3 class="font-weight-700">{{$bk->total_night}} night </h3>
                    <lable class="mb-3 pt-4"> Total Guests:</lable>
                      <h3 class="pb-4 font-weight-700"> {{$bk->guest}} </h3>
                    <lable class="mb-3 pt-4"> Total rooms</lable>
                      <h3 class="pb-4 font-weight-700"> 1 </h3>
                    <lable class="mb-3 pt-4"> Total price</lable>
                      <h2 class="font-weight-700"> US${{$bk->total}} </h2>
                  </div>
                  <div class="col-md-8 mt-5">
                    <lable class="mt-5"><i>Guest name:</i></lable>
                    <div class="d-flex align-items-center">
                    <h2 class="font-weight-700"><i>{{$user->first_name}} {{$user->last_name}}</i></h2>
                   
                  </div>
                  <div class="d-flex align-items-center usa-flag">
                    <img src="{{ url('images/flags/flags') }}/{{$bk->country}}.png" class="" alt="">
                    <h4 class=""><i>{{DB::table("country")->where("short_name",strtolower($user->default_country))->first()->name}}</i></h4>
                  </div>
                    <h2 class="mt-5 font-weight-700"><i>{{$bk->email}}</i></h2>
                    <p class=""><i>Connect with your guests! Let them know what time you want to welcome them, or where to pick up their keys. They're just a call away</i></p>

                    <span><i><i class="fa fa-lock mr-2"></i> {{$user->formatted_phone}}</i></span>
                    <p class="mb-0"><i>You can also <a class="text-primary" href="#">email</a> or send them an <a class="text-primary" href="#">instant message.</a></i></p>
                    <h3 class="font-weight-700 pb-4"><i>{{$user->pd_address}}</i></h3>
                    <div class="no-gutters">
                      <lable class="mb-3 pt-4"> Preferred language</lable>
                      <h3 class="font-weight-700 pb-4">English (US)</h3>
                    </div>
                    

                    <div class="row no-gutters mt-4">
                      <div class="col-md-6">
                        <lable class="mb-3 pt-4"> Booking number:</lable>
                        <h3 class="font-weight-700">{{$bk->id}}{{$bk->host_id}}{{$bk->user_id}}</h3>
                      </div>
                      <div class="col-md-6">
                        <lable class="mb-3 pt-4"> Commissionable amount:</lable>
                        <h3 class="font-weight-700">US${{$commission}}</h3>
                      </div>
                    </div>

                    <div class="row no-gutters mt-4">
                      <div class="col-md-6">
                        <lable class="mb-3 pt-4"> Received</lable>
                        <h3 class="font-weight-700">{{ date(' M d, Y', strtotime($bk->created_at)) }}</h3>
                      </div>
                      <div class="col-md-6">
                        <lable class="mb-3 pt-4"> Commission:</lable>
                        <h3 class="font-weight-700">US${{$bk->host_fee}}</h3>
                      </div>
                    </div>

                    <div class="row no-gutters mt-4">
                      <div class="col-md-12">
                        <lable class="mb-3 pt-4"> Notepad (internal only)</lable>
                        <h3><a href="javascript:openNotes()" class="text-primary"><b>Add Your note here</b></a></h3>
                      
                      </div>
                    </div>
              
                  </div>
                </div>
                <div class="row shadow-box p-3 mb-4 mt-5 py-5">
                  <div class="accordion accordion-simple" id="accordionExample1">
                    <div class="" id="headingOne">
                      <h2 class="p-4 collapsed font-weight-700" href="#" data-toggle="collapse"   data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          {{$bk->pname}} @if($bk->bedrooms==1) ({{$bk->bedrooms}} Bedroom ) @else ({{$bk->bedrooms}} Bedrooms ) @endif <span class="float-right ml-auto">US${{$bk->total}}<i class="fa fa-chevron-right ml-1"></i></span>
                      </h2>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
                      <div class="card-body">
                        <div class="d-flex">
                          <h4 class="mr-5 card-date"> <i class="fas fa-sign-in-alt"></i> {{ date('D, M d, Y', strtotime($bk->start_date)) }} </h4>
                          <h4> <i class="fas fa-sign-out-alt"></i>{{ date('D, M d, Y', strtotime($bk->end_date)) }} </h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row shadow-box px-3 py-5 mt-5">
                  <div class="accordion accordion-simple" id="accordionExample">
                    <div class="" id="headingTwo">
                      <h2 class="mb-0  p-4 font-weight-700" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Conversation with guest <i class="fa fa-chevron-right float-right"></i>
                      </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body p-0">
                        <div class="row justify-content-end">
                          <div class="col-lg-10">
                            <div class="bg-dark rounded p-5 mt-5 text-white">
                              
                          <h3>Hi {{$user->first_name}} {{$user->last_name}},</h3>
                         
                          @foreach($messages as $m)
                          <h3 class="text-uppercase mb-4 mt-5">{{str_replace("_"," ",$m->message_type->name)}}</h3>
                          <p>{{$m->message}}</p>
                          @endforeach
                         
                            </div>
                            <div class="text-right">
                              <p class="mt-4 fs-14" >"CHECK-OUT" was sent automatically based on your  <a href="#"> <b> messaging preferences. </b> </a></p>
                              <p>Deliverd</p>
                            </div>
                          </div>
                        </div>
                        <hr class="my-5 mx-2">
                        <div class="mb-4">
                          <form id="messageForm" method="post" action="{{url('ajax/message/create')}}" class="form-border-bottom">
                        @csrf
                          
                        <textarea name="message" required="true" class="form-control" placeholder="Type your message..."></textarea>
                      </form>
                      <div class="d-sm-flex d-block align-items-center ml-2 mt-4">
                        
                        <a class="btn thme-btn px-5 fs-14 ml-auto mt-4 mt-sm-0 mr-3"> Send</a>
                      </div>
                        </div>
                        <hr class="my-5 mx-2">
                        <p class="px-4 fs-14 pb-4 ">Dint.com receives all messages written here and processes them according to our <a  href="#"> <b>Privacy & Cookie Statement</b> </a></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row px-2 py-5 shadow-box mt-5 px-4 px-md-0">
                  <div class="col-md-12">
                    <h2 class="pb-4 font-weight-700">  {{$bk->pname}} @if($bk->bedrooms==1) ({{$bk->bedrooms}} Bedroom ) @else ({{$bk->bedrooms}} Bedrooms ) @endif  </h2>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <h3 class="font-weight-700">Cancellation</h3>
                      </div>
                      <div class="col-md-8 pr-4">
                        <lable class="mb-3 pt-4"> The guest will be charged the total price of the reservation if they cancel anytime. </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <h3 class="font-weight-700">Prepayment</h3>
                      </div>
                      <div class="col-md-8 pr-4">
                        <lable class="mb-3 pt-4"> The guest will be charged a prepayment of the total price of the reservation anytime.  </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        <h3 class="font-weight-700">Internet</h3>
                      </div>
                      <div class="col-md-8 pr-4">
                        <lable class="mb-3 pt-4"> WiFi is available in the hotel rooms and is free of charge.   </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-sm-4 pr-4">
                        <h3 class="font-weight-700">Children and Extra Bed Policy</h3>
                      </div>
                      <div class="col-sm-8">
                        <lable class="mb-3 pt-4"> Children of all ages are allowed.  </lable>
                        <hr>
                        <lable class="mb-3 pt-4"> No cribs are available.  </lable>
                        <hr>
                        <lable class="mb-3 pt-4"> No extra beds are available.  </lable>
                        <hr>
                        <lable class="mb-3 pt-4"> The maximum number of total guests is 3.  </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-sm-4">
                        <h3 class="font-weight-700">Parking</h3>
                      </div>
                      <div class="col-sm-8 pr-4">
                        <lable class="mb-3 pt-4"> Public parking is available at a location nearby (reservation is not possible) and charges may apply.  </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-sm-4">
                        <h3 class="font-weight-700">Pets</h3>
                      </div>
                      <div class="col-sm-8 pr-4">
                        <lable class="mb-3 pt-4"> Pets are allowed on request. Charges may apply.   </lable>
                      </div>
                    </div>
                    <hr>
                    <div class="row no-gutters">
                      <div class="col-sm-4">
                        <h3 class="font-weight-700">Groups </h3>
                      </div>
                      <div class="col-sm-8 pr-4">
                        <lable class="mb-3 pt-4"> No special conditions apply for groups.    </lable>
                      </div>
                    </div>
                    <hr class="mb-5">
                  </div>
                </div>
              </div>
              <div class="col-lg-4  mt-lg-0 print-div">
                <div class="row shadow-box place-section-left">
                  <h3 class="font-weight-700 pb-4">Update this reservation</h3>
                  <div class="mb-4 mt-4">
                    <a href="" class="btn vbtn-outline-success px-2 btn-block text-14">Change reservation dates & prices</a>
                  </div>
                  <div class="mb-4">
                    <a href="javascript:openNotes()" class="btn vbtn-outline-success px-2 btn-block text-14">Mark as a no-show</a>
                  </div>
                  <div class="mb-4">
                    <a href="javascript:openMisconduct()" class="btn vbtn-outline-success px-2 btn-block text-14">Report guest misconduct</a>
                  </div>
                  <div class="mb-4">
                    <a href="javascript:print_receipt()" class="btn vbtn-outline-success px-2 btn-block text-14">Print this page</a>
                  </div>
                 
                  

                  <div class="mb-4">
                    @if($bk->dispute_status!=2)
                    <a href="javascript:openDispute({{$bk->dispute_status}})" class="btn btn-danger text-white btn-block text-14">Dispute  reservation</a>
                    @else
                    <a href="javascript:void(0)" class="btn vbtn-outline-success px-2 btn-block text-14">Dispute resolved</a>
                    @endif
                    
                  </div>
                  
                  
                  <h3 class="mb-4 font-weight-700">Payment Status</h3>
                    <form>
                      <div class="form-group">
                          <select class="form-control">
                        <option @if($payouts->status=="Future") selected @endif value="Future">Future</option>
                        <option @if($payouts->status=="Completed") selected @endif value="Completed">Completed</option>
                      </select>
                      </div>
                    </form>
                </div>

                  <div class="d-flex mb-5 p-3 mt-4 shadow-box place-section-bottom">
                    <i class="fa fa-info-circle text-24" aria-hidden="true"></i>
                    <div class="ml-3 ">
                      <h4>Guest didn't show up?</h4>
                        <a href="" class="text-dark">What can I do now? </a>
                      </div>
                  </div>


              </div>
            </div>
        </div>
    </div>
  </div>
</div>
<div class="modal fade edit-modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Dispute</h2>
        <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('admin/booking/dispute')}}" id="edit_payout_setting2" method="post" name="edit_payout_setting2" accept-charset='UTF-8'>
        {{ csrf_field() }}
        <div class="row p-4">
          <input type="hidden" name="booking_id" id="edit_id2" value="{{$bk->id}}">
         
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Select Payout Status</label>
              <select class="form-control" name="dispute_status" id="dispute_status">
                <option @if($bk->dispute_status==1) selected @endif value="1">Create</option>
                <option @if($bk->dispute_status==2) selected @endif value="2">Solved</option>
              </select>
            </div>
          </div>

          <div class="col-md-12" id="email">
            <div class="form-group">
              <label for="exampleInputPassword1">Message<span class="text-danger">*</span></label>
              <textarea class="form-control" name="message" id="message" value=""></textarea>
              @if ($errors->has('message')) <p class="error-tag">{{ $errors->first('message') }}</p> 
              @endif
            </div>
          </div>
        </div>

        <div class="modal-footer p-4">
          <button type="button" class="btn btn-outline-danger text-16" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
          <button type="submit" class="btn vbtn-outline-success text-16" id="edit_save_btn2"><i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="edit_save_btn-text2">{{trans('messages.utility.submit')}}</span></button>
        </div>
      </form>
     </div>
    </div>
  </div>
</div>
<div class="modal fade edit-behaviour" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Report  misconduct</h2>
        <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="col-md-12">
            @foreach($misconduct as $n)
            @php
            if($n->sender_id==Auth::user()->id)
            $colorClass="blueText";
            else
            $colorClass="blackText"
            @endphp
            <div class="form-group">
              <h3 class="{{$colorClass}}">{{$n->subject}}</h3>
              <p>{{$n->message}}</p>
            </div>
            <hr />
            @endforeach
          </div>
     </div>
    </div>
  </div>
</div>
<div class="modal fade edit-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Notes</h2>
        <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <div class="col-md-12">
            @foreach($notes as $n)
            <div class="form-group">
              <h3>{{$n->message}}</h3>
            </div>
             <hr />
            @endforeach
          </div>
     </div>
    </div>
  </div>
</div>
<style type="text/css">
  .blackText{
    color: #000 !important;
  }
  .blueText{
    color:blue !important;
  }
</style>
<script ttype="text/javascript">
  function print_receipt()
  {
     $(".print-div").addClass("d-none");
        $(".main-header").addClass("d-none");
      $(".main-sidebar").addClass("d-none");
     $(".main-footer").addClass("d-none");
    window.print();

    setTimeout(function(){
      $(".print-div").removeClass("d-none");
      $(".main-header").removeClass("d-none");
      $(".main-sidebar").removeClass("d-none");
      $(".main-footer").removeClass("d-none");

    });
  }
   function openDispute(type)
  {
    $(".edit-modal2").modal("show")
  }
  function openNotes(type)
  {
    $(".edit-notes").modal("show")
  }
  function openMisconduct(type)
  {
    $(".edit-behaviour").modal("show")
  }
  function sendMessage()
  {
    $("#messageForm").submit();
  }
</script>
<style type="text/css">
  /*booking details start */



.page-details .row {
    margin-left: 0;
    margin-right: 0;
}
.page-details .place-section {
  padding-top: 50px;
  padding-bottom: 50px;
  word-break: break-word;
  }
  .page-details .place-section .shadow-box {
  box-shadow: 0px 0px 5px 0px #ccc;
  margin-bottom: 30px;
  }
  .page-details .font-weight-700{
    font-weight: 700;
  font-size: 2rem
}
.page-details .bg-dark {
    background-color: #343a40!important;
}
.page-details .card-body {
  
  padding: 3rem;
  margin-top: 3rem
}
.page-details .card-body .row {
    margin-left: 0;
    margin-right: 0;
}

.page-details .rounded{
  margin-top: 5px;
  padding: 3rem;
  font-size: 1.6rem;
  
  color: white;
}
.page-details .rounded h3{
  font-size: 1.75rem;
}
.page-details .rounded p{
  margin-bottom:30px;
}
.page-details a{
  color: black !important;
}
.page-details hr{
  border-top: 1px solid rgba(0,0,0,.1);
}
.page-details .form-border-bottom .form-control {
    border: none;
  background: transparent;
}
.page-details .thme-btn, a.thme-btn {
    background-color: #222325;
    padding: 10px 10px;
    font-size: 18px;
    color: #fff!important;
    border: 1px solid #222325;
}
.page-details .margin-block{
  margin:20px 0px 40px 0px;
}
.page-details .vbtn-outline-success {
    border-color: #303030;
  padding: .375rem .75rem;
  margin-bottom: 1.5rem;
  margin-top: 1.5rem
}
.page-details .place-section-left{
    padding: 15px 20px;
    margin-bottom: 20px;
    box-shadow: 0px 0px 5px 0px #ccc;
    position: relative;
}
.page-details .place-section-bottom{
  padding: 1rem;
  display: flex
}
.page-details .place-section-bottom i{
padding: 11px 5px 0px 0px ;
}
.page-details .d-flex {
  display: flex
}
.page-details .badge {
  max-height: 20px;
  margin-top: 25px;
}
.page-details .no-gutters h3, .no-gutters h2{
  margin:0px 0px 20px 0px 
}
.page-details .no-gutters .col-md-6, .no-gutters .col-md-12{
  padding-left: 0;
  padding-right: 0;
}
.page-details .card-date{
  margin-right: 25px;
}
.page-details .collapsed {
  padding: 5px;
}
.page-details #headingTwo h2{
  padding: 5px;
}
 /*booking detail end*/
</style>
@stop