@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $total_users_count }}</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/customers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $total_property_count }}</h3>

              <p>Total Property</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="{{ url('admin/properties') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $total_reservations_count }}</h3>

              <p>Total Reservations</p>
            </div>
            <div class="icon">
              <i class="fa fa-plane"></i>
            </div>
            <a href="{{ url('admin/bookings') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>{{ $today_users_count }}</h3>

              <p>Today Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/customers') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3>{{ $today_property_count }}</h3>

              <p>Today Property</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="{{ url('admin/properties') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $today_reservations_count }}</h3>

              <p>Today Reservations</p>
            </div>
            <div class="icon">
              <i class="fa fa-plane"></i>
            </div>
            <a href="{{ url('admin/bookings') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- /.content -->
      <div class="row">
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Property</h3>
            </div>
            <div class="box-body">
           <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Host Name</th>
                      <th>Space type</th>
                      <th width="15%">Date</th>
                      <th width="5%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($propertiesList))
                    @foreach($propertiesList  as $property)
                      <tr>
                        <td><a href="{{url('admin/listing/'.$property->properties_id).'/basics'}}" >{{$property->property_name}}</a></td>
                        <td><a href="{{ url('admin/edit-customer/'.$property->host_id) }}">{{$property->first_name.' '.$property->last_name}}</a></td>
                        <td>{{$property->property_name}}</td>
                        <td>{{dateFormat($property->property_created_at)}}</td>
                        <td>{{$property->property_status}}</td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
           </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

      <!-- /.content -->
      <div class="row">
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Bookings</h3>
            </div>
            <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Host Name</th>
                      <th>Guest Name</th>
                      <th>Property Name</th>
                      <th>Total Amount</th>
                      <th>Date</th>
                      <th width="5%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(!empty($bookingList))
                    @foreach($bookingList  as $booking)
                      <tr>
                        <td><a href="{{url('admin/bookings/detail/'.$booking->id)}}" >{{$booking->host_name}}</a></td>
                        <td><a href="{{ url('admin/edit-customer/'.$booking->user_id) }}">{{$booking->guest_name}}</a></td>
                        <td><a href="{{url('admin/listing/'.$booking->property_id).'/basics'}}" >{{$booking->property_name}}</a></td>
                        <td>{!! moneyFormat($booking->currency->symbol, $booking->total_amount) !!}</td>
                        <td>{{dateFormat($booking->created_at)}}</td>
                        <td>{{$booking->status}}</td>
                      </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop