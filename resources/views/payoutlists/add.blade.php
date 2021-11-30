@extends('layouts.master')
@section('main')
<div class="margin-top-85">
  <div class="row m-0">
    @include('users.sidebar')
    <div class="col-lg-10">
        <div class="main-panel">
          <div class="row mt-5">
              <div class="col-md-12">
                  <nav class="navbar navbar-expand-lg navbar-light list-bacground border rounded-3 p-3">
                    <ul class="navbar-nav">
                        <li class="nav-item pl-4 pr-4">
                            <a class="text-color text-color-hover" href="{{ url('users/payout-list') }}">Payouts</a>
                        </li>

                        <li class="nav-item  pl-4 pr-4">
                            <a class="text-color  secondary-text-color font-weight-700 text-color-hover" href="{{url('users/payout/request')}}">Payout Request</a>
                        </li>

                        <li class="nav-item  pl-4 pr-4">
                            <a class="text-color text-color-hover" href="{{ url('users/payout') }}">Payout Method</a>
                        </li>

                        <li class="nav-item  pl-4 pr-4">
                            <a class="text-color text-color-hover" href="{{url('users/payout/setting')}}">Payout Setting</a>
                        </li>
                    </ul>
                  </nav>
              </div>
          </div>

          <div class="row mt-5">
            <div class="col-md-12">
              <form action="{{url('users/payout/request')}}" id="add_payout_request" method="post" name="add_payout_setting" accept-charset='UTF-8'>
                {{ csrf_field() }}

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1" class="control-label">Payment Method</label>
                      <select class="form-control text-14" name="payment_method_id" id="payment_method_id">
                        @foreach($payouts as $payout)
                        <option value="{{$payout->id}}">@if( $payout->type == 1) Paypal ({{$payout->email}}) @else Bank ({{$payout->account_number}}) @endif </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="exampleInputPassword1" class="control-label">Currency</label>
                        <select class="form-control text-14" name="currency_id" id="currency_id">
                        <option value="{{$defaultCurrency->value}}">{{$defaultCurrencyCode}}</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleInputPassword1" class="control-label">Amount<span class="text-danger">*</span></label>
                          <input type="text" class="form-control text-14" name="amount" id="amount" value="{{old('amount')}}">
                          @if ($errors->has('amount')) <p class="error-tag">{{ $errors->first('amount') }}</p> 
                          @endif
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between mt-4">
                  <div class="p-3">
                      <a href="{{url('users/payout-list')}}">
                        <button type="button" class="dint-button button-reactangular vbtn-danger pl-5 pr-5">Cancel</button>
                      </a>
                  </div>

                  <div class="p-3">
                    <button type="submit" class="dint-button button-reactangular vbtn-default pl-5 pr-5" id="submitBtn">
                        Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script src="{{ url('front/js/jquery.validate.min.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function() {
      $('#add_payout_request').validate({
          rules: {
              amount: {
                  required: true,
                  digits: true,
                  maxlength: 255
              }
            }
        });
    });
</script>

@endpush