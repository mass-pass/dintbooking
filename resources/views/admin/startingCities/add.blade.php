@php 
$form_data = [
    'page_title'=> 'Add Staritng City',
    'page_subtitle'=> '', 
    'form_name' => 'Add Staritng City Form',
    'form_id' => 'add_city',
    'action' => URL::to('/').'/admin/settings/add-starting-cities',
    'form_type' => 'file',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => ' Staring City Name', 'name' => 'name', 'value' => ''],
        ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => 'image', 'value' => '', 'hint'=>'(Width:640px and Height:360px)'],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {

            $('#add_city').validate({
                rules: {
                    name: {
                        required: true
                    },
                    image: {
                        required: true,
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