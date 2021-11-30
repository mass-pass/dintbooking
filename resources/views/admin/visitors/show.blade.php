@extends('admin.template')

@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Visitors
{{--                <small>Control panel</small>--}}
            </h1>
            @include('admin.common.breadcrumb')
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Show Visitor</h3>
                            {{--                            <div class="pull-right"><a class="btn btn-success" href="{{ url('admin/add-amenities') }}">Add Visitor</a></div>--}}
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Ip</th>
                                        <td>{{$visitor->ip}}</td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td>{{$visitor->city}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country Code</th>
                                        <td>{{$visitor->country_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Country Name</th>
                                        <td>{{$visitor->country_name}}</td>
                                    </tr>
                                    <?php
                                        $location = 'No Searches Yet';
                                        $searches = $visitor->visitorSearches;
                                        if($searches){
                                            $location = $searches->pluck('location')->join('</br>');
                                        }
                                    ?>
                                    <tr>
                                        <th>Location</th>
                                        <td>{!! $location !!}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
