@extends('admin.template')

@section('main')
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-8 col-sm-offset-2">
          <div class="box box-info box_info">
            <div class="box-header with-border">
              <h3 class="box-title">Service Details</h3>
            </div>

            <div class="box-info">

            <table class="table table-borderless">
              <tbody >
                <tr>
                 
                  <th class="text-center" >User name</th>
                  <td>{{ $withDrawal->user->full_name }}</td>
                  
                </tr>
                <tr>
                  
                  <th class="text-center">Price</th>
                  <td > {!! $withDrawal->currency->symbol !!} {{ $withDrawal->amount }}</td>
                </tr>

                 <tr>
                  
                  <th class="text-center">Description</th>
                  <td >{{ $withDrawal->status }}</td>
                </tr>
              </tbody>
            </table>
              
            </div>

            


        

            <div class="box-footer text-center">
              <a class="btn btn-default" href="{{ url('admin/services') }}">Back</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
    
