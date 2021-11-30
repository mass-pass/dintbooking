@extends('layouts.master')
@section('main')
<div class="margin-top-85">
    <div class="row m-0">
        @include('users.sidebar')
        <div class="col-lg-10 p-0 mb-5">
            <div class="container-fluid p-0 min-height">
                <div class="col-md-12 mt-4">
                    <div class="main-panel">
                        <div class="row justify-content-center">
                            <div class="col-md-12 pl-4 pr-4">
                                <ul class="nav  navbar-expand-lg navbar-light list-bacground border rounded-3 p-2 pt-4 pb-4"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link {{ $write ?? ' '}} text-color" data-toggle="tab"
                                            href="#tabs-1" role="tab">{{ trans('messages.reviews.write_review') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $you ?? ' '}} text-color" data-toggle="tab" href="#tabs-2"
                                            role="tab">{{ trans('messages.reviews.passed_review') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ $expired ?? ' '}} text-color" data-toggle="tab"
                                            href="#tabs-3" role="tab">{{ trans('messages.reviews.expired_review') }}</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane {{ $write ?? ' '}}" id="tabs-1" role="tabpanel">
                                        @if($reviewsToWrite->total()>0)
                                        @foreach($reviewsToWrite as $writeReview)
                                        <div class="row mt-4 border w-100 rounded-3">
                                            <div class="col-md-3 col-xl-4 pl-0 pr-0">
                                                <div class="img-event p-3">
                                                    <a
                                                        href="{{ url('/') }}/properties/{{ $writeReview->properties->id }}">
                                                        <img class="img-fluid rounded"
                                                            src="{{ $writeReview->properties->cover_photo }}" alt="img">
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-9 col-xl-8 pl-2 pr-2">
                                                <div class="row align-items-center mt-4">
                                                    <div class="col-md-12 p-0">
                                                        <a
                                                            href="{{ url('/') }}/properties/{{ $writeReview->properties->id }}">
                                                            <p class="font-weight-700 mb-0">
                                                                {{$writeReview->properties->name }}</p>
                                                        </a>

                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <div class="d-flex justify-content-between">
                                                            <div>

                                                                <p class="mt-2"><i class="fa fa-calendar"></i>
                                                                    {{ date(' M d, Y', strtotime($writeReview->start_date)) }}
                                                                    -
                                                                    {{ date(' M d, Y', strtotime($writeReview->end_date)) }}
                                                                </p>
                                                                <p class="text-15 p-0"><i
                                                                        class="fas fa-exclamation-triangle text-success"></i>
                                                                    {{ trans('messages.reviews.you_have') }}
                                                                    <b>{{ str_replace('+','',$writeReview->review_days) }}
                                                                        {{ ($writeReview->review_days > 1) ? trans_choice('messages.reviews.day',2) : trans_choice('messages.reviews.day',1) }}</b>
                                                                    {{ trans('messages.reviews.to_submit_public_review') }}
                                                                    <b>
                                                                        {{Auth::user()->id == $writeReview->user_id ? $writeReview->host->full_name : $writeReview->users->full_name }}</b>
                                                                    .
                                                                </p>
                                                                <a href="{{ url('/') }}/reviews/edit/{{ $writeReview->id }}"
                                                                    class="text-color text-color-hover font-weight-700 text-15">{{ trans('messages.reviews.write_review') }}</a>
                                                            </div>

                                                            <div>
                                                                <div class="d-flex w-100 h-100  mt-3 mt-sm-0 p-2">
                                                                    <div class="align-self-center w-100">
                                                                        <div class="row">
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-md-12">
                                                                                    <div class='img-round text-center'>
                                                                                        <a
                                                                                            href="{{ url('/') }}/users/show/{{ $writeReview->user_id == Auth::id()  ? $writeReview->host_id : $writeReview->user_id }}">
                                                                                            <img src="{{Auth::user()->id == $writeReview->user_id ? $writeReview->host->profile_src : $writeReview->users->profile_src }}"" class="
                                                                                                rounded-circle
                                                                                                img-70x70">
                                                                                        </a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <p
                                                                                        class="text-center font-weight-700 mb-0">
                                                                                        <a
                                                                                            href="{{ url('/') }}/users/show/{{ Auth::user()->id == $writeReview->user_id ? $writeReview->host_id : $writeReview->user_id }}">
                                                                                            <p
                                                                                                class="text-center font-weight-700 mb-0">
                                                                                                {{Auth::user()->id == $writeReview->user_id ? $writeReview->host->full_name : $writeReview->users->full_name }}
                                                                                            </p>
                                                                                        </a>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $reviewsToWrite->appends(['write' => $reviewsToWrite->currentPage()])->links() }}
                                        </div>
                                        @else
                                        <div class="row jutify-content-center w-100 p-4 mt-4">
                                            <div class="text-center w-100">
                                                <img src="{{ url('img/unnamed.png')}}" class="img-fluid" alt="notfound">
                                                <p class="text-center">
                                                    {{ trans('messages.reviews.nobody_to_review') }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane {{ $you ?? ' '}}" id="tabs-2" role="tabpanel">
                                        @if($reviewsByYou->total()>0)
                                        @foreach($reviewsByYou as $pastReview)
                                        <div class="row mt-4 border rounded">
                                            <div class="col-md-3 col-xl-4 pl-0 pr-0">
                                                <div class="img-event p-3">
                                                    <a
                                                        href="{{ url('/') }}/properties/{{ $pastReview->properties->id }}">
                                                        <img class="img-fluid rounded"
                                                            src="{{ $pastReview->properties->cover_photo }}" alt="img">
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-9 col-xl-8 pl-2 pr-2">
                                                <div class="row align-items-center mt-2">
                                                    <div class="col-md-12 p-0">
                                                        <a
                                                            href="{{ url('/') }}/properties/{{ $pastReview->properties->id }}">
                                                            <p class="font-weight-700 text-18 mb-0">
                                                                {{ $pastReview->properties->name }} </p>
                                                        </a>

                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="font-weight-300 mb-0 text-15 mt-2"><i
                                                                        class="fa fa-calendar"></i>
                                                                    {{$pastReview->bookings->date_range}}</p>
                                                                <p class="text-15 p-0 text-justify mt-2">
                                                                    {{ str_limit($pastReview->message,80) }} </p>
                                                                <button
                                                                    class="btn vbtn-outline-success pl-3 pr-3 pt-2 pb-2 review_detials text-15"
                                                                    data-name="{{ $pastReview->properties->name }}"
                                                                    data-toggle="modal" data-id="{{ $pastReview->id }}"
                                                                    data-target="#myModal">
                                                                    {{ trans('messages.reviews.view_details') }}
                                                                </button>
                                                                <p class="text-15 mt-2"><i class="far fa-clock"></i>
                                                                    {{ $pastReview->created_at->diffForHumans() }}</p>
                                                            </div>

                                                            <div>
                                                                <div class="d-flex w-100 h-100  mt-3 mt-sm-0 p-2">
                                                                    <div class="align-self-center w-100">
                                                                        <div class="row">
                                                                            <div class="row justify-content-center">
                                                                                <div class="col-md-12">
                                                                                    <div class='img-round text-center'>
                                                                                        <a
                                                                                            href="{{ url('/') }}/users/show/{{ $pastReview->users_from->id }}">
                                                                                            <img src="{{ $pastReview->users_from->profile_src }}"
                                                                                                alt="{{ $pastReview->users_from->first_name }}"
                                                                                                class="rounded-circle img-70x70">
                                                                                        </a>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-12">
                                                                                    <p
                                                                                        class="text-center font-weight-700 mb-0">
                                                                                        <a href="{{ url('/') }}/users/show/{{ $pastReview->users_from->id }}"
                                                                                            class="text-color text-color-hover">
                                                                                            {{ $pastReview->users_from->full_name }}
                                                                                        </a>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $reviewsByYou->appends(['you' => $reviewsByYou->currentPage()])->links() }}
                                        </div>
                                        @else 
                                        <div class="row jutify-content-center  w-100 p-4 mt-4">
                                            <div class="text-center w-100">
                                                <img src="{{ url('img/unnamed.png')}}" class="img-fluid" alt="notfound">
                                                <p class="text-center">{{ trans('messages.reviews.nobody_to_review') }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="tab-pane {{ $expired ?? ' '}}" id="tabs-3" role="tabpanel">
                                        @if($expiredReviews->total()>0)
                                        @foreach($expiredReviews as $expired)
                                        <div class="row mt-4 border w-100 rounded">
                                            <div class="col-md-3 col-xl-4 pl-0 pr-0">
                                                <div class="img-event p-3">
                                                    <a href="{{ url('/') }}/properties/{{ $expired->properties->id }}">
                                                        <img class="img-fluid rounded"
                                                            src="{{ $expired->properties->cover_photo }}" alt="img">
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-9 col-xl-8 pl-2 pr-2">
                                                <div class="row align-items-center mt-4">
                                                    <div class="col-md-12 p-0">
                                                        <a
                                                            href="{{ url('/') }}/properties/{{ $expired->properties->id }}">
                                                            <p class="font-weight-700 mb-0">
                                                                {{$expired->properties->name}}</p>
                                                        </a>
                                                    </div>

                                                    <div class="col-md-12 p-0">
                                                        <div class="d-flex justify-content-between">
                                                            <div>
                                                                <p class="mt-2"><i class="fa fa-calendar"></i>
                                                                    {{$expired->date_range}}</p>
                                                                <p class="text-15 text-justify p-0"><i
                                                                        class="far fa-frown-open text-16 text-danger"></i>
                                                                    {{ trans('messages.reviews.expired_reviews_desc') }}
                                                                </p>
                                                            </div>

                                                            <div>
                                                                <div class="d-flex w-100 h-100  mt-3 mt-sm-0 p-2">
                                                                    <div class="align-self-center w-100">
                                                                        <div class="row justify-content-center">
                                                                            @if(Auth::user()->id == $expired->users->id)
                                                                            <div class="col-md-12">
                                                                                <div class='img-round text-center'>
                                                                                    <a
                                                                                        href="{{ url('/') }}/users/show/{{ $expired->host->id }}"><img
                                                                                            src="{{ $expired->host->profile_src }}"
                                                                                            alt="{{ $expired->host->first_name }}"
                                                                                            class="rounded-circle img-70x70"></a>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <p
                                                                                    class="text-center font-weight-700 mb-0">
                                                                                    <a href="{{ url('/') }}/users/show/{{ $expired->host->id }}"
                                                                                        class="text-color text-color-hover">
                                                                                        {{ $expired->host->first_name}}
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                            @else
                                                                            <div class="col-md-12">
                                                                                <div class='img-round text-center'>
                                                                                    <a
                                                                                        href="{{ url('/') }}/users/show/{{ $expired->users->id }}"><img
                                                                                            src="{{ $expired->users->profile_src }}"
                                                                                            alt="{{ $expired->users->first_name }}"
                                                                                            class="rounded-circle img-70x70"></a>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-12">
                                                                                <p
                                                                                    class="text-center font-weight-700 mb-0">
                                                                                    <a href="{{ url('/') }}/users/show/{{ $expired->users->id }}"
                                                                                        class="text-color text-color-hover">
                                                                                        {{ $expired->users->first_name}}
                                                                                    </a>
                                                                                </p>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="row justify-content-between overflow-auto pb-3 mt-4">
                                            {{ $expiredReviews->appends(['expired' => $expiredReviews->currentPage()])->links()}}
                                        </div>
                                        @else
                                        <div class="row jutify-content-center w-100 p-4 mt-4">
                                            <div class="text-center w-100">
                                                <img src="{{ url('img/unnamed.png')}}" class="img-fluid" alt="notfound">
                                                <p class="text-center">{{ trans('messages.reviews.nobody_to_review') }}
                                                </p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title font-weight-700" id="name">Property</h2>
                <button type="button" class="close text-28" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div id="heading">
                </div>
            </div>

            <div class="modal-footer">
                <pre> </pre>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type="text/javascript">
    $(document).on('click', '#new', function(){
        console.log('hellow');
    })

    $(document).on('click', '.review_detials', function(){
        var id = $(this).data("id");
        var name = $(this).data("name");
        $('#name').html(name);
        var dataURL = APP_URL+'/reviews/details';
        $.ajax({
            url: dataURL,
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
            },
            type: 'post',
            dataType: 'text',
            success: function(data) {
                $('#heading').html(data);          
            }
        })
    });
</script>
@endpush