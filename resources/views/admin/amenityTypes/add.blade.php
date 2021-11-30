@php 
$form_data = [
    'page_title'=> 'Add Amenity Type',
    'page_subtitle'=> '', 
    'form_name' => 'Add Amenity Type Form',
    'form_id' => 'add_amenity',
    'action' => URL::to('/').'/admin/settings/add-amenities-type',
    'fields' => [
        ['type' => 'text', 'class' => '', 'label' => 'Name', 'name' => 'name', 'value' => ''],
        ['type' => 'textarea', 'class' => '', 'label' => 'Description', 'name' => 'description', 'value' => ''],
    ]
];
@endphp

@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
    $(document).ready(function () {
            $('#add_amenity').validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                }
            });
        });
</script>