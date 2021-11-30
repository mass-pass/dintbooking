@extends('boats::layouts.master')

@section('content')

<section class="margin-top-85">
    <div class="row m-0">

        @include('users.sidebar')

        <div class="col-lg-10 p-0">
            <div class="container-fluid min-height">
                <div class="row">
                    <div class="col-md-6">
                        @include('boats::includes.alerts')
                    </div>
                </div>
                <!-- start -->
                <div class="row mb-4 justify-content-between align-items-end">
                    <div class="col-md-6 col-12">
                        <h3 class="my-3">{{__('My boats')}}</h3>
                    </div>
                    @if(isset($records) && $records->total()>0)
                    <div class="col-md-4 col-8 text-right">
                        <input type="text" name="" class="form-control form-control-sm" id=""
                            placeholder="Filter by property ID, name, or location">
                    </div>
                    <div class="col-md-2 col-4 text-right">
                        <div class="acph-actions text-md-right">
                            <a href="#" class="text-muted mr-4" onclick="alert('work in progress');">
                                <i class="fa fa-download"></i> Download
                            </a>
                            <a href="#" class="text-muted"> <i class="fa fa-ellipsis-v"></i> </a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="row">
                    @if(isset($records) && $records->total()>0)
                    <div class="col-md-12 mb-4">
                        <div class="property-table-wrapper">
                            <div class="table-responsive">
                                <table class="table shadow-sm">
                                    <thead>
                                        <tr>
                                            <th style="width:200px;">Type</th>
                                            <th>City</th>
                                            <th>Harbour</th>
                                            <th>Manufacturer</th>
                                            <th>Model</th>
                                            <th style="width:150px;">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($records as $record)
                                        <tr>
                                            <td>
                                                {{ $record->boat_type ?? "--" }}
                                            </td>
                                            <td>
                                                {{ $record->city ?? "--" }}
                                            </td>
                                        
                                            <td>
                                                {{ $record->manufacturer ?? "--" }}
                                            </td>
                                            <td>
                                                {{ $record->model ?? "--" }}
                                            </td>
                                            <td>
                                                <a class="btn btn-secondary text-white px-4 m-1"
                                                    href="javascript:alert('Coming soon')">
                                                    Edit
                                                </a>
                                                <a class="btn btn-danger text-white px-4 m-1"
                                                    href="javascript:alert('Coming soon')">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <strong>No boats found</strong>
                            <p>If you want to provide any boat service, please register.</p>
                            @if(false)
                            <p class="mt-5">
                                <a class="btn thme-btn px-5" href="{{route('boats::signup')}}">Get Listed</a>
                            </p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @stop