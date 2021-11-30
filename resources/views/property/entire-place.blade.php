@extends('layouts.master')

@section('main')

      <div class="aparment-section">
         <div class="container">
            <h3>From the list below, which property category is the best fit for your place?</h3>
            <div class="row">
               <div class="col-lg-12">
                  <div class="aparment-section-inner p-md-0 p-4 pt-md-4 pt-4">
                     <div class="row pt-3">
                        @foreach($categories as $c)
                        <div class="col-lg-4">
                           <div class="feature-box" id="color-border-{{$c->id}}" onclick="setLocation({{$c->id}})">
                              <h3>{{$c->name}}</h3>
                              <p>{{$c->description}}</p>
                           </div>
                        </div>
                        @endforeach
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="row mt-4">
               <div class="col-lg-12">
                  <a href="#" data-toggle="modal" data-target="#basicModalMyPropertyType"><i class="far fa-question-circle"></i> I don’t see my property type on the list</a>
                     <!-- basic modal -->
                    <div class="modal fade" id="basicModalMyPropertyType" tabindex="-1" role="dialog" aria-labelledby="basicModalMyPropertyType" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header border-0 text-left">
                            <h4 class="modal-title" id="myModalLabel">I don't see my property type on the list</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>That's ok – try to choose a category that is most similar to your property. We use this category to help guests find your property.
                           </p>
                          </div>
                          <div class="modal-footer">
                             <button type="button" class="btn thme-btn">Got it</button>
                           </div>
                        </div>
                      </div>
                    </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-5">
                  <div class="btn-section-artment">
                    <a href="{{ URL::previous() }}" class="thme-btn-border mr-3"><i class="fas fa-chevron-left"></i></a>
                     <input type="button" id="property_vacation_submit" class="btn thme-btn w-101" value="Continue">
                   
                   
                  </div>
               </div>
               <form id="property_vacation" action="{{route('partner.property.createUnlistedProperty')}}">
                     
                        <input type="hidden" name="property_type_id" value="{{$property_type_id}}">
                        <input type="hidden" name="property_type" value="{{$property_type}}">
                        <input type="hidden" name="'property_count" value="{{$property_count}}">
                        <input type="hidden" name="location_type" id="location_type" value="{{$location_type}}">
                        <input type="hidden" name="property_category" id="property_category" value="">
                     </form>
                   <div class="row"><div class="col-sm-12"><div class=" alert alert-danger" id="alert-show" style="">Select Category</div></div></div>
            </div>
         </div>
      </div>
  <style style="text/css">
  .border-change{
   border: 1px solid green !important;
  }
  .border-change-red{
   border: 1px solid red;
  }
  </style>
   <script type="text/javascript">
        let rentType = '{{$property_type}}'
        $("#alert-show").hide();
        function setLocation(id)
        {
            $(".feature-box").removeClass("border-change-red");
           $(".feature-box").removeClass("border-change");
           $("#color-border-"+id).addClass("border-change");
           $("#property_category").val(id)
        }
        $("#property_vacation_submit").click(function(){
          $("#alert-show").hide();
         if($("#property_category").val()=='')
         {
            $("#alert-show").html("Select Category").show();
            $(".feature-box").addClass("border-change-red");
            return false;
         }
         else
         {
            $("#property_vacation").submit();
         }
        })
    </script>
@stop