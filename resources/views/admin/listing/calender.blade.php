@extends('admin.template')
@section('main')
<div class="content-wrapper">
  <!-- Modal -->
  <section class="content">
    <div class="row">
      <div class="col-md-3 settings_bar_gap">
        @include('admin.common.property_bar')
      </div>
      <div class="col-md-9">
        <div class="box box-info">
          <div class="box-body">
            <div class="modal fade d-none z-index-high" id="hotel_date_package_admin" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close cls-reload" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('messages.listing_calendar.calendar_title')}}</h4>
                  </div>
                  <form method="post" action="admin/hotel_date_package/" class='form-horizontal' id='dtpc_form'>
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <p class="calendar-m-msg"  id="model-message"></p>
                      <input type="hidden" value="{{ $result->id }}" name="property_id" id="dtpc_property_id">
                      <div class="form-group">
                        <label for="input_dob" class="col-sm-3 control-label">{{trans('messages.listing_calendar.start_date')}} <em class="text-danger">*</em></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="start_date" id='dtpc_start_admin' placeholder = "{{trans('messages.listing_calendar.start_date')}}" autocomplete = 'off'>
                          <span class="text-danger" id="error-dtpc-start">{{ $errors->first('start_date') }}</span>
                        </div>
                      </div>
                      <div class="clear-both"></div>
                      <div class="form-group">
                        <label for="input_dob" class="col-sm-3 control-label">{{trans('messages.listing_calendar.end_date')}} <em class="text-danger">*</em></label>
                        <div class="col-sm-6">
                          
                          <input type="text" class="form-control" name="end_date" id='dtpc_end_admin' placeholder = "{{trans('messages.listing_calendar.end_date')}}" autocomplete = 'off'>
                          <span class="text-danger" id="error-dtpc-end">{{ $errors->first('end_date') }}</span>
                        </div>
                      </div>
                      <div class="clear-both"></div>
                      <div class="form-group">
                        <label for="input_dob" class="col-sm-3 control-label">{{trans('messages.listing_calendar.price')}} <em class="text-danger">*</em></label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" name="price" id='dtpc_price' placeholder = "">
                          <span class="text-danger" id="error-dtpc-price">{{ $errors->first('price') }}</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="input_dob" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
                        <div class="col-sm-6">
                          <select class="form-control" name="status" id="dtpc_status">
                            <option value="">--Please Select--</option>
                            <option value="Available">Available</option>
                            <option value="Not available">Not Available</option>
                          </select>
                          <span class="text-danger" id="error-dtpc-status">{{ $errors->first('status') }}</span>
                        </div>
                      </div>
                      
                    </div>
                    
                    <div class="modal-footer">
                      <button class="btn btn-info pull-right" type="submit" name="submit">{{trans('messages.listing_calendar.submit')}}</button>
                      <button type="button" class="btn btn-default cls-reload" data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Modal End -->

            <!-- Import Calendar Modal Start -->
            <div class="modal fade z-index-high d-none" id="import_calendar_package" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close cls-reload" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title import-cal">Import a New Calendar</h4>
                  </div>
                  <form class='form-horizontal' id='icalendar_form'>
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <p class="i-cal-m-msg" id="icalendar-model-message"></p>
                      <input type="hidden" value="{{ $result->id }}" name="property_id" id="icalendar_property_id">
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Calendar Address (URL) <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="url" id='icalendar_url' placeholder="Paste calendar address (URL) here" autocomplete = 'off'>
                          <span class="text-danger" id="error-icalendar-url">{{ $errors->first('start_date') }}</span>
                        </div>
                      </div>
                      <div class="clear-both"></div>
                      <div class="form-group">
                        <label class="col-sm-5 control-label">Name Your Calendar <span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="name" id='icalendar_name' placeholder = "Your calendar name" autocomplete = 'off'>
                          <span class="text-danger" id="error-icalendar-name">{{ $errors->first('end_date') }}</span>
                        </div>
                      </div>
                      <div class="form-group row colorSelect">
                        <label class="col-sm-5 control-label">Colour of your calendar<em class="text-danger">*</em></label>
                        <div class="col-sm-7">
                          <select class="form-control" name="color" id="color">
                            <option value="">--Please Select--</option>
                            <option value="#7FFFD4" class="aquamarine">Aquamarine</option>
                            <option value="#0000FF" class="blue">Blue</option>
                            <option value="#000080" class="navy">Navy</option>
                            <option value="#800080" class="purple">Purple</option>
                            <option value="#FF1493" class="deepPink">DeepPink</option>
                            <option value="#EE82EE" class="violet">Violet</option>
                            <option value="#FFC0CB" class="pink">Pink</option>
                            <option value="#006400" class="darkGreen">DarkGreen</option>
                            <option value="#008000" class="green">Green</option>
                            <option value="#9ACD32" class="yellowGreen">YellowGreen</option>
                            <option value="#FFFF00" class="yellow">Yellow</option>
                            <option value="#FFA500" class="orange" >Orange</option>
                            <option value="#FF0000" class="red">Red</option>
                            <option value="#A52A2A" class="brown" >Brown</option>
                            <option value="#DEB887" class="burlyWood" >BurlyWood</option>
                            <option value="custom">Custom</option>
                          </select>
                          <span class="text-danger" id="error-dtpc-color">{{ $errors->first('color') }}</span>
                        </div>
                      </div>
                      <div class="form-group colorCustom d-none">
                        <label class="col-sm-5 control-label">Set your calendar custom color<span class="text-danger">*</span></label>
                        <div class="col-sm-7">
                          <input type="text" class="form-control" name="customcolor" id='customcolor' placeholder = "Set your calendar custom color" autocomplete = 'off'>
                          <span class="text-danger" id="error-dtpc-customcolor">{{ $errors->first('customcolor') }}</span><br>
                          <a href="http://htmlcolorcodes.com/" target="_blank">Please visit the website for html custom color code.</a>
                        </div>
                      </div>
                    </div>
                    
                    <div class="modal-footer">
                      <button class="btn btn-info pull-right" type="submit" name="Import">Import Calendar</button>
                      <button type="button" class="btn btn-default cls-reload" data-dismiss="modal">{{trans('messages.listing_calendar.close')}}</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Import Calendar Modal End -->

            <!-- Export Icalendar Modal Starts -->
            <div class="modal fade z-index-high d-none" id="calendar_export_package" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close cls-reload" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title i-cal-m-msg">Export Calendar</h4>
                        </div>
                        <div class="panel-body">
                            <p>
                              <span>Copy and paste the link into other ICAL applications</span>
                            </p>
                              <input type="text" class="form-control" value="{{ url('icalender/export/'.$result->id.'.ics') }}" readonly="">
                        </div>
                    </div>
              </div>
            </div>
            <!-- Export Icalendar Modal End -->
            
            <div class="col-md-12" >
              <form method='post' action="admin/property-save/{{$result->id}}/pricing">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" id="dtpc_property_id" value="{{$result->id}}">
                    <div id="calender-dv">
                      {!! $calendar !!}
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-6 text-left mt-30">
                    <a data-prevent-default="" href="{{ url('admin/listing/'.$result->id.'/booking') }}" class="btn btn-large btn-primary">{{trans('messages.listing_description.back')}}</a>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-6 text-right mt-30">
                    <a data-prevent-default="" href="{{ url('admin/properties') }}" class="btn btn-large btn-primary">{{trans('messages.listing_calendar.your_list')}}</a>
                  </div>
                </div>
              </form>
            </div>
            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12 text-left mt-30">
                  <button class="text-muted btn btn-primary imporpt_calendar">Import Calendar</button>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 mt-30">
                  <a class="js-calendar-sync text-muted btn btn-primary" data-prevent-default="true" href="{{ url('admin/icalendar/synchronization/'.$result->id) }}">Sync with other calendars</a>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12 mt-30">
                  <button class="text-muted btn btn-primary" id="export_icalendar">Export Calendar</button> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@stop