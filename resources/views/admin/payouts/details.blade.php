@extends('admin.template')

@section('main')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-8 col-sm-offset-2">
          <div class="box box-info box_info">
            <div class="box-header with-border">
              <h3 class="box-title">Payout Details</h3>
            </div>

            <div class="box-info">

            <table class="table table-borderless">
              <tbody >
                <tr>
                 
                  <th class="text-center" >User name</th>
                  <td>{{ $withDrawal->user->full_name }}</td>
                  
                </tr>
                <tr>
                  
                  <th class="text-center">Payment Method</th>
                  <td>{{ $withDrawal->payment_methods->name }}</td>
                  
                </tr>
                <tr>
                  
                  <th class="text-center">Payout Amount</th>
                  <td > {!! $withDrawal->currency->symbol !!} {{ $withDrawal->amount }}</td>
                </tr>

                 <tr>
                  
                  <th class="text-center">Status</th>
                  <td >{{ $withDrawal->status }}</td>
                </tr>
              </tbody>
            </table>
              
            </div>

            


        

            <div class="box-footer text-center">
              <a class="btn btn-default" href="{{ url('admin/payouts') }}">Back</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
    
