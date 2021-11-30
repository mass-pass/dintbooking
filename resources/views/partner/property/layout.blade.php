@extends('layouts.partner_template', ['currentPropertyId' => $current_property_id ?? null])

@section('main')
    <section style="padding-left: 20%;">
        <div class="content-wrapper" style="padding-top:0px;margin-top:0px;" >
            <div class="container">
                <div class="page-header">
                    <div class="page-info">
                        <h4 class="mb-0">Property Layout</h4>
                    </div>
                </div>
                <!-- spacer -->
                <div class="hr">
                    <hr>
                </div>
                <!-- spacer -->
                <div class="content-body">
                    <div class="property-layout-wrapper pt-3">
                        <div class="row">
                            
                            <!-- Add property -->
                            <div class="col-md-4">
                                <div class="add-property-item mb-3">
                                   <a href="{{ route('create-new-property') }}">
                                        <h4>Create a property layout <br>
                                            <small>(at {{ $property->property_address ? $property->property_address->address_line_1:'' }})</small>
                                        </h4>
                                        <i class="fa fa-plus-circle"></i>
                                   </a>
                                </div>
                            </div>
                            <!-- Add property -->
                            <div class="col-md-4">
                                <div class="add-property-item mb-3">
                                    <a href="{{ route('partner.list-property') }}">
                                         <h4>Create a new property <br>
                                             <small>(at different address)</small>
                                         </h4>
                                         <i class="fa fa-plus-circle"></i>
                                    </a>
                                 </div>
                            </div>
                        </div>
                        <div class="row">
                            
                                @if($property->property_layouts()->count() == 0)
                                    {{-- <div class="property-item">
                                        <div class="property-image" style="background-image: url('{{ $property->cover_photo }}');">
                                            <div class="property-desc">
                                                <p>{{ $property->name }}</p>
                                                <small>({{ $property->id }})</small>
                                            </div>
                                        </div>
                                        <div class="property-details">
                                            @if($property->accommodates)
                                                <p class="mb-1">Occupancy: <b>{{ $property->accommodates }} adults</b></p>
                                            @endif
                                            <p>Number of this type: <b>{{ $property->apartments }}</b></p>
                                            <div class="property-action">
                                                <a href="#" class="btn btn-secondary ">Edit</a> <div class="amenities-custom-file">
                                                    <input type="file" name="" id="">
                                                    <span><i class="fa fa-camera"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                @else
                                    @foreach($property->property_layouts as $property_layout)
                                    <div class="col-md-4">
                                        <div class="property-item">
                                            <div class="property-image" style="background-image: url('{{ $property->cover_photo }}');">
                                                <div class="property-desc">
                                                    <p>{{ $property_layout->title }}</p>
                                                    <small>({{ $property_layout->id }})</small>
                                                </div>
                                            </div>
                                            <div class="property-details">
                                                    <p class="mb-1">Occupancy: <b>{{ $property_layout->max_occupancy }} adults</b></p>
                                                <p>Number of this type: <b>{{ $property_layout->number_of_units }}</b></p>
                                                <div class="property-action">
                                                    <a href="{{ route('edit-property-layout', ['property' => $current_property_id,'id' => $property_layout]) }}" class="btn btn-secondary ">Edit</a> <div class="amenities-custom-file">
                                                        <input type="file" name="" id="">
                                                        <span><i class="fa fa-camera"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
    
                                    @endforeach
                                @endif
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop