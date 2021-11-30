<script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{env('GOOGLE_MAP_API_KEY')}}&libraries=places'></script>
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/app.js') }}"></script>

@stack('scripts')
