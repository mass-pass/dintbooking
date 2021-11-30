@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Analysis of Data
      </h1>
      @include('admin.common.breadcrumb')
    </section>
    <!-- Main content -->
    <section class="content">
      <!--Filtering Box Start -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <form class="form-horizontal" enctype='multipart/form-data' action="{{ url('admin/sales-analysis') }}" method="GET" accept-charset="UTF-8">
                {{ csrf_field() }}

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="col-md-3 col-sm-3 col-xs-12">
                        <label>Pick a Year</label>
                        <select class="form-control" name="year" id="year">
                          <option value="">Last 12 Months</option>
                          @if(!empty($yearLists))
                            @foreach($yearLists as $yearList)
                              <option value="{{$yearList->year}}" "{{$yearList->year == $year ? ' selected="selected"' : ''}}">{{$yearList->year}}</option>
                            @endforeach
                          @endif
                        </select>  
                      </div>
                      <div class="col-md-4 col-sm-3 col-xs-12">
                        <label>Property</label>
                        <select class="form-control select2" name="property" id="property">
                            <option value="">All</option>
                            @if(!empty($properties))
                              @foreach($properties as $property)
                                    <option value="{{$property->id}}" "{{$property->id == $allproperties ? ' selected="selected"' : ''}}">{{$property->name}}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                      <div class="col-md-1 col-sm-2 col-xs-4 mt-5">
                        <br>
                        <button type="submit" name="btn" class="btn btn-primary btn-flat">Filter</button>
                      </div>
                      <div class="col-md-1 col-sm-2 col-xs-4 mt-5">
                        <br>
                        <button type="submit" name="reset_btn" class="btn btn-primary btn-flat">Reset</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--Filtering Box End -->

      <div class="row">
        <div class="col-md-12 col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Rates of Reservations & Average Sales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table">
                  <caption>Monthly Average sales and Reservation Rates for <strong>{{ $propertyName }}</strong></caption>
                  <thead>
                    <tr>
                      <th scope="col">Months</th>
                      <th scope="col">{{ $propertyName }}</th>
                    </tr>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Average Sales</th>
                      <th></th>
                      <th scope="col">Rates of Reservations</th>
                    </tr>
                  </thead>
                  <tbody>
                    @for ($i=1; $i <count($monthYears); $i++)
                      <tr>
                        <td>{{ $monthYears[$i] }}</td>
                        @if($monthlyAvgDiff[$i] > 0)
                          <td style="background-color: #4CAF50; color: white;">{!! moneyFormat($default_cur_code->org_symbol, $monthlyAvg[$i] ) !!}</td>
                          <td style="background-color: #4CAF50; color: white;"><i class="fa fa-arrow-up"></i> +{{ $monthlyAvgDiff[$i] }}%</td>
                        @elseif($monthlyAvgDiff[$i] == 0)  
                          <td style="background-color: #1a8cff; color: white;">{!! moneyFormat($default_cur_code->org_symbol, $monthlyAvg[$i]) !!}</td>
                          <td style="background-color: #1a8cff; color: white;"><i class="fa fa-arrow-right"></i> {{ $monthlyAvgDiff[$i] }}%</td>
                        @else
                          <td style="background-color: #ff1a1a; color: white;">{!! moneyFormat( $default_cur_code->org_symbol, $monthlyAvg[$i] )!!}</td>
                          <td style="background-color: #ff1a1a; color: white;"><i class="fa fa-arrow-down"></i> {{ $monthlyAvgDiff[$i] }}%</td>
                        @endif
                        @if($reservationRateDiff[$i] > 0)
                          <td style="background-color: #4CAF50; color: white;">{{ $reservationRates[$i] }}%</td>
                          <td style="background-color: #4CAF50; color: white;"><i class="fa fa-arrow-up"></i> +{{ $reservationRateDiff[$i] }}%</td>
                        @elseif($reservationRateDiff[$i] == 0) 
                          <td style="background-color: #1a8cff; color: white;">{{ $reservationRates[$i] }}%</td>
                          <td style="background-color: #1a8cff; color: white;"><i class="fa fa-arrow-up"></i> {{ $reservationRateDiff[$i] }}%</td> 
                        @else
                          <td style="background-color: #ff1a1a; color: white;">{{ $reservationRates[$i] }}%</td>
                          <td style="background-color: #ff1a1a; color: white;"><i class="fa fa-arrow-down"></i> {{ $reservationRateDiff[$i] }}%</td>
                        @endif
                      </tr>
                    @endfor
                    
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop

@section('validate_script')
  <script type="text/javascript">
    // Select 2 for property search
  $('.select2').select2({
  // minimumInputLength: 3,
  ajax: {
      url: 'reports/property-search',
      processResults: function (data) {
        $('#property').val('DSD');
        return {
          results: data
        };
      }
    }


  });
  </script>
@endsection