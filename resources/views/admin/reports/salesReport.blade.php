@extends('admin.template')
@section('main')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{!! moneyFormat($default_cur_code->org_symbol, @$totalIncome) !!}</h3>

              <p>Total Income</p>
              <p></p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <p class="small-box-footer">Income from Past 12 Months</p>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ @$totalNights }}</h3>

              <p>Total Nights</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <p class="small-box-footer">Reserved Nights from Past 12 Months</p>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ @$totalReservations }}</h3>

              <p>Total Reservations</p>
            </div>
            <div class="icon">
              <i class="fa fa-plane"></i>
            </div>
            <p class="small-box-footer">Reservations from Past 12 Months</p>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- /.content -->
      <div class="row">
        <div id="container" class="sale-container"></div>
      </div>

      <!-- /.content -->
      <div class="row">
        
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('validate_script')
<script src="{{URL::to('/')}}/backend/plugins/highcharts/highcharts.js"></script>
<script src="{{URL::to('/')}}/backend/plugins/highcharts/exporting.js"></script>

<script>
	Highcharts.chart('container', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Sales of Past 12 Months'
    },
    subtitle: {
        text: 'Total Income {{$default_cur_code->code}} {{$totalIncome}} for {{$totalNights}} Nights'
    },
    xAxis: {
        categories: jQuery.parseJSON('{!! $months !!}')
    },
    yAxis: {
        title: {
            text: 'Nights per Month'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: true
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    }, // optional
    series: [{
        name: 'Nights',
        data: jQuery.parseJSON('{!! $monthlyNights !!}') //[22.0, 4.9, 4.5, 54.5, 8.4, 11.5, 24.2, 21.5, 28.3, 28.3, 12.9, 3.6]
    }]
});
</script>
@endsection