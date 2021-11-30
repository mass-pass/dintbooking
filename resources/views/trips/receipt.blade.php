@extends('layouts.master')

@section('main')
<div class="flash-container">
    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }} text-center mb-0" role="alert">
            {{ Session::get('message') }}
            <a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a>
        </div>
    @endif
    
    <div class="alert alert-success text-center mb-0 d-none" id="success_message_div" role="alert">
        <a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a>
        <p id="success_message"></p>
    </div>

    <div class="alert alert-danger text-center mb-0 d-none" id="error_message_div" role="alert">
        <p><a href="#" class="pull-right" class="alert-close" data-dismiss="alert">&times;</a></p>
        <p id="error_message"></p>
    </div>
</div>
<div  class="container margin-top-85 p-0 mb-5 min-height">
  <div class="panel-body">
      <div class="place-section">
        <div class="row mb-5"><div class="col-sm-12"> 
          <span class="print-div"><i class="fa fa-angle-left"></i> Return to reservation overview</span>
          <h1 class="font-weight-700">Reservation Details</h1></div> 
        </div>
        <div class="row">
          <div class="col-lg-8" >
            <div class="row py-5 shadow-box px-4 px-md-0">
              <div class="col-md-4">
              
                <lable class="mb-3">Check-in</lable>
                
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
              <div class="col-md-8">
                <lable class="mb-3"><i>Guest name:</i></lable>
                <div class="d-flex align-items-center">
                <h2 class="font-weight-700"><i>{{$user->first_name}} {{$user->last_name}}</i></h2>
                
              </div>
              <div class="d-flex align-items-center usa-flag">
                <img src="{{ url('images/flags/flags') }}/{{$bk->country}}.png" class="" alt="">
                <h4 class=""><i>{{DB::table("country")->where("short_name",strtolower($user->default_country))->first()->name}}</i></h4>
              </div>
                <h2 class="mt-5 font-weight-700"><i>{{$user->email}}</i></h2>
                <p class=""><i>Connect with your guests! Let them know what time you want to welcome them, or where to pick up their keys. They're just a call away</i></p>

                <span><i><i class="fa fa-lock mr-2"></i> {{$user->formatted_phone}}</i></span>
                <p class="mb-0"><i>You can also <a class="text-primary" href="#">email</a> or send them an <a class="text-primary" href="#">instant message.</a></i></p>
                <h3 class="font-weight-700 pb-4"><i>{{$user->pd_address}}</i></h3>

                <lable class="mb-3 pt-4"> Preferred language</lable>
                <h3 class="font-weight-700 pb-4">English (US)</h3>

                

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
            <div class="shadow-box p-3 mb-4 mt-5 py-5">
              <div class="accordion accordion-simple" id="accordionExample1">
                <div class="" id="headingOne">
                  <h2 class="p-4 collapsed font-weight-700" href="#" data-toggle="collapse"   data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      {{$bk->pname}} @if($bk->bedrooms==1) ({{$bk->bedrooms}} Bedroom ) @else ({{$bk->bedrooms}} Bedrooms ) @endif <span class="float-right ml-auto">US${{$bk->total}}<i class="fa fa-chevron-right ml-1"></i></span>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample1">
                  <div class="card-body">
                    <div class="d-flex">
                      <h4 class="mr-5"> <i class="fas fa-sign-in-alt"></i> {{ date('D, M d, Y', strtotime($bk->start_date)) }} </h4>
                      <h4> <i class="fas fa-sign-out-alt"></i>{{ date('D, M d, Y', strtotime($bk->end_date)) }} </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="shadow-box px-3 py-5 mt-5">
              <div class="accordion accordion-simple" id="accordionExample">
                <div class="" id="headingTwo">
                  <h2 class="mb-0  p-4 font-weight-700" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Conversation with guest {{count($messages)}} <i class="fa fa-chevron-right float-right"></i>
                  </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body p-0">
                    <div class="row justify-content-end">
                      <div class="col-lg-10">
                        <div class="bg-dark rounded p-5 mt-5 text-white">

                          @if(Auth::user()->user_type_id==1)
                          <h3>Hi {{$user->first_name}} {{$user->last_name}},</h3>
                          @else
                          <h3>Hi {{$host->first_name}} {{$host->last_name}},</h3>
                          @endif
                          @foreach($messages as $m)
                          <h3 class="text-uppercase mb-4 mt-5">{{str_replace("_"," ",$m->message_type->name)}}</h3>
                          <p>{{$m->message}}</p>
                          @endforeach

                          
                          <h3 class="mb-4 mt-5">TEXT, CALL OR EMAIL US, DURING OR AFTER YOUR STAY
                          at 1.312.698.9880 or reservations@dint.com </h3>
                        </div>
                        <div class="text-right">
                          <p class="mt-4 fs-14" >"CHECK-OUT" was sent automatically based on your  <a class="font-weight-700" href="#"> <b> messaging preferences. </b> </a></p>
                          <p>Deliverd</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-5 mx-2">
                    <div class="mb-4">
                      <form id="messageForm" method="post" action="{{url('ajax/message/create')}}" class="form-border-bottom">
                        @csrf
                          <input type="hidden" value="{{$bk->id}}" name="booking_id">
                        @if(Auth::user()->user_type_id==1)
                        <input type="hidden" value="{{$bk->user_id}}" name="sender_id">
                        <input type="hidden" value="{{$bk->host_id}}" name="receiver_id">
                        @else
                        <input type="hidden" value="{{$bk->host_id}}" name="sender_id">
                        <input type="hidden" value="{{$bk->user_id}}" name="receiver_id">
                        @endif
                        <textarea name="message" required="true" class="form-control" placeholder="Type your message..."></textarea>
                      </form>
                      <div class="d-sm-flex d-block align-items-center ml-2 mt-4">
                        
                        <a class="btn thme-btn px-5 fs-14 ml-auto mt-4 mt-sm-0 mr-3" href="javascript:sendMessage()"> Send</a>
                      </div>
                    </div>
                    <hr class="my-5 mx-2">
                    <p class="px-4 fs-14 pb-4 ">Dint.com receives all messages written here and processes them according to our <a class="font-weight-700" href="#"> Privacy & Cookie Statement </a></p>
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
          <div class="col-lg-4 mt-5 mt-lg-0 print-div">
            <div class="card place-section-left p-4 shadow-box">
              <h3 class="font-weight-700 pb-4">Update this reservation</h3>
              <div class="mb-4 mt-4">
                <a href="" class="btn vbtn-outline-success px-2 btn-block text-14">Change reservation dates & prices</a>
              </div>
              
              @if(Auth::user()->user_type_id==2)
              <div class="mb-4">
                <a href="javascript:openMisconduct()" class="btn vbtn-outline-success px-2 btn-block text-14">Report guest misconduct</a>
              </div>
              @else
              <div class="mb-4">
                <a href="javascript:openMisconduct()" class="btn vbtn-outline-success px-2 btn-block text-14">Report staff misconduct</a>
              </div>
              @endif
              <div class="mb-4">
                <a href="javascript:print_receipt()" class="btn vbtn-outline-success px-2 btn-block text-14">Print this page</a>
              </div>
              
              <hr class="mb-5">
              
              
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

              


          </div>
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
      <form action="{{url('ajax/booking-misconduct')}}" id="booking-misconduct" method="post" name="booking-misconduct" accept-charset='UTF-8'>
        {{ csrf_field() }}
        <div class="row p-4">
          <input type="hidden" name="booking_id" value="{{$bk->id}}">
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Subject</label>
              <input required="true" class="form-control"  name="subject" id="subject">
             
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Reason</label>
              <textarea required="true" class="form-control" rows="5" style="resize:none" name="message" id="message">
                
              </textarea>
            </div>
          </div>

          
        </div>

        <div class="modal-footer p-4">
          <button type="button" class="btn btn-outline-danger text-16" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
          <button type="submit" class="btn vbtn-outline-success text-16" id="edit_save_btn2"><i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="edit_save_btn-text2">{{trans('messages.utility.submit')}}</span></button>
        </div>
      </form>
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
<div class="modal fade edit-modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLongTitle">Notes</h2>
        <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="{{url('ajax/booking-notes')}}" id="booking-form" method="post" name="booking-form" accept-charset='UTF-8'>
        {{ csrf_field() }}
        <div class="row p-4">
          <input type="hidden" name="booking_id" value="{{$bk->id}}">
          
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Notes</label>
              <textarea required="true" class="form-control" rows="5" style="resize:none" name="message" id="dispute_status">
                
              </textarea>
            </div>
          </div>

          
        </div>

        <div class="modal-footer p-4">
          <button type="button" class="btn btn-outline-danger text-16" data-dismiss="modal">{{trans('messages.utility.close')}}</button>
          <button type="submit" class="btn vbtn-outline-success text-16" id="edit_save_btn2"><i class="spinner fa fa-spinner fa-spin d-none"></i> <span id="edit_save_btn-text2">{{trans('messages.utility.submit')}}</span></button>
        </div>
      </form>
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
    document.getElementById("footer").classList.add("d-none");
    window.print();

    setTimeout(function(){
      $(".print-div").removeClass("d-none");
      $(".footer").removeClass("d-none");
    });
  }
  function openNotes(type)
  {
    $(".edit-modal2").modal("show")
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
@stop