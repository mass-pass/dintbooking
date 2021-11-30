<div class="cstom-tabs">
    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#name-and-location" class="{{($active === 'name_and_location')?'active':''}}">Name and location <div>
                    <span class="{{($current == 'name')?'current':''}}"></span><span class="{{($current == 'location')?'current':''}}"></span><span class="{{($current == 'pin_location')?'current':''}}"></span>
                </div></a></li>
        <li><a data-toggle="tab" href="#property-setup" class="{{($active === 'property_setup')?'active':''}}">Property Setup
                <div><span class="{{($current == 'property_details')?'current':''}}"></span><span class="{{($current == 'bedroom')?'current':''}}"></span><span class="{{($current == 'amenities')?'current':''}}"></span><span class="{{($current == 'breakfast')?'current':''}}"></span></div>
            </a></li>
        <li><a data-toggle="tab" href="#photos" class="{{($active === 'photos')?'active':''}}">Photos</a></li>
        <li><a data-toggle="tab" href="#pricing-and-calendar" class="{{($active === 'pricing_and_calculator')?'active':''}}">Pricing and calendar</a></li>
        <li><a data-toggle="tab" href="#legal-info" class="{{($active === 'legal_info')?'active':''}}">Legal info</a></li>
        <li><a data-toggle="tab" href="#reviews-and-complete" class="{{($active === 'reviews_and_complete')?'active':''}}">Reviews and complete</a></li>
    </ul>
</div>