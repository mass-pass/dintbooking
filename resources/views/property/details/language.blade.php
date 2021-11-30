@extends('layouts.master')

@section('main')
    <div class="cstom-tabs">
        <ul class="nav nav-tabs">
            <li><a data-toggle="tab" href="#name-and-location" >Name and location</a></li>
            <li><a data-toggle="tab" href="#property-setup" class="active">Property Setup <div><span class="fil-success"></span><span class="fil-success"></span><span class="fil-success"></span><span class="current"></span><span></span></div></a></li>
            <li><a data-toggle="tab" href="#photos">Photos</a></li>
            <li><a data-toggle="tab" href="#pricing-and-calendar">Pricing and calendar</a></li>
            <li><a data-toggle="tab" href="#legal-info">Legal info</a></li>
            <li><a data-toggle="tab" href="#reviews-and-complete">Reviews and complete</a></li>
        </ul>
    </div>
    <div class="tab-content container">
        <div id="property-setup" class="tab-pane active">
            <div class="place-section brkfst-details">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-5">What languages do you or your staff speak?</h3>
                    </div>
                    <div class="col-lg-6">
                        <form id="propertyDetailsForm" method="POST" action="{{route('partner.property.details.language',$property->id)}}">
                            @csrf
                            <div class="place-section-right general-seting">
                                <h4 class="mb-4">Select languages</h4>
                                <div id="languages-container">
                                <p><input type="checkbox" {{ in_array('en', $property_languages)?'checked':''  }} name="languages[]" value="en" class="mr-2">English</p>
                                <p><input type="checkbox"  {{ in_array('es', $property_languages)?'checked':''  }} name="languages[]" value="es" class="mr-2">Spanish</p>
                                <p><input type="checkbox"  {{ in_array('cn', $property_languages)?'checked':''  }} name="languages[]" value="cn" class="mr-2">Chinese</p>
                                <p><input type="checkbox"  {{ in_array('fr', $property_languages)?'checked':''  }} name="languages[]" value="fr" class="mr-2">French</p>
                                <p><input type="checkbox"  {{ in_array('pt', $property_languages)?'checked':''  }} name="languages[]" value="pt" class="mr-2">Portuguese</p>
                                @foreach($property_languages as $vv)
                                    @if(!empty($vv))

                                        @if(!in_array($vv, ['en','es','cn','pt','fr']))
                                            <p><input type="checkbox"  checked name="languages[]" value="{{$vv}}" class="mr-2">{{ getLanguageNameFromCode($vv) }}</p>
                                        @endif
                                    @endif
                                @endforeach
                                </div>

                                <hr class="mt-4 mb-5">
                                <select class="form-control" id="additional-languages">
                                    @foreach($languages as $ii=>$vv)
                                        @if(!in_array($ii, $property_languages) && !in_array($ii,['en','es','cn','pt','fr'] ))
                                            <option value="{{$ii}}">{{$vv}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <a href="javascript:void(0);" id="lnk-additional-language"><strong>Add additional languages</strong></a>
                            </div>
                            <hr class="mt-4">
                            <div class="btn-section-artment">
                                <a href="{{route('partner.property.details.breakfast',$property->id)}}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                                <button type="submit" name="" class="btn thme-btn w-100">Continue</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script  type="text/javascript">
    $(function(){
        $('#lnk-additional-language').click(function(){
            code = $('#additional-languages').val()
            lname = $('#additional-languages').find(":selected").text();
            html = '<p><input type="checkbox"  checked name="languages[]" value="'+code+'" class="mr-2">';
            html+=lname+'</p>';

            $('#languages-container').append(html);
            $('#additional-languages').find("option:selected").remove();

        })
    });
    </script>
@endpush
