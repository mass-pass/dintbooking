<div class="manage-listing-nav {{ ($result->status != NULL && $room_step == 'calendar') ? 'collapsed' : '' }}" id="js-manage-listing-nav">
    <div class="nav-sections">
  
    @if($result->status != NULL)
    <div class="h6 section-header row-space-1 pre-listed">
      {{ trans('messages.lys.hosting') }}
    </div>
    <ul class="list-unstyled row-space-5">
      <li class="nav-item nav-calendar pre-listed" data-track="calendar" ng-class="(step == 'calendar') ? 'nav-active' : ''">
        <a href="{{ ($room_step != 'calendar') ? url('manage-listing/'.$room_id.'/calendar') : '' }}" id="href_calendar">
          <div class="row nav-item">
            <div class="col-sm-12 va-container">
              <span class="va-middle">{{ trans('messages.lys.calendar') }}</span>

                <div class="instant-book-status pull-right">
                  <div class="instant-book-status__on hide">
                    <i class="icon icon-bolt icon-beach h3"></i>
                  </div>
                  <div class="instant-book-status__off hide">
                    <i class="icon icon-bolt icon-light-gray h3"></i>
                  </div>
                </div>
              
                <div class="js-new-section-icon not-post-listed pull-right hide">
                  <i class="nav-icon icon icon-add icon-grey"></i>
                </div>
              
              <div class="pull-right">
                <i class="nav-icon icon icon-ok-alt icon-babu nav-icon-checked not-post-listed"></i>
                <i class="dot dot-success hide"></i>
              </div>
            </div>
          </div>
        </a>
      </li>
      <li class="nav-item nav-pricing pre-listed" data-track="pricing" ng-class="(step == 'pricing') ? 'nav-active' : ''">
        <a href="{{ ($room_step != 'pricing') ? url('manage-listing/'.$room_id.'/pricing') : '' }}" id="href_pricing">
          <div class="row nav-item">
            <div class="col-sm-12 va-container">
              <span class="va-middle">{{ trans('messages.lys.pricing') }}</span>

                <div class="instant-book-status pull-right">
                  <div class="instant-book-status__on hide">
                    <i class="icon icon-bolt icon-beach h3"></i>
                  </div>
                  <div class="instant-book-status__off hide">
                    <i class="icon icon-bolt icon-light-gray h3"></i>
                  </div>
                </div>
              @if($result->status == NULL)
                <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->pricing == 1) ? 'hide' : 'visible' }}">
                  <i class="nav-icon icon icon-add icon-grey"></i>
                </div>
         
              <div class="pull-right">
                <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->pricing == 1) ? '' : 'hide' }}"></i>
                <i class="dot dot-success hide"></i>
              </div>
              @endif
            </div>
          </div>
        </a>
      </li>
      <li data-track="how-guests-book" class="nav-item nav-how-guests-book pre-listed" ng-class="(step == 'booking') ? 'nav-active' : ''">
        <a href="{{ ($room_step != 'booking') ? url('manage-listing/'.$room_id.'/booking') : '' }}" id="href_booking">
          <div class="row nav-item">
            <div class="col-sm-12 va-container">
              <div class="text-wrap va-middle">
                <span class="nav-item-name">{{ trans('messages.lys.booking') }}</span>
              </div>
                <div class="instant-book-status pull-right">
                  <div class="instant-book-status__on hide">
                    <i class="icon icon-bolt icon-beach h3"></i>
                  </div>
                  <div class="instant-book-status__off hide">
                    <i class="icon icon-bolt icon-light-gray h3"></i>
                  </div>
                </div>
                @if($result->status == NULL)
                <div class="js-new-section-icon not-post-listed pull-right">
                  <i class="nav-icon icon icon-add icon-grey"></i>
                </div>
              <div class="pull-right">
                <i aria-hidden="true" class="nav-icon icon icon-babu nav-icon-checked not-post-listed icon-ok-alt {{ ($rooms_status->booking == 1) ? '' : 'hide' }}">
                </i>
                <i class="dot dot-success hide"></i>
              </div>
              @endif
            </div>
          </div>
        </a>
      </li>
    </ul>
    @endif

    <div class="h6 section-header row-space-1 pre-listed">
      {{ trans('messages.lys.listing') }}
    </div>
    <ul class="list-unstyled row-space-5">
      
        <li class="nav-item nav-basics pre-listed" data-track="basics" ng-class="(step == 'basics') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'basics') ? url('manage-listing/'.$room_id.'/basics') : '' }}" id="href_basics">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.basics') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        @if($result->status == NULL)
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->basics == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
      
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->basics == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
        @endif
      </div>
    </div>
  </a>
</li>

        <li class="nav-item nav-description pre-listed" data-track="description" ng-class="(step == 'description') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'description') ? url('manage-listing/'.$room_id.'/description') : '' }}" id="href_description">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.description') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
          @if($result->status == NULL)
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->description == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
      
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->description == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
        @endif
      </div>
    </div>
  </a>
</li>

        <li class="nav-item nav-location pre-listed" data-track="location" ng-class="(step == 'location') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'location') ? url('manage-listing/'.$room_id.'/location') : '' }}" id="href_location">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.your_trips.location') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        @if($result->status == NULL)
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->location == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
        
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->location == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
        @endif
      </div>
    </div>
  </a>
