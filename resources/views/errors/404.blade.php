@extends('layouts.master')

@section('main')
    <div class="container-fluid container-fluid-90 min-height margin-top-85 mb-5">
      <div class="error_width " >
        <div class="notfound position-center">
            <div class="notfound-404">
              <h3>{{trans('messages.error.oops')}} {{trans('messages.error.unauthorized_action')}}</h3>
              <h1><span>4</span><span>0</span><span>4</span></h1>
            </div>
            <h2 class="text-center">{{trans('messages.error.error_data_1')}}  {{trans('messages.error.error_data_2')}}</h2>
          </div>
      </div>
    </div>  
@stop
