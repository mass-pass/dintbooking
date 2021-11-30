<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script type="text/javascript"> 
var APP_URL = "{{(url('/'))}}"; 
</script>
<!-- jQuery 2.2.4 -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/jQuery/jquery-2.2.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- jQuery validation -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/jQuery/jquery.validate.min.js"></script>
<!-- jQuery validation -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button);
  var sessionDate      = '{!! Session::get('date_format_type') !!}';
</script>
<!-- Bootstrap 3.3.6 -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/bootstrap/js/bootstrap.min.js"></script>
    @if (!empty($map_key))
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key={{ $map_key }}&libraries=places'></script>
    @endif
  <script type="text/javascript" src="{{ url('backend/js/locationpicker.jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('backend/js/bootbox.min.js') }}"></script>
<!-- admin js -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/dist/js/admin.js"></script>
<!-- backend js -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/js/backend.js"></script>
<!-- CK Editor -->
<!-- Morris.js charts -->
@if(Route::current()->uri() == 'admin/dashboard')
@endif
<!-- Sparkline -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/js/moment.min.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/datepicker/bootstrap-datepicker.js"></script> 
<!-- Bootstrap WYSIHTML5 -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/dist/js/app.min.js"></script>
<!--Select2-->
<script type="text/javascript" src="{{URL::to('/')}}/backend/plugins/select2/select2.full.min.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@if(Route::current()->uri() == 'admin/dashboard')
@endif
<!-- AdminLTE for demo purposes -->
<script type="text/javascript" src="{{URL::to('/')}}/backend/dist/js/demo.js"></script>
<script type="text/javascript" src="{{URL::to('/')}}/backend/dist/js/custom.js"></script>
<script type="text/javascript" src="{{ url('backend/js/daterangecustom.js')}}"></script>
</body>

@stack('scripts')
</html>