</li>

        <li class="nav-item nav-amenities pre-listed" data-track="amenities" ng-class="(step == 'amenities') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'amenities') ? url('manage-listing/'.$room_id.'/amenities') : '' }}" id="href_amenities">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.amenities') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu nav-icon-checked not-post-listed"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

<li class="nav-item nav-photos pre-listed" data-track="photos" ng-class="(step == 'photos') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'photos') ? url('manage-listing/'.$room_id.'/photos') : '' }}" id="href_photos">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.photos') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        @if($result->status == NULL)
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->photos == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
        
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->photos == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
        @endif
      </div>
    </div>
  </a>
</li>

      
    </ul>
    
   @if($result->status != NULL) 
    <div class="h6 section-header row-space-1 pre-listed">
      {{ trans('messages.lys.guest_resources') }}
    </div>
    <ul class="list-unstyled row-space-5">
      
        <li class="nav-item nav-details pre-listed" data-track="details" ng-class="(step == 'details') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'details') ? url('manage-listing/'.$room_id.'/details') : '' }}" id="href_details">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.detailed_description') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
       
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu nav-icon-checked not-post-listed"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

        <li class="nav-item nav-guidebook post-listed" data-track="guidebook" ng-class="(step == 'guidebook') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'guidebook') ? url('manage-listing/'.$room_id.'/guidebook') : '' }}" id="href_guidebook">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.guidebook') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
      
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu nav-icon-checked not-post-listed"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

      
        <li class="nav-item nav-terms pre-listed" data-track="terms" ng-class="(step == 'terms') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'terms') ? url('manage-listing/'.$room_id.'/terms') : '' }}" id="href_terms">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.terms') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
     
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu nav-icon-checked not-post-listed"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

    </ul>

  @endif
  
  @if($result->status == NULL)
    <div class="h6 section-header row-space-1 pre-listed">
      {{ trans('messages.lys.hosting') }}
    </div>
    <ul class="list-unstyled row-space-5">
      
        <li class="nav-item nav-pricing pre-listed" data-track="pricing" ng-class="(step == 'pricing') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'pricing') ? url('manage-listing/'.$room_id.'/pricing') : '' }}" id="href_pricing">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.pricing') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->pricing == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
   
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->pricing == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

        <li class="nav-item nav-calendar pre-listed" data-track="calendar" ng-class="(step == 'calendar') ? 'nav-active' : ''">
  <a href="{{ ($room_step != 'calendar') ? url('manage-listing/'.$room_id.'/calendar') : '' }}" id="href_calendar">
    <div class="row nav-item">
      <div class="col-sm-12 va-container">
        <span class="va-middle">{{ trans('messages.lys.calendar') }}</span>

          <div class="instant-book-status pull-right">
            <div class="instant-book-status__on hide">
              <i class="icon icon-bolt icon-beach h3"></i>
            </div>
            <div class="instant-book-status__off hide">
              <i class="icon icon-bolt icon-light-gray h3"></i>
            </div>
          </div>
        
          <div class="js-new-section-icon not-post-listed pull-right transition {{ ($rooms_status->calendar == 1) ? 'hide' : 'visible' }}">
            <i class="nav-icon icon icon-add icon-grey"></i>
          </div>
        
        <div class="pull-right">
          <i class="nav-icon icon icon-ok-alt icon-babu not-post-listed {{ ($rooms_status->calendar == 1) ? '' : 'hide' }}"></i>
          <i class="dot dot-success hide"></i>
        </div>
      </div>
    </div>
  </a>
</li>

    </ul>
    @endif
  
</div>

<div class="publish-actions text-center" style="bottom: 20%;">
  <div id="user-suspended"></div>
  <div id="availability-dropdown">
  @if($result->status != NULL)
  <i class="dot row-space-top-2 col-top dot-{{ ($result->status == 'Listed') ? 'success' : 'danger' }}"></i>&nbsp;
<div class="select">
  <select>
    <option value="Listed" {{ ($result->status == 'Listed') ? 'selected' : '' }}>{{ trans('messages.your_listing.listed') }}</option>
    
    <option value="Unlisted" {{ ($result->status == 'Unlisted') ? 'selected' : '' }}>{{ trans('messages.your_listing.unlisted') }}</option>
  </select>
</div>
@endif

</div>
  <div id="js-publish-button">
@if($result->status == NULL)
  <div class="not-post-listed text-center">
  <div class="animated text-lead text-muted steps-remaining js-steps-remaining {{ ($result->steps_count != 0) ? 'show' : 'hide' }}" style="opacity: 1;">{{ trans('messages.lys.complete') }} <strong class="text-highlight"> <span id="steps_count">{{ $result->steps_count }}</span> {{ trans('messages.lys.steps') }} </strong> {{ trans('messages.lys.to_listing') }}</div>
  <button data-href="complete" class="animated btn btn-large btn-host btn-primary" id="js-list-space-button" data-track="list_space_button_left_nav" style="{{ ($result->steps_count != '0') ? 'display: none;' : '' }}">
    {{ trans('messages.lys.list_space') }}
  </button>
</div>
@endif

</div>
</div>
</div>