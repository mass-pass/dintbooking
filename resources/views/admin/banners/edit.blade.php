@php 
$form_data = [
    'page_title'=> 'Edit Banners',
    'page_subtitle'=> 'Edit Banners', 
    'form_name' => 'Edit Banners',
    'form_id' => 'edit_banners',
    'action' => URL::to('/').'/admin/settings/edit-banners/'.$result->id,
    'form_type' => 'file',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Heading', 'name' => 'heading', 'value' => $result->heading],
        ['type' => 'text', 'class' => '', 'label' => 'Subheading', 'name' => 'subheading', 'value' => $result->subheading],
        ['type' => 'file', 'class' => '', 'label' => 'Image', 'name' => "image", 'value' => '', 'image' => $result->image_url, 'hint'=>'(Width:1920px and Height:860px)'],
        ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => $result->status]
    ]
];
@endphp
@include("admin.common.form.primary", $form_data)

<script src="{{ asset('backend/js/additional-method.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $('#edit_banners').validate({
                rules: {
                    heading: {
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