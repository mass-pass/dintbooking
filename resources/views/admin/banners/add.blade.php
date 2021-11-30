@php 
$form_data = [
    'page_title'=> 'Add Banners',
    'page_subtitle'=> 'Add Banners', 
    'form_name' => 'Add Banners',
    'form_id'=>'add_banners',
    'action' => URL::to('/').'/admin/settings/add-banners',
    'form_type' => 'file',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Heading', 'name' => 'heading', 'value' => ''],
        ['type' => 'text', 'class' => '', 'label' => 'Subheading', 'name' => 'subheading', 'value' => ''],
        ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => "image", 'value' => '','hint'=>'(Width:1920px and Height:860px)'],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.primary", $form_data)

<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $('#add_banners').validate({
                rules: {
                    heading: {
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