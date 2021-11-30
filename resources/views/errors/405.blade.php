@extends('layouts.master')

@section('main')
    <div class="container-fluid fluid-90 margin-top-85">
      <div class="error_width">
        <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="error_word">{{trans('messages.error.oops')}}</div>
            <div class="clearfix"></div>
            <div class="error_small_word">{{trans('messages.error.unauthorized_action')}}.</div>
        </div>
        <div class="col-md-5 col-sm-5 col-xs-12">
          <div class="img_cen_ter"><img src="{{ url('front/img/error-page.png') }}" class="img-responsive"></div>
        </div>
      </div>
    </div>  
@stop
