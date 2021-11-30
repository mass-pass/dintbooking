@extends('boats::layouts.master')

@section('content')
<div class="margin-top-85">
    <div class="row m-0">
        
        @include('users.sidebar')
        
        <div class="col-lg-10 p-0">
            <div class="container-fluid min-height">
                <div class="row">
                    <div class="col-md-6">
                        @include('boats::includes.alerts')
                    </div>
                </div>
                <div class="row mb-4 justify-content-between align-items-end">
                    <div class="col-md-6">
                        <h3 class="my-3">{{__('Boats Dashboad')}}</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    @if(auth()->user()->isHost())
                    <div class="col-md-4">
                        <div class="card card-default p-3 mt-3">
                            <div class="card-body">
                                <p class="text-center font-weight-bold m-0"><i
                                        class="far fa-list-alt mr-2 text-16 align-middle badge-dark rounded-circle p-3 vbadge-success"></i>
                                    {{ __('My Boats') }}</p>
                                <a href="{{ url('boats') }}">
                                    <p class="text-center font-weight-bold m-0">{{ $boats->total() }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop