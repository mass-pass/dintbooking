@extends('layouts.master')

@section('main')
<div class="margin-top-85">
    <div class="row m-0">
        @include('users.sidebar')

        <div class="col-lg-10">
            <div class="main-panel">
                <div class="container-fluid min-height">
                    <div class="row">
                        <div class="col-md-12 p-0 mb-3">
                            <div class="list-bacground mt-4 rounded-3 p-4 border">
                                <span class="text-18 pt-4 pb-4 font-weight-700">{{trans('messages.listing_basic.listing')}}</span>
                                
                                @if($properties->total()>0)
                                <div class="float-right">
                                    <div class="d-flex">
                                        <div class="pr-4">
                                            <span class="text-14 pt-2 pb-2 font-weight-700">{{trans('messages.users_dashboard.sort_by')}}</span>
                                        </div>

                                        <div>
                                            <form action="{{ url('/properties') }}" method="POST" id="listing-form">
                                                {{ csrf_field() }}
                                                <select class="form-control text-center text-14 minus-mt-6" id="listing_select" name="status">
                                                    <option value="All" {{ @$status == "All" ? ' selected="selected"' : '' }}>{{trans('messages.filter.all')}}</option>
                                                    <option value="Listed" {{ @$status == "Listed" ? ' selected="selected"' : '' }}>{{trans('messages.property.listed')}}</option>
                                                    <option value="Unlisted" {{ @$status == "Unlisted" ? ' selected="selected"' : '' }}>{{trans('messages.property.unlisted')}}</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-success d-none" role="alert" id="alert">
                        <span id="messages"></span>
                    </div>
                    
                    <div id="products" class="row mt-3">
                        @if($properties->total()>0)
                        @foreach($properties as $property)
                        <div class="col-md-12 p-0 mb-4">
                            <div class=" row  border p-2 rounded-3">
                                <div class="col-md-3 col-xl-4 p-2">
                                    <div class="img-event">
                                        <a href="properties/{{ $property->slug }}">
                                            <img class="img-fluid rounded" src="{{ $property->cover_photo }}" alt="cover_photo">
                                        </a>  
                                    </div>
                                </div>

                                <div class="col-md-6 col-xl-6 p-2">
                                    <div>
                                        <a href="properties/{{ $property->id }}">
                                            <p class="mb-0 text-18 text-color font-weight-700 text-color-hover">{{ ($property->name == '') ? '' : $property->name }}</p>     
                                        </a>
                                    </div>

                                    <p class="text-14 mt-3 text-muted mb-0">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ ($property && $property->property_address) ? $property->property_address->address_line_1 : ''}}
                                    </p>

                                    <div class="review-0 mt-4">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <span><i class="fa fa-star text-14 secondary-text-color"></i>
                                                    @if( $property->reviews_count)
                                                        {{ $property->avg_rating }}
                                                    @else
                                                        0
                                                    @endif 
                                                    ({{ $property->reviews_count }})
                                                </span>
                                            </div>
                                        
                                            <div class="pr-5">
                                                @if(is_object($property->property_price))
                                                <span class="font-weight-700 text-20">
                                                    {!! moneyFormat( $property->property_price->currency->symbol, $property->property_price->price) !!}
                                                </span> / {{trans('messages.property_single.night')}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-inline mt-2 pb-3">
                                        <li class="list-inline-item border rounded-3 p-1 mt-4 pl-3 pr-3">
                                            <p class="text-center mb-0">
                                                <i class="fas fa-bed text-20 d-none d-sm-inline-block text-muted"></i> 
                                                {{ $property->accommodates }}
                                                <span class=" text-14 font-weight-700">{{trans('messages.property_single.bed')}}</span> 
                                            </p>
                                        </li>
                                        <li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">
                                            <p  class="text-center mb-0" >
                                                <i class="fas fa-user-friends d-none d-sm-inline-block text-20 text-muted"></i>
                                                {{ $property->bedrooms }}
                                                <span class=" text-14 font-weight-700">{{trans('messages.property_single.guest')}}</span> 
                                            </p>
                                        </li>
                                        <li class="list-inline-item  border rounded-3 mt-4 p-1  pl-3 pr-3">
                                            <p  class="text-center mb-0">
                                                <i class="fas fa-bath text-20  d-none d-sm-inline-block  text-muted"></i>
                                                {{ $property->bathrooms }}
                                                <span class="text-14 font-weight-700">{{trans('messages.property_single.bathroom')}}</span> 
                                            </p>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-3 col-xl-2">
                                    <div class="d-flex w-100 h-100  mt-3 mt-sm-0 p-2">
                                        <div class="align-self-center w-100">
                                            <div class="row">
                                                <div class="col-6 col-sm-12">
                                                    <div class="main-toggle-switch text-left text-sm-center">
                                                        @if($property->steps_completed == 0)
                                                        <label class="toggleSwitch large" onclick="">
                                                            <input type="checkbox" id="status" data-id="{{ $property->id}}" data-status="{{$property->status}}"  {{ $property->status == "Listed" ? 'checked' : '' }}/>                
                                                            <span>
                                                                <span>{{trans('messages.property.listed')}}</span>
                                                                <span>{{trans('messages.property.unlisted')}}</span>
                                                            </span>
                                                            <a href="#" aria-label="toggle"></a>             
                                                        </label>
                                                        @else
                                                        
                                                        <span class="badge badge-warning p-3 pl-4 pr-4 text-14 border-r-25">{{ $property->steps_completed }} {{trans('messages.property.step_listed')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="col-6 col-sm-12">
                                                    <a href="{{ url('listing/'.$property->id.'/basics') }}">
                                                        <div class="text-color text-color-hover text-14 text-right text-sm-center mt-0 mt-md-3 p-2">
                                                            <i class="fas fa-edit"></i> 
                                                            {{trans('messages.property.manage_list_cal')}} 
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row justify-content-between overflow-auto  pb-3 mt-4 mb-5">
                            {{ $properties->appends(request()->except('page'))->links()}}
                        </div>
                        @else
                        <div class="row jutify-content-center position-center w-100 p-4 mt-4">
                            <div class="text-center w-100">
                                <img src="{{ url('img/unnamed.png')}}" class="img-fluid"   alt="Not Found">
                                <p class="text-center">{{trans('messages.message.empty_listing')}}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
    $(document).on('click', '#status', function(){
        var id = $(this).attr('data-id');
        var datastatus = $(this).attr('data-status');
        var dataURL = APP_URL+'/listing/update_status';
        $('#messages').empty();
        $.ajax({
            url: dataURL,
            data:{
                "_token": "{{ csrf_token() }}",
                'id':id,
                'status':datastatus,
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                $("#status").attr('data-status', data.status)
                $("#messages").append("");
                $("#alert").removeClass('d-none');
                $("#messages").append(data.name+" "+"has been"+" "+data.status+".");
                var header = $('#alert');
                setTimeout(function() {
                    header.addClass('d-none');
                }, 4000);
            }
        });
    });

     $(document).on('change', '#listing_select', function(){

            $("#listing-form").trigger("submit"); 
              
    });
</script>
@endpush

   
