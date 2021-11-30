@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Page Form
      <small>add page form</small>
    </h1>
    @include('admin.common.breadcrumb')
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-header with-border">
            <h3 class="box-title">Add Page Form</h3>
          </div>
          <!-- form start -->
          <form class="form-horizontal" action="{{url('admin/add-page')}}" id="add_page" method="post" name="add_page" accept-charset='UTF-8' {{-- onsubmit="return contentValidate();" --}} enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="form-group">
               <label for="exampleInputPassword1" class="control-label col-sm-3">Name<span class="text-danger">*</span></label>
               <div class="col-sm-6">
                 <input type="text" class="form-control" value="" name="name" placeholder="" id="geturl">
               </div>
             </div>
             <div class="form-group">
               <label for="exampleInputPassword1" class="control-label col-sm-3">URL<span class="text-danger">*</span></label>
               <div class="col-sm-6">
                 <input type="text" class="form-control" name="url" id="page_url" placeholder="">
                  @if ($errors->has('url')) <p class="error-tag">{{ $errors->first('url') }}</p> @endif
               </div>
             </div>
            
               
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-3 control-label">Content<span class="text-danger">*</span></label>  
                 <div class="col-sm-6">
                   <textarea id="content" name="content" placeholder="" rows="10" cols="80" class=""> </textarea>
                   <span id="content-validation-error"></span>
                 </div>

             </div>
             <div class="form-group">
              <label for="exampleInputPassword1" class="control-label col-sm-3">Position</label>
               <div class="col-sm-6">
                 <select name="position" class="form-control">
                   <option value="first"> First Column </option>
                   <option value="second"> Second Column </option>
                 </select>
               </div>
             </div>
              <div class="form-group">
              <label for="exampleInputPassword1" class="control-label col-sm-3">Status</label>
               <div class="col-sm-6">
                 <select name="status" class="form-control">
                   <option value="Active"> Active </option>
                   <option value="Inactive">Inactive</option>
                 </select>
               </div>
             </div>

           </div>
           <!-- /.box-body -->
           <div class="box-footer">
            <button type="submit" class="btn btn-info" id="submitBtn">Submit</button>
            <a href="{{url('admin/pages')}}" class="btn btn-danger btn-sm">
              Cancel
            </a>
           
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
</section>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
 
<script>

  window.onload = function() {
    CKEDITOR.replace( 'content', {
      filebrowserUploadUrl: '{{ route('upload',['_token' => csrf_token() ]) }}',
      filebrowserUploadMethod: 'form'

    });
  };
</script>
<script>

  $(document).ready(function() {
   $('#page_url').on('blur keyup', function() {
     var pagUrl = $('#page_url').val();
     if (pagUrl !='') {
      $('.error-tag').hide();
    } 

  });
 });
</script>

<script>
   $(document).ready(function() {
   $('#geturl').on('blur keyup', function() {
     var pagUrl = $('#geturl').val();
         pagUrl = pagUrl.toLowerCase();
         pagUrl = pagUrl.replace(/[^a-zA-Z0-9]+/g,'-');
       if (pagUrl !='') {

      $('#page_url').val(pagUrl);
    } 

  });
 }); 
</script>


<script>

  $(document).ready(function() {
   $(document).on('submit', 'form', function() {
     $('button').attr('disabled', 'disabled');
   });
 });
</script>
<script type="text/javascript">
 $(document).ready(function () {


  $('#add_page').validate({
    ignore: [],
    rules: {
      name: {
        required: true
      },
      url:{
        required:true
      },
       content: {

        required: function(textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                  }
                }
              },
              errorPlacement: function (error, element) {
                if (element.prop('type') === 'textarea') {
                  $('#content-validation-error').html(error);
                } else {
                  error.insertAfter(element);
                }
              }
      });
});

</script>
@endpush