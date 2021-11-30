@extends('layouts.master')

@push('css')
<style type="text/css">
        @media (min-width: 992px) {
            .col-lg-6 {
                -ms-flex: 0 0 55% !important;
                flex: 0 0 55% !important;
                max-width: 55% !important;
            }
        }

        input[type="text" i] {
            border: none;
            width: 45px;
        }

        .bedroom-section-right {
            width: 27% !important;
        }
</style>
@endpush 

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup<div><span class="current"></span><span></span><span></span><span></span><span></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">
            <div class="place-section">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">Bedroom</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="locationForm" method="POST" action="{{route('partner.property.details.bedroom',$property->id)}}">
                        @csrf
                            <div class="place-section-right">
                                <h4 class="mb-5">Which beds are available in this room?</h4>
                                <div class="d-flex">
                                    <div class="bedroom-section-lft">
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Single bed</p>
                                                <span>90-130 wide</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Double bed</p>
                                                <span>131-150 cm wide</span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Large bed (King size)</p>
                                                <span>151-180 cm wide</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Extra-Large double bed (Super-king size)</p>
                                                <span>181-210 cm wide</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Bunk bed</p>
                                                <span>Variable Size</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Sofa bed</p>
                                                <span>Variable Size</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center beds-details">
                                            <img src="{{ url('images/double-bed.png') }}">
                                            <div class="">
                                                <p>Futon bed</p>
                                                <span>Variable Size</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bedroom-section-right">
                                        <div class="flter-section mb-5" id="single_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="single_bedroom" id="single_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="double_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="double_bedroom" id="double_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="large_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="large_bedroom" id="large_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="extra_large_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="extra_large_bedroom" id="extra_large_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="bunk_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="bunk_bedroom" id="bunk_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="sofa_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="sofa_bedroom" id="sofa_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                        <div class="flter-section mb-5" id="futon_bedroom_div">
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-minus"><i class="fas fa-minus"></i></a>
                                            <input type="text" value="0" name="futon_bedroom" id="futon_bedroom" class="qty"  class="input-text qty" />
                                            <a href="javascript:void(0);" class="thme-btn-border altera counter-plus"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="javascript:void(0);" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <input type="submit" name="" class="btn thme-btn w-100" value="Continue">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script type="text/javascript" src="{{ url('js/handleCounter.js') }}"></script>
    <script  type="text/javascript">
        $(function ($) {
            var options = {
                minimum: 1,
                maximize: 100,
                onChange: valChanged,
                onMinimum: function(e) {
                    console.log('reached minimum: '+e)
                },
                onMaximize: function(e) {
                    console.log('reached maximize'+e)
                }
            }
            $('#single_bedroom_div').handleCounter(options);
            $('#double_bedroom_div').handleCounter(options);
			$('#large_bedroom_div').handleCounter(options);
            $('#extra_large_bedroom_div').handleCounter(options);
            $('#bunk_bedroom_div').handleCounter(options);
			$('#sofa_bedroom_div').handleCounter(options);
            $('#futon_bedroom_div').handleCounter(options);
            
        })

        function valChanged(d) {
            //            console.log(d)
        }
    </script>
@endpush
