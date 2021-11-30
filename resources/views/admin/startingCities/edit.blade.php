@php 
$form_data = [
    'page_title'=> 'Edit Staritng City',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Staritng City Form',
    'form_id' => 'edit_staritng_city',     
    'action' => URL::to('/').'/admin/settings/edit-starting-cities/'.$result->id,
    'form_type' => 'file',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => ' Staring City Name', 'name' => 'name', 'value' => $result->name],
      ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' =>'','image' => url('front/images/starting_cities/'.$result['image']),'hint'=>'(Width:640px and Height:360px)'],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status],


    ]
  ];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_staritng_city').validate({
                rules: {
                    name: {
                        required: true
                    },
                    image: {
                        
                        //extension: "jpg|png|jpeg"
                        accept: "image/jpg,image/jpeg,image/png"
                    }
                },
                messages: {
                    image: {
                        accept: 'The file must be an image (jpg, jpeg or png)'
                    }
                }
            });

        });
</script>